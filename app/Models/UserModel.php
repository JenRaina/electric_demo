<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table         = 'users';
    protected $primaryKey    = 'id';
    protected $allowedFields = [
        'first_name', 
        'last_name', 
        'email', 
        'phone', 
        'address', 
        'city', 
        'state', 
        'zip_code', 
        'password', 
        'user_type', 
        'is_active', 
        'email_verified'
    ];
}