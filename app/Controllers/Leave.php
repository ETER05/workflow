<?php

namespace App\Controllers;
use App\Models\LeaveRequestModel;

class Leave extends BaseController
{   
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $LeaveRequestModel = new LeaveRequestModel();
        $leave = $LeaveRequestModel->findAll();

        return view('Leave', ['leave' => $leave]);
    }

    public function add()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        return view('AddLeave');
    }

    public function addprocess()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $LeaveRequestModel = new LeaveRequestModel();

        $validation =  \Config\Services::validation();
        $validation->setRules([
            'Leave_Type' => 'required|min_length[3]|max_length[10]',
            'Reason' => 'required|min_length[3]|max_length[100]',
        ]);

        if ($this->request->getMethod() === 'POST') {
            if ($validation->withRequest($this->request)->run()) {

                $employee = session()->get('employee_id');

                $insertData = [
                    'Leave_Type' => $this->request->getPost('Leave_Type'),
                    'Leave_Start' => $this->request->getPost('Leave_Start'),
                    'Leave_End' => $this->request->getPost('Leave_End'),
                    'Status' => 'Requesting',
                    'Reason' => $this->request->getPost('Reason'),
                    'Employee_ID' => $employee,
                ];

                $LeaveRequestModel->insert($insertData);

                return redirect()->to('/leave')->with('success', 'Add leave successfully!');
            } else {
                return redirect()->to('/leave/add')->with('error', $validation->getErrors());
            }
        }
    }

    public function delete($Leave_ID)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $LeaveRequestModel = new LeaveRequestModel();
        $LeaveData = $LeaveRequestModel->find($Leave_ID);

        if (!$LeaveData){
            return redirect()->to('/leave')->with('error', 'User not found');
        }

        $LeaveRequestModel->delete($LeaveData['Leave_ID']);
        return redirect()->to('/leave')->with('success', 'Pull leave successfully!');
    }

    public function approval()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $LeaveRequestModel = new LeaveRequestModel();
        $leave = $LeaveRequestModel
        ->select('leave_request.*, employee.Username, employee.Position')
        ->join('employee', 'employee.Employee_ID = leave_request.Employee_ID')
        ->findAll();

        if (session('position') === 'Admin' || session('position') === 'Manager') {
            return view('ApprovalLeave', ['leave' => $leave]);
        }else{
            return redirect()->to('/dashboard')->with('error', 'Access denied');
        }
    }

    public function approve($Leave_ID)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $LeaveRequestModel = new LeaveRequestModel();

        $leave = $LeaveRequestModel
        ->select('leave_request.*, employee.Position')
        ->join('employee', 'employee.Employee_ID = leave_request.Employee_ID')
        ->where('leave_request.Leave_ID', $Leave_ID)
        ->first();

        if (!$leave) {
            return redirect()->to('/leave/approval')->with('error', 'Data not found.');
        }

        $approverPosition = session('position');
        $requesterPosition = $leave['Position'];

        if (
            ($requesterPosition === 'Admin' && $approverPosition  !== 'Admin') ||
            ($requesterPosition === 'Manager' && $approverPosition  !== 'Admin') ||
            ($requesterPosition === 'Employee' && $approverPosition  === 'Employee')
        ) {
            return redirect()->to('/leave/approval')->with('error', 'You are not authorized to approve this request.');
        }

        $LeaveRequestModel->update($Leave_ID, ['Status' => 'Approved']);
        return redirect()->to('/leave/approval')->with('success', 'Leave approved!');
    }

    public function reject($Leave_ID)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $LeaveRequestModel = new LeaveRequestModel();

        $leave = $LeaveRequestModel
        ->select('leave_request.*, employee.Position')
        ->join('employee', 'employee.Employee_ID = leave_request.Employee_ID')
        ->where('leave_request.Leave_ID', $Leave_ID)
        ->first();

        if (!$leave) {
            return redirect()->to('/overtime/approval')->with('error', 'Data not found.');
        }

        $rejecterPosition = session('position');
        $requesterPosition = $leave['Position'];

        if (
            ($requesterPosition === 'Admin' && $rejecterPosition !== 'Admin') ||
            ($requesterPosition === 'Manager' && $rejecterPosition !== 'Admin') ||
            ($requesterPosition === 'Employee' && $rejecterPosition === 'Employee')
        ) {
            return redirect()->to('/leave/approval')->with('error', 'You are not authorized to approve this request.');
        }

        $LeaveRequestModel->update($Leave_ID, ['Status' => 'Rejected']);
        return redirect()->to('/leave/approval')->with('success', 'Leave rejected!');
    }
}