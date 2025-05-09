<?php

namespace App\Models;
use CodeIgniter\Model;

class ProjectModel extends Model
{
    protected $table = 'project';
    protected $primaryKey = 'Project_ID';
    protected $allowedFields = ['Project_ID', 'Project_Name', 'Project_Description', 'Project_Status', 'Manager_ID', 'Client_ID'];
}