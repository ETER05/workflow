<?php

namespace App\Controllers;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/dashboard');
        }

        return view('auth/login');
    }

    public function loginProcess()
    {
        $session = session();
        $model = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $model->where('Username', $username)->first();

        if ($user && $password === $user['Employee_Password']) {
            $session->set([
                'username' => $user['Username'],
                'employee_id' => $user['Employee_ID'],
                'position' => $user['Position'],
                'logged_in' => true
            ]);

            $model->update($user['Employee_ID'], ['is_online' => 1]);

            return redirect()->to('/dashboard');
        } else {
            return redirect()->back()->with('error', 'Login gagal');
        }
    }

    public function logout()
    {
        $employee_id = session()->get('employee_id');

        $model = new UserModel();
        $model->update($employee_id, ['is_online' => 0]);

        session()->destroy();
        return redirect()->to('/login');
    }
}
