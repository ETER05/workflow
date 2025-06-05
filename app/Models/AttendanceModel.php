<?php

namespace App\Models;
use CodeIgniter\Model;

class AttendanceModel extends Model
{
    protected $table = 'attendance';
    protected $primaryKey = 'Attendance_ID';
    protected $allowedFields = ['Attendance_Date', 'In_Time', 'Out_Time', 'Employee_ID'];
}