<?php

namespace App\Models;
use CodeIgniter\Model;

class Employee_ProjectModel extends Model
{
    protected $table = 'employee_project';
    protected $primaryKey = 'Employee_Project_ID';
    protected $allowedFields = ['Employee_Project_ID', 'Document', 'Employee_ID', 'Project_ID'];
}