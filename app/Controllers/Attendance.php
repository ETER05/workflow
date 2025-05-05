<?php

namespace App\Controllers;

class Attendance extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $data = [
            'username' => session()->get('username'),
        ];

        return view('Attendance', $data);
    }
}