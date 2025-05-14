<?php

namespace App\Controllers;
use App\Models\UserModel;

class Employee extends BaseController
{
    public function add()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        if (session('position') !== 'Admin') {
            return redirect()->to('/dashboard')->with('error', 'Access denied');
        }else{
            return view('AddEmployee');
        }
    }

    public function addprocess()
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
            'Employee_ID' => 'required|min_length[3]|max_length[10]',
            'Department_ID' => 'required|min_length[3]|max_length[10]',
            'Username' => 'required|min_length[3]|max_length[20]',
        ]);

        if ($this->request->getMethod() === 'POST') {
            if ($validation->withRequest($this->request)->run()) {

                // Cek validitas Departement_ID
                $departmentModel = new \App\Models\DepartmentModel();
                $department = $departmentModel->find($this->request->getPost('Department_ID'));

                if (!$department) {
                    return redirect()->to('/addemployee')->with('error', 'Department ID not valid');
                }

                $insertData = [
                    'Employee_ID' => $this->request->getPost('Employee_ID'),
                    'Department_ID' => $this->request->getPost('Department_ID'),
                    'Username' => $this->request->getPost('Username'),
                    'First_Name' => $this->request->getPost('First_Name'),
                    'Last_Name' => $this->request->getPost('Last_Name'),
                    'Employee_Password' => $this->request->getPost('Employee_Password'),
                    'Work_Email' => $this->request->getPost('Work_Email'),
                    'Phone_Number' => $this->request->getPost('Phone_Number'),
                ];

                $userModel->insert($insertData);

                return redirect()->to('/admin')->with('success', 'Add employee successfully!');
            } else {
                return redirect()->to('/employee')->with('error', $validation->getErrors());
            }
        }
    }

    public function edit($Employee_ID)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $userModel = new UserModel();
        $userData = $userModel->find($Employee_ID);

        if (!$userData){
            return redirect()->to('/admin')->with('error', 'User not found');
        }

        if (session('position') !== 'Admin') {
            return redirect()->to('/dashboard')->with('error', 'Access denied');
        }else{
            return view('EditEmployee', ['userData' => $userData]);
        }
    }

    public function editprocess($Employee_ID)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $userModel = new UserModel();
        $userData = $userModel->find($Employee_ID);

        if (!$userData){
            return redirect()->to('/login')->with('error', 'Employee was not found');
        }

        $validation =  \Config\Services::validation();
        $validation->setRules([
            'Employee_ID' => 'required|min_length[3]|max_length[10]',
            'Department_ID' => 'required|min_length[3]|max_length[10]',
            'Username' => 'required|min_length[3]|max_length[20]',
        ]);

        if ($this->request->getMethod() === 'POST') {
            if ($validation->withRequest($this->request)->run()) {

                // Cek validitas Departement_ID
                $departmentModel = new \App\Models\DepartmentModel();
                $department = $departmentModel->find($this->request->getPost('Department_ID'));

                if (!$department) {
                    return redirect()->to('/addemployee')->with('error', 'Department ID not valid');
                }

                $updatedData = [
                    'Employee_ID' => $this->request->getPost('Employee_ID'),
                    'Department_ID' => $this->request->getPost('Department_ID'),
                    'Username' => $this->request->getPost('Username'),
                    'First_Name' => $this->request->getPost('First_Name'),
                    'Last_Name' => $this->request->getPost('Last_Name'),
                    'Employee_Password' => $this->request->getPost('Employee_Password'),
                    'Work_Email' => $this->request->getPost('Work_Email'),
                    'Phone_Number' => $this->request->getPost('Phone_Number'),
                ];

                $userModel->update($userData['Employee_ID'], $updatedData);

                return redirect()->to('/admin')->with('success', 'Edit employee successfully!');
            } else {
                return redirect()->to('/employee/edit')->with('error', $validation->getErrors());
            }
        }
    }

    public function delete($Employee_ID)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $userModel = new UserModel();
        $userData = $userModel->find($Employee_ID);

        if (!$userData){
            return redirect()->to('/admin')->with('error', 'User not found');
        }

        $userModel->delete($userData['Employee_ID']);
        return redirect()->to('/admin')->with('success', 'Delete employee successfully!');
    }
}