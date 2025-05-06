<?php

namespace App\Models;
use CodeIgniter\Model;

class DepartmentModel extends Model
{
    protected $table = 'department';
    protected $primaryKey = 'Department_ID';
    protected $allowedFields = ['Department_ID', 'Department_Name', 'Description', 'Parent_Structure'];
}