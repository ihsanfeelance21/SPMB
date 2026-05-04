<?php

namespace App\Models;

use CodeIgniter\Model;

class BiodataModel extends Model
{
    protected $table            = 'biodata';
    protected $primaryKey       = 'user_id';
    protected $useAutoIncrement = false; // Because it's foreign key from users.id
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id', 
        'jenis_identitas', 
        'no_identitas', 
        'nama_lengkap', 
        'pas_foto', 
        'file_identitas'
    ];
}
