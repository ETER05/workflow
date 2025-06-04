<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\ManagerModel;

class Employee extends BaseController
{
    public function add()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        if (session('position') === 'Admin' || session('position') === 'Manager') {
            return view('AddEmployee');
        }else{
            return redirect()->to('/dashboard')->with('error', 'Access denied');
        }
    }

    public function addprocess()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        if (session('position') !== 'Admin' && session('position') !== 'Manager') {
            return redirect()->to('/dashboard')->with('error', 'Access denied');
        }

        $UserModel = new UserModel();

        $validation =  \Config\Services::validation();
        $validation->setRules([
            'Employee_ID' => 'required|min_length[3]|max_length[10]',
            'Department_ID' => 'required|min_length[3]|max_length[10]',
            'Username' => 'required|min_length[3]|max_length[20]',
        ]);

        if ($this->request->getMethod() === 'POST') {
            if ($validation->withRequest($this->request)->run()) {

                // Cek validitas Departement_ID
                $DepartmentModel = new \App\Models\DepartmentModel();
                $department = $DepartmentModel->find($this->request->getPost('Department_ID'));

                if (!$department) {
                    return redirect()->to('/employee/add')->with('error', 'Department ID not valid');
                }

                $position = $this->request->getPost('Position');
                $currentPosition = session('position');

                if ($currentPosition === 'Manager' && $position !== 'Employee') {
                    return redirect()->to('/employee/add')->with('error', 'Manager can only add Employee');
                }

                $insertData = [
                    'Employee_ID' => $this->request->getPost('Employee_ID'),
                    'Department_ID' => $this->request->getPost('Department_ID'),
                    'Username' => $this->request->getPost('Username'),
                    'First_Name' => $this->request->getPost('First_Name'),
                    'Last_Name' => $this->request->getPost('Last_Name'),
                    'Position' => $this->request->getPost('Position'),
                    'Employee_Password' => $this->request->getPost('Employee_Password'),
                    'Work_Email' => $this->request->getPost('Work_Email'),
                    'Phone_Number' => $this->request->getPost('Phone_Number'),
                ];

                $UserModel->insert($insertData);

                if ($insertData['Position'] === 'Manager') {
                    $ManagerModel = new ManagerModel();
                
                    $ManagerData = [
                        'Manager_ID' => $insertData['Employee_ID'],
                        'Employee_ID' => $insertData['Employee_ID'],
                    ];
                
                    $ManagerModel->insert($ManagerData);
                }

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

        $UserModel = new UserModel();
        $UserData = $UserModel->find($Employee_ID);

        if (!$UserData){
            return redirect()->to('/admin')->with('error', 'User not found');
        }

        $currentPosition = session('position');
        $targetPosition = $UserData['Position'];

        if (($currentPosition === 'Admin') || ($currentPosition === 'Manager' && $targetPosition === 'Employee')) {
            return view('EditEmployee', ['UserData' => $UserData]);
        } else {
            return redirect()->to('/dashboard')->with('error', 'Access denied');
        }
    }

    public function editprocess($Employee_ID)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $UserModel = new UserModel();
        $UserData = $UserModel->find($Employee_ID);

        if (!$UserData){
            return redirect()->to('/login')->with('error', 'Employee was not found');
        }

        // --- Permission Access ---
        $currentPosition = session('position');
        $targetPosition = $UserData['Position'];

        if (($currentPosition === 'Admin') || ($currentPosition === 'Manager' && $targetPosition === 'Employee')) {
           // Admin bisa edit siapa saja dan Manager hanya bisa edit Employee
        } else {
            return redirect()->to('/dashboard')->with('error', 'Access denied');
        }
        // --- Permission Access ---

        $validation =  \Config\Services::validation();
        $validation->setRules([
            'Employee_ID' => 'required|min_length[3]|max_length[10]',
            'Department_ID' => 'required|min_length[3]|max_length[10]',
            'Username' => 'required|min_length[3]|max_length[20]',
        ]);

        
        if ($this->request->getMethod() === 'POST') {
            if ($validation->withRequest($this->request)->run()) {

                // Cek validitas Departement_ID
                $DepartmentModel = new \App\Models\DepartmentModel();
                $department = $DepartmentModel->find($this->request->getPost('Department_ID'));

                if (!$department) {
                    return redirect()->to('/addemployee')->with('error', 'Department ID not valid');
                }

                $updatedData = [
                    'Employee_ID' => $this->request->getPost('Employee_ID'),
                    'Department_ID' => $this->request->getPost('Department_ID'),
                    'Username' => $this->request->getPost('Username'),
                    'First_Name' => $this->request->getPost('First_Name'),
                    'Last_Name' => $this->request->getPost('Last_Name'),
                    'Position' => $this->request->getPost('Position'),
                    'Employee_Password' => $this->request->getPost('Employee_Password'),
                    'Work_Email' => $this->request->getPost('Work_Email'),
                    'Phone_Number' => $this->request->getPost('Phone_Number'),
                ];

                $UserModel->update($UserData['Employee_ID'], $updatedData);

                $ManagerModel = new ManagerModel();
                // Cek apakah posisi sekarang adalah Manager
                if ($updatedData['Position'] === 'Manager') {
                    // Cek apakah sudah ada di tabel manager
                    $existingManager = $ManagerModel->find($updatedData['Employee_ID']);

                    // Jika belum ada, insert
                    if (!$existingManager) {
                        $ManagerModel->insert([
                            'Manager_ID' => $updatedData['Employee_ID'],
                            'Employee_ID' => $updatedData['Employee_ID'],
                        ]);
                    }
                } else {
                    // Jika posisi bukan manager dan sebelumnya ada di tabel manager, hapus
                    $existingManager = $ManagerModel->find($updatedData['Employee_ID']);
                    if ($existingManager) {
                        $ManagerModel->delete($updatedData['Employee_ID']);
                    }
                }

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

        $UserModel = new UserModel();
        $UserData = $UserModel->find($Employee_ID);

        if (!$UserData){
            return redirect()->to('/admin')->with('error', 'User not found');
        }

        $currentPosition = session('position');
        $targetPosition = $UserData['Position'];

        if (($currentPosition === 'Admin') || ($currentPosition === 'Manager' && $targetPosition === 'Employee')) {
            $UserModel->delete($UserData['Employee_ID']);

            // Hapus juga dari tabel Manager jika ada
            $ManagerModel = new ManagerModel();
            $existingManager = $ManagerModel->find($UserData['Employee_ID']);
            if ($existingManager) {
                $ManagerModel->delete($UserData['Employee_ID']);
            }

            return redirect()->to('/admin')->with('success', 'Delete employee successfully!');
        } else {
            return redirect()->to('/dashboard')->with('error', 'Access denied');
        }
    }
}