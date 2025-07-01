<?php

namespace App\Controllers;
use CodeIgniter\CLI\CLI;
use App\Models\UserModel;
use Google_Client;
use Google_Service_Calendar;
use Twilio\Rest\Client;

class Cron extends BaseController
{
    public function remind()
    {
        $users = (new UserModel())->findAll();

        foreach ($users as $user) {
            if (!$user['phone'] || !$user['access_token']) continue;

            $token = json_decode($user['access_token'], true);

            $client = new Google_Client();
            $client->setAccessToken($token);

            if ($client->isAccessTokenExpired() && $user['refresh_token']) {
                $client->fetchAccessTokenWithRefreshToken($user['refresh_token']);
                $newToken = $client->getAccessToken();

                (new UserModel())->update($user['id'], [
                    'access_token' => json_encode($newToken),
                    'token_expires' => date('Y-m-d H:i:s', time() + $newToken['expires_in'])
                ]);
            }

            $calendar = new Google_Service_Calendar($client);

            $now = new \DateTime('now', new \DateTimeZone('UTC'));
            $timeMin = $now->format('c');
            $timeMax = $now->modify('+5 minutes')->format('c');

            $events = $calendar->events->listEvents('primary', [
                'timeMin' => $timeMin,
                'timeMax' => $timeMax,
                'singleEvents' => true,
                'orderBy' => 'startTime'
            ]);

            $items = $events->getItems();
            $eventLines = [];

            foreach ($items as $event) {
                $startTimeRaw = $event->getStart()->getDateTime() ?? $event->getStart()->getDate();
                $startTime = new \DateTime($startTimeRaw);
                $startTime->setTimezone(new \DateTimeZone('Asia/Kolkata'));
            
                $nowIST = new \DateTime('now', new \DateTimeZone('Asia/Kolkata'));
            
                if ($startTime > $nowIST) {
                    $timeFormatted = $startTime->format('g:i A');
                    $summary = $event->getSummary() ?? 'Unnamed Event';
                    $eventLines[] = "{$summary} at {$timeFormatted}";
                }
            }
            

            if (!empty($eventLines)) {
                $twilio = new Client(env('TWILIO_SID'), env('TWILIO_TOKEN'));

                $message = implode(', ', $eventLines);

                $twiml = <<<XML
                <Response>
                    <Pause length="1"/>
                    <Say voice="alice" language="en-US">
                        Hello Boss. You have the following event reminders: {$message}.
                    </Say>
                    <Pause length="2"/>
                    <Say voice="alice">Reminder delivered. Rock on.</Say>
                </Response>
                XML;

                $twilio->calls->create(
                    $user['phone'],
                    env('TWILIO_FROM'),
                    ['twiml' => $twiml]
                );

                CLI::write("Called {$user['phone']} for: " . $message, 'green');
            }
        }
    }
}
