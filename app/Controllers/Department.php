<?php

namespace App\Controllers;
use App\Models\DepartmentModel;

class Department extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $DepartmentModel = new DepartmentModel();
        $department = $DepartmentModel->findAll();

        return view('Department', ['department' => $department]);
    }

    public function add()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        if (session('position') !== 'Admin') {
            return redirect()->to('/dashboard')->with('error', 'Access denied');
        }else{
            return view('AddDepartment');
        }
    }

    public function addprocess()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $DepartmentModel = new DepartmentModel();

        $validation =  \Config\Services::validation();
        $validation->setRules([
            'Department_ID' => 'required|min_length[3]|max_length[10]',
            'Department_Name' => 'required|min_length[3]|max_length[20]',
        ]);

        if ($this->request->getMethod() === 'POST') {
            if ($validation->withRequest($this->request)->run()) {

                $insertData = [
                    'Department_ID' => $this->request->getPost('Department_ID'),
                    'Department_Name' => $this->request->getPost('Department_Name'),
                    'Description' => $this->request->getPost('Description'),
                    'Parent_Structure' => $this->request->getPost('Parent_Structure'),
                ];

                $DepartmentModel->insert($insertData);

                return redirect()->to('/department')->with('success', 'Add department successfully!');
            } else {
                return redirect()->to('/department/add')->with('error', $validation->getErrors());
            }
        }
    }

    public function edit($Department_ID)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $DepartmentModel = new DepartmentModel();
        $DepartmentData = $DepartmentModel->find($Department_ID);

        if (!$DepartmentData){
            return redirect()->to('/admin')->with('error', 'User not found');
        }

        if (session('position') !== 'Admin') {
            return redirect()->to('/dashboard')->with('error', 'Access denied');
        }else{
            return view('EditDepartment', ['DepartmentData' => $DepartmentData]);
        }
    }

    public function editprocess($Department_ID)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $DepartmentModel = new DepartmentModel();

        $validation =  \Config\Services::validation();
        $validation->setRules([
            'Department_ID' => 'required|min_length[3]|max_length[10]',
            'Department_Name' => 'required|min_length[3]|max_length[20]',
        ]);

        if ($this->request->getMethod() === 'POST') {
            if ($validation->withRequest($this->request)->run()) {

                $department = $DepartmentModel->find($this->request->getPost('Department_ID'));

                if (!$department) {
                    return redirect()->to('/addemployee')->with('error', 'Department ID not valid');
                }

                $updateddata = [
                    'Department_ID' => $this->request->getPost('Department_ID'),
                    'Department_Name' => $this->request->getPost('Department_Name'),
                    'Description' => $this->request->getPost('Description'),
                    'Parent_Structure' => $this->request->getPost('Parent_Structure'),
                ];

                $DepartmentModel->update($Department_ID, $updateddata);

                return redirect()->to('/department')->with('success', 'Edit employee successfully!');
            } else {
                return redirect()->to('/department/edit')->with('error', $validation->getErrors());
            }
        }
    }

    public function delete($Department_ID)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $DepartmentModel = new DepartmentModel();
        $DepartmentData = $DepartmentModel->find($Department_ID);

        if (!$DepartmentData){
            return redirect()->to('/admin')->with('error', 'Department not found');
        }

        $DepartmentModel->delete($DepartmentData['Department_ID']);
        return redirect()->to('/department')->with('success', 'Delete employee successfully!');
    }
}