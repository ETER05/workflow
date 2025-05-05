<?php

namespace App\Controllers;
use App\Models\UserModel;

class Profile extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $username = session()->get('username');

        $userModel = new UserModel();
        $userData = $userModel->where('Username', $username)->first();

        if (!$userData){
            return redirect()->to('/login')->with('error', 'User not found');
        }

        $data = [
            'user' => $userData
        ];

        return view('profile', $data);
    }
}