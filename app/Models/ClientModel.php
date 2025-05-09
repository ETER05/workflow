<?php

namespace App\Models;
use CodeIgniter\Model;

class ClientModel extends Model
{
    protected $table = 'client';
    protected $primaryKey = 'Client_ID';
    protected $allowedFields = ['Client_ID', 'Client_Name', 'Client_Contact', 'Client_Details'];
}