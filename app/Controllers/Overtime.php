<?php

namespace App\Controllers;

class Overtime extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $data = [
            'username' => session()->get('username'),
        ];

        return view('Overtime', $data);
    }
}