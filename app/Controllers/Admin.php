<?php

namespace App\Controllers;
use App\Models\UserModel;

class Admin extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $username = session()->get('username');

        $userModel = new UserModel();
        $userData = $userModel->where('Username', $username)->first();
        $employee = $userModel->findAll();

        if (!$userData){
            return redirect()->to('/login')->with('error', 'User not found');
        }

        if (session('position') === 'Admin' || session('position') === 'Manager') {
            return view('Admin', ['employee' => $employee, 'userData' => $userData]);
        }else{
            return redirect()->to('/dashboard')->with('error', 'Access denied');
        }
    }
}