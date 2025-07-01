<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;
use Config\Google;
use Google_Client;
use Google_Service_Calendar;

class Auth extends Controller
{
    public function login()
    {
        $client = new Google_Client();
        $gConfig = new Google();

        $client->setClientId($gConfig->clientID);
        $client->setClientSecret($gConfig->clientSecret);
        $client->setRedirectUri($gConfig->redirectUri);
        $client->addScope(Google_Service_Calendar::CALENDAR_READONLY);
        $client->addScope('email');
        $client->addScope('profile');
        $client->setAccessType('offline'); // So we get refresh_token
        $client->setPrompt('consent');     // Always get refresh_token

        $authUrl = $client->createAuthUrl();
        return redirect()->to($authUrl);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }


    public function callback()
    {
        $client = new Google_Client();
        $gConfig = new Google();

        $client->setClientId($gConfig->clientID);
        $client->setClientSecret($gConfig->clientSecret);
        $client->setRedirectUri($gConfig->redirectUri);

        $code = $this->request->getVar('code');
        if (!$code) {
            return redirect()->to('/');
        }

        $token = $client->fetchAccessTokenWithAuthCode($code);
        if (isset($token['error'])) {
            return redirect()->to('/')->with('error', $token['error_description']);
        }

        $client->setAccessToken($token);

        // 🧠 Instead of Google_Service_Oauth2, extract email from token payload
        $payload = $client->verifyIdToken();
        $email = $payload['email'] ?? null;

        if (!$email) {
            return redirect()->to('/')->with('error', 'Could not get user email');
        }

        // Save to DB
        $userModel = new UserModel();
        $existingUser = $userModel->where('email', $email)->first();

        $data = [
            'email' => $email,
            'access_token' => json_encode($token),
            'refresh_token' => $token['refresh_token'] ?? ($existingUser['refresh_token'] ?? null),
            'token_expires' => date('Y-m-d H:i:s', time() + $token['expires_in'])
        ];

        if ($existingUser) {
            $userModel->update($existingUser['id'], $data);
        } else {
            $userModel->insert($data);
        }

        // Set session
        session()->set('email', $email);

        return redirect()->to('/dashboard');
    }
}
