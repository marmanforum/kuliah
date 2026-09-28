<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    public $timestamps = false;

    protected $table = 'prodi';

    protected $fillable = [
        'nama_prodi',
        'akreditasi',
        'foto_profil',
    ];

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'prodi_id');
    }

    public function mataKuliah()
    {
        return $this->hasMany(MataKuliah::class, 'prodi_id');
    }
}
