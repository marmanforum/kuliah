<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (! Schema::hasTable('mata_kuliah_mahasiswa')) {
            Schema::create('mata_kuliah_mahasiswa', function (Blueprint $table) {
                $table->id();
                $table->foreignId('mata_kuliah_id')->constrained('mata_kuliah')->cascadeOnDelete();
                $table->foreignId('mahasiswa_id')->constrained('mahasiswa')->cascadeOnDelete();
                $table->timestamps();

                $table->unique(['mata_kuliah_id', 'mahasiswa_id']);
            });
        }

        if (Schema::hasColumn('mata_kuliah', 'mahasiswa_id')) {
            $legacyRows = DB::table('mata_kuliah')->whereNotNull('mahasiswa_id')->get();

            foreach ($legacyRows as $row) {
                DB::table('mata_kuliah_mahasiswa')->updateOrInsert(
                    [
                        'mata_kuliah_id' => $row->id,
                        'mahasiswa_id' => $row->mahasiswa_id,
                    ],
                    [
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mata_kuliah_mahasiswa');
    }
};
