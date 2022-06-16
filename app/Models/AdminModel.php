<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table         = 'user';
    protected $useTimestamps = false;
    protected $allowedFields = ['username', 'password', 'nama', 'tempat_lahir', 'tanggal_lahir', 'gender', 'telepon', 'email', 'avatar'];
}
