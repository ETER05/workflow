<?php

namespace App\Models;
use CodeIgniter\Model;

class OvertimeModel extends Model
{
    protected $table = 'overtime';
    protected $primaryKey = 'Overtime_ID';
    protected $allowedFields = ['Overtime_ID', 'Overtime_Date', 'Overtime_Start', 'Overtime_End', 'Status', 'Reason', 'Employee_ID'];
}