<?php

namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'employee';
    protected $primaryKey = 'Employee_ID';
    protected $allowedFields = ['Employee_ID', 'Position', 'is_online', 'is_clocked_in', 'First_Name', 'Last_Name', 'Username', 'Employee_Password', 'Work_Email', 'Phone_Number', 'Department_ID'];
}