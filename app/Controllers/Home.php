<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        if (session()->get('email')) {
            return redirect()->to('/dashboard');
        }

        return view('welcome_message');
    }
   
}
