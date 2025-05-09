<?php

namespace App\Models;
use CodeIgniter\Model;

class LeaveRequestModel extends Model
{
    protected $table = 'leave_request';
    protected $primaryKey = 'Leave_ID';
    protected $allowedFields = ['Leave_ID', 'Leave_Type', 'Leave_Start', 'Leave_End', 'Status', 'Reason', 'Employee_ID'];
}