<?php

namespace App\Models;
use CodeIgniter\Model;

class OvertimeProjectModel extends Model
{
    protected $table = 'overtime_project';
    protected $primaryKey = 'Overtime_Project_ID';
    protected $allowedFields = ['Overtime_Project_ID', 'Document', 'Employee_ID', 'Project_ID', 'Overtime_ID'];
}