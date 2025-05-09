<?php

namespace App\Models;
use CodeIgniter\Model;

class ManagerModel extends Model
{
    protected $table = 'manager';
    protected $primaryKey = 'Manager_ID';
    protected $allowedFields = ['Manager_ID','Employee_ID'];
}