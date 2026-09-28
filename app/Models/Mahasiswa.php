<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    public $timestamps = false;

    protected $table = 'mahasiswa';

    protected $fillable = [
        'nim',
        'nama_mahasiswa',
        'jenis_kelamin',
        'alamat',
        'foto_mahasiswa',
        'prodi_id',
    ];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }

    public function mataKuliah()
    {
        return $this->belongsToMany(
            MataKuliah::class,
            'mata_kuliah_mahasiswa',
            'mahasiswa_id',
            'mata_kuliah_id'
        );
    }
}