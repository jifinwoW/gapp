<?php

namespace App\Controllers;

use App\Models\UserModel;

class Dashboard extends BaseController
{
    public function index()
    {
        if (!session()->get('email')) {
            return redirect()->to('/');
        }

        $userModel = new UserModel();
        $user = $userModel->where('email', session()->get('email'))->first();

        return view('dashboard', ['phone' => $user['phone'] ?? '']);
    }

    public function savePhone()
    {
        $rawPhone = $this->request->getPost('phone');
        $email = session()->get('email');

        if (!$email || !$rawPhone) {
            return redirect()->to('/dashboard')->with('error', 'Missing info');
        }


        $phone = preg_replace('/[^0-9]/', '', $rawPhone);

        if (!preg_match('/^\+?[0-9]{10,15}$/', $phone)) {
            return redirect()->back()->with('error', 'Invalid phone number format.');
        }
        


        if (strlen($phone) === 10) {
            $phone = '+91' . $phone;
        } elseif (strpos($phone, '91') === 0 && strlen($phone) === 12) {
            $phone = '+' . $phone;
        } elseif (strpos($phone, '+') !== 0) {
            // Anything else without +, assume it's invalid
            return redirect()->to('/dashboard')->with('error', 'Invalid phone number format.');
        }

        // Save to DB
        $userModel = new UserModel();
        $userModel->where('email', $email)->set(['phone' => $phone])->update();

        return redirect()->to('/dashboard')->with('success', 'Phone number updated!');
    }
}
