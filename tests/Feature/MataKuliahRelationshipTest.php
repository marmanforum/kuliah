<?php

namespace Tests\Feature;

use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use App\Models\Prodi;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MataKuliahRelationshipTest extends TestCase
{
    use RefreshDatabase;

    public function test_mahasiswa_and_mata_kuliah_have_many_to_many_relationship(): void
    {
        $prodi = Prodi::create([
            'nama_prodi' => 'Sistem Informasi',
            'akreditasi' => 'A',
        ]);

        $mahasiswa1 = Mahasiswa::create([
            'nim' => '2024001',
            'nama_mahasiswa' => 'Muhammad Fadil Prabawa',
            'jenis_kelamin' => 'Laki-laki',
            'alamat' => 'Bandung',
            'prodi_id' => $prodi->id,
        ]);

        $mahasiswa2 = Mahasiswa::create([
            'nim' => '2024002',
            'nama_mahasiswa' => 'Andi',
            'jenis_kelamin' => 'Laki-laki',
            'alamat' => 'Jakarta',
            'prodi_id' => $prodi->id,
        ]);

        $mataKuliah = MataKuliah::create([
            'nama_mata_kuliah' => 'Teknik Manajemen',
            'sks' => 3,
            'prodi_id' => $prodi->id,
        ]);

        $mataKuliah->mahasiswa()->attach([$mahasiswa1->id, $mahasiswa2->id]);

        $this->assertCount(2, $mataKuliah->fresh()->mahasiswa);
        $this->assertCount(1, $mahasiswa1->fresh()->mataKuliah);
        $this->assertTrue($mahasiswa1->fresh()->mataKuliah->contains(fn ($item) => $item->id === $mataKuliah->id));
    }
}
