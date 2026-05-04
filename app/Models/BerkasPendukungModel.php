<?php

namespace App\Models;

use CodeIgniter\Model;

class BerkasPendukungModel extends Model
{
    protected $table            = 'berkas_pendukung';
    protected $primaryKey       = 'user_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'file_kk', 'file_pkh', 'file_kip', 'file_akte'];
}
