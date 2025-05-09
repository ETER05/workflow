<?php

namespace App\Controllers;
use App\Models\AttendanceModel;

class Attendance extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $check = session()->get('check');

        $username = session()->get('username');
        $employee_id = session()->get('employee_id');
        $model = new \App\Models\AttendanceModel();
        $attendance = $model->where('employee_id', $employee_id)->orderBy('Attendance_ID', 'DESC')->findAll();
        return view('Attendance', ['attendance' => $attendance, 'username' => $username, 'check' => $check]);
    }

    public function checkin()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $employee_id = session()->get('employee_id');
        $model = new \App\Models\AttendanceModel();

        date_default_timezone_set('Asia/Jakarta');
        $today = date('Y-m-d');
        
        $model->insert([
            'Employee_ID' => $employee_id,
            'Attendance_Date' => $today,
            'In_Time' => date('H:i:s'),
        ]);

        $check = session();
        $check->set([
            'check' => true,
        ]);

        return redirect()->to('/attendance');
    }

    public function checkout()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $model = new \App\Models\AttendanceModel();

        date_default_timezone_set('Asia/Jakarta');
        $today = date('Y-m-d');
        $employee_id = session()->get('employee_id');

        $existing = $model
        ->where('Employee_ID', $employee_id)
        ->where('Attendance_Date', $today)
        ->orderBy('Attendance_ID', 'DESC')
        ->first();

        $model->update($existing['Attendance_ID'], ['Out_Time' => date('H:i:s')]);
        session()->set('check', false);

        return redirect()->to('/attendance');
    }
}
