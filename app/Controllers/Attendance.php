<?php

namespace App\Controllers;
use App\Models\AttendanceModel;
use App\Models\UserModel;

class Attendance extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $username = session()->get('username');
        $employee_id = session()->get('employee_id');

        $attendanceModel = new AttendanceModel();
        $attendance = $attendanceModel
            ->where('employee_id', $employee_id)
            ->orderBy('Attendance_ID', 'DESC')
            ->findAll();

        $UserModel = new UserModel();
        $user = $UserModel->find($employee_id);
        $check = $user['is_clocked_in']; // TRUE = sudah check-in

        return view('Attendance', [
            'attendance' => $attendance,
            'username' => $username,
            'check' => $check,
        ]);
    }

    public function checkin()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $employee_id = session()->get('employee_id');
        $model = new AttendanceModel();
        $UserModel = new UserModel();

        date_default_timezone_set('Asia/Jakarta');
        $today = date('Y-m-d');
        
        $model->insert([
            'Employee_ID' => $employee_id,
            'Attendance_Date' => $today,
            'In_Time' => date('H:i:s'),
        ]);

        $UserModel->update($employee_id, ['is_clocked_in' => 1]);
        return redirect()->to('/attendance');
    }

    public function checkout()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $model = new \App\Models\AttendanceModel();
        $UserModel = new UserModel();

        date_default_timezone_set('Asia/Jakarta');
        $today = date('Y-m-d');
        $employee_id = session()->get('employee_id');

        $existing = $model
        ->where('Employee_ID', $employee_id)
        ->where('Attendance_Date', $today)
        ->orderBy('Attendance_ID', 'DESC')
        ->first();

        $model->update($existing['Attendance_ID'], ['Out_Time' => date('H:i:s')]);
        $UserModel->update($employee_id, ['is_clocked_in' => 0]);

        return redirect()->to('/attendance');
    }
}
