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

    public function update()
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

        return view('profileUpdate', $data);
    }

    public function updateProcess()
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

        $validation =  \Config\Services::validation();
        $validation->setRules([
            'Username' => 'required|min_length[3]|max_length[20]',
        ]);

        if ($this->request->getMethod() === 'POST') {
            if ($validation->withRequest($this->request)->run()) {
                $updatedData = [
                    'Username' => $this->request->getPost('Username'),
                    'First_Name' => $this->request->getPost('First_Name'),
                    'Last_Name' => $this->request->getPost('Last_Name'),
                    'Employee_Password' => $this->request->getPost('Employee_Password'),
                    'Work_Email' => $this->request->getPost('Work_Email'),
                    'Phone_Number' => $this->request->getPost('Phone_Number'),
                    // Data yang akan diupdate
                ];

                // Update data di database
                $userModel->update($userData['Employee_ID'], $updatedData);

                return redirect()->to('/profile')->with('success', 'Profile updated successfully!');
            } else {
                return redirect()->to('/profile')->with('error', $validation->getErrors());
            }
        }
    }
}