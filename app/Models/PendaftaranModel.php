<?php

namespace App\Models;

use CodeIgniter\Model;

class PendaftaranModel extends Model
{
    protected $table      = 'pendaftaran';
    protected $primaryKey     = 'id';
    protected $allowedFields  = ['name', 'nim', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'bulan_lahir', 'tahun_lahir', 'program_studi', 'image',];
    protected $useTimestamps   = true;
}
