<?php

namespace App\Controllers;
use App\Models\OvertimeModel;

class Overtime extends BaseController
{   
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $OvertimeModel = new OvertimeModel();
        $overtime = $OvertimeModel->findAll();

        return view('Overtime', ['overtime' => $overtime]);
    }

    public function add()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        return view('AddOvertime');
    }

    public function addprocess()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $OvertimeModel = new OvertimeModel();

        $validation =  \Config\Services::validation();
        $validation->setRules([
            'Overtime_Date' => 'required|min_length[3]|max_length[10]',
            'Reason' => 'required|min_length[3]|max_length[100]',
        ]);

        if ($this->request->getMethod() === 'POST') {
            if ($validation->withRequest($this->request)->run()) {

                $employee = session()->get('employee_id');

                $insertData = [
                    'Overtime_Date' => $this->request->getPost('Overtime_Date'),
                    'Overtime_Start' => $this->request->getPost('Overtime_Start'),
                    'Overtime_End' => $this->request->getPost('Overtime_End'),
                    'Status' => 'Requesting',
                    'Employee_ID' => $employee,
                ];

                $OvertimeModel->insert($insertData);

                return redirect()->to('/overtime')->with('success', 'Add overtime successfully!');
            } else {
                return redirect()->to('/overtime/add')->with('error', $validation->getErrors());
            }
        }
    }

    public function delete($Overtime_ID)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $OvertimeModel = new OvertimeModel();
        $OvertimeData = $OvertimeModel->find($Overtime_ID);

        if (!$OvertimeData){
            return redirect()->to('/overtime')->with('error', 'User not found');
        }

        $OvertimeModel->delete($OvertimeData['Overtime_ID']);
        return redirect()->to('/overtime')->with('success', 'Pull overtime successfully!');
    }

    public function approval()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $OvertimeModel = new OvertimeModel();
        $overtime = $OvertimeModel
        ->select('overtime.*, employee.Username')
        ->join('employee', 'employee.Employee_ID = overtime.Employee_ID')
        ->findAll();

        if (session('position') === 'Admin' || session('position') === 'Manager') {
            return view('ApprovalOvertime', ['overtime' => $overtime]);
        }else{
            return redirect()->to('/dashboard')->with('error', 'Access denied');
        }
    }

    public function approve($Overtime_ID)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $OvertimeModel = new OvertimeModel();
        $OvertimeModel->update($Overtime_ID, ['Status' => 'Approved']);

        return redirect()->to('/overtime/approval')->with('success', 'Overtime approved!');
    }

    public function reject($Overtime_ID)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $OvertimeModel = new OvertimeModel();
        $OvertimeModel->update($Overtime_ID, ['Status' => 'Rejected']);

        return redirect()->to('/overtime/approval')->with('success', 'Overtime rejected!');
    }
}