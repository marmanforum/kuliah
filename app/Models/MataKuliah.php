<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    public $timestamps = false;

    protected $table = 'mata_kuliah';

    protected $fillable = [
        'nama_mata_kuliah',
        'sks',
        'prodi_id',
    ];

    public function mahasiswa()
    {
        return $this->belongsToMany(
            Mahasiswa::class,
            'mata_kuliah_mahasiswa',
            'mata_kuliah_id',
            'mahasiswa_id'
        );
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }
}