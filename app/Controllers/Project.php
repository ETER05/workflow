<?php

namespace App\Controllers;
use App\Models\ProjectModel;

class Project extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $ProjectModel = new ProjectModel();

        $project = $ProjectModel
        ->select('project.*, client.Client_Name, employee.Username as Manager_Name')
        ->join('client', 'client.Client_ID = project.Client_ID', 'left')
        ->join('manager', 'manager.Manager_ID = project.Manager_ID', 'left')
        ->join('employee', 'employee.Employee_ID = manager.Employee_ID', 'left')
        ->findAll();

        return view('Project', ['project' => $project]);
    }

    public function add()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $ManagerModel = new \App\Models\ManagerModel();
        $UserModel = new \App\Models\UserModel();
        $ClientModel = new \App\Models\ClientModel();

        $manager = $ManagerModel
        ->join('employee', 'employee.Employee_ID = manager.Employee_ID')
        ->select('manager.Manager_ID, employee.Username')
        ->findAll();

        $client = $ClientModel->findAll();

        if (session('position') === 'Admin' || session('position') === 'Manager') {
            return view('AddProject', ['manager' => $manager, 'client' => $client]);
        }else{
            return redirect()->to('/dashboard')->with('error', 'Access denied');
        }
    }

    public function addprocess()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $ProjectModel = new ProjectModel();

        $validation =  \Config\Services::validation();
        $validation->setRules([
            'Project_Name' => 'required|min_length[3]',
            'Project_Description' => 'required|min_length[3]',
        ]);

        if ($this->request->getMethod() === 'POST') {
            if ($validation->withRequest($this->request)->run()) {

                $clientId = $this->request->getPost('Client_ID');
                $managerId = $this->request->getPost('Manager_ID');

                $insertData = [
                    'Project_Name' => $this->request->getPost('Project_Name'),
                    'Project_Description' => $this->request->getPost('Project_Description'),
                    'Project_Status' => $this->request->getPost('Project_Status'),
                    'Manager_ID' => $managerId !== '' ? $managerId : null,
                    'Client_ID' => $clientId !== '' ? $clientId : null,
                ];

                $ProjectModel->insert($insertData);

                return redirect()->to('/project')->with('success', 'Add project successfully!');
            } else {
                return redirect()->to('/project/add')->with('error', $validation->getErrors());
            }
        }
    }

    public function edit($Project_ID)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $ProjectModel = new ProjectModel();
        $ManagerModel = new \App\Models\ManagerModel();
        $ClientModel = new \App\Models\ClientModel();

        $ProjectData = $ProjectModel->find($Project_ID);

        $manager = $ManagerModel
        ->join('employee', 'employee.Employee_ID = manager.Employee_ID')
        ->select('manager.Manager_ID, employee.Username')
        ->findAll();

        $client = $ClientModel->findAll();

        if (!$ProjectData){
            return redirect()->to('/admin')->with('error', 'User not found');
        }

        if (session('position') === 'Admin' || session('position') === 'Manager') {
            return view('EditProject', ['ProjectData' => $ProjectData, 'manager' => $manager, 'client' => $client]);
        }else{
            return redirect()->to('/dashboard')->with('error', 'Access denied');
        }
    }

    public function editprocess($Project_ID)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $ProjectModel = new ProjectModel();

        $validation =  \Config\Services::validation();
        $validation->setRules([
            'Project_Name' => 'required|min_length[3]',
            'Project_Description' => 'required|min_length[3]',
        ]);

        if ($this->request->getMethod() === 'POST') {
            if ($validation->withRequest($this->request)->run()) {

                $clientId = $this->request->getPost('Client_ID');
                $managerId = $this->request->getPost('Manager_ID');

                $updateddata = [
                    'Project_Name' => $this->request->getPost('Project_Name'),
                    'Project_Description' => $this->request->getPost('Project_Description'),
                    'Project_Status' => $this->request->getPost('Project_Status'),
                    'Manager_ID' => $managerId !== '' ? $managerId : null,
                    'Client_ID' => $clientId !== '' ? $clientId : null,
                ];

                $ProjectModel->update($Project_ID, $updateddata);

                return redirect()->to('/project')->with('success', 'Edit project successfully!');
            } else {
                return redirect()->to('/project/edit')->with('error', $validation->getErrors());
            }
        }
    }

    public function delete($Project_ID)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $Project_Model = new ProjectModel();
        $Project_Data = $Project_Model->find($Project_ID);

        if (!$Project_Data){
            return redirect()->to('/admin')->with('error', 'Department not found');
        }

        if (session('position') === 'Admin' || session('position') === 'Manager') {
            $Project_Model->delete($Project_Data['Project_ID']);
            return redirect()->to('/project')->with('success', 'Delete Project successfully!');
        }else{
            return redirect()->to('/dashboard')->with('error', 'Access denied');
        }
    }

    public function view($Project_ID)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $ProjectModel = new ProjectModel();

        $project = $ProjectModel
            ->select('project.*, client.Client_Name, employee.Username as Manager_Name')
            ->join('client', 'client.Client_ID = project.Client_ID', 'left')
            ->join('manager', 'manager.Manager_ID = project.Manager_ID', 'left')
            ->join('employee', 'employee.Employee_ID = manager.Employee_ID', 'left')
            ->where('project.Project_ID', $Project_ID)
            ->first();

        if (!$project) {
            return redirect()->to('/project')->with('error', 'Project not found');
        }

        // Ambil dokumen dari database
        $EmployeeProjectModel = new \App\Models\Employee_ProjectModel();
        $documents = $EmployeeProjectModel
            ->where('Project_ID', $Project_ID)
            ->findAll();

        return view('ProjectView', ['project' => $project, 'documents' => $documents]);
    }


    public function upload($Project_ID)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }
    
        $ProjectModel = new ProjectModel();
        $project = $ProjectModel->find($Project_ID);
    
        if (!$project) {
            return redirect()->to('/project')->with('error', 'Project not found');
        }

        $employeeId = session()->get('employee_id');
        if (!$employeeId) {
            return redirect()->to('/project/view/' . $Project_ID)->with('error', 'Employee not logged in.');
        }
    
        $validation = \Config\Services::validation();
        $validation->setRules([
            'document' => 'uploaded[document]'
        ]);
    
        if ($this->request->getMethod() === 'POST' && $validation->withRequest($this->request)->run()) {
            $file = $this->request->getFile('document');
            $documentPath = WRITEPATH . 'uploads/' . $Project_ID;
        
            if (!is_dir($documentPath)) {
                mkdir($documentPath, 0777, true);
            }
        
            $originalName = $file->getName();
        
            // Cek apakah sudah ada file dengan nama dan ekstensi yang sama
            if (file_exists($documentPath . '/' . $originalName)) {
                return redirect()->to('/project/view/' . $Project_ID)->with('error', 'File dengan nama tersebut sudah ada.');
            }
        
            if ($file->isValid() && !$file->hasMoved()) {
                $file->move($documentPath, $originalName);
        
                // Simpan ke database
                $EmployeeProjectModel = new \App\Models\Employee_ProjectModel();
                $EmployeeProjectModel->insert([
                    'Employee_ID' => session()->get('employee_id'),
                    'Project_ID' => $Project_ID,
                    'Document' => $originalName
                ]);
        
                return redirect()->to('/project/view/' . $Project_ID)->with('success', 'File uploaded successfully!');
            } else {
                return redirect()->to('/project/view/' . $Project_ID)->with('error', 'Failed to upload file.');
            }
        }
    }
    
    public function download($Project_ID, $filename)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $EmployeeProjectModel = new \App\Models\Employee_ProjectModel();

        // Pastikan file benar-benar terdaftar di database
        $document = $EmployeeProjectModel
            ->where('Project_ID', $Project_ID)
            ->where('Document', $filename)
            ->first();

        if (!$document) {
            return redirect()->to('/project/view/' . $Project_ID)->with('error', 'File not found in database.');
        }

        $filePath = WRITEPATH . 'uploads/' . $Project_ID . '/' . $filename;

        if (!file_exists($filePath)) {
            return redirect()->to('/project/view/' . $Project_ID)->with('error', 'File not found on server.');
        }

        return $this->response->download($filePath, null);
    }

    public function deletefile($Project_ID, $Employee_Project_ID)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $EmployeeProjectModel = new \App\Models\Employee_ProjectModel();

        // Ambil data dokumen dari database
        $document = $EmployeeProjectModel->find($Employee_Project_ID);

        if (!$document || $document['Project_ID'] != $Project_ID) {
            return redirect()->to('/project/view/' . $Project_ID)->with('error', 'File not found.');
        }

        $filePath = WRITEPATH . 'uploads/' . $Project_ID . '/' . $document['Document'];

        // Hapus file dari server jika ada
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // Hapus data dari database
        $EmployeeProjectModel->delete($Employee_Project_ID);

        return redirect()->to('/project/view/' . $Project_ID)->with('success', 'File deleted successfully!');
    }
}