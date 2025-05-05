<?php

namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'employee';
    protected $allowedFields = ['Username', 'Employee_Password'];
}