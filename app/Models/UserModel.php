<?php

namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'employee';
    protected $primaryKey = 'Employee_ID';
    protected $allowedFields = ['Username', 'Employee_Password', 'First_Name', 'Last_Name', 'Work_Email', 'Phone_Number', 'Department_ID', 'Position_ID', 'Employee_ID'];
}