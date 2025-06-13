<?php

namespace App\Models;
use CodeIgniter\Model;

class SalaryModel extends Model
{
    protected $table = 'salary';
    protected $primaryKey = 'Salary_ID';
    protected $allowedFields = ['Salary_ID', 'Salary_Type', 'Salary_Date', 'Salary_Amount', 'Employee_ID'];
}