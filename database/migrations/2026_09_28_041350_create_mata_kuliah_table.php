<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (! Schema::hasTable('mata_kuliah')) {
            Schema::create('mata_kuliah', function (Blueprint $table) {
                $table->id();
                $table->string('nama_mata_kuliah', 150);
                $table->unsignedTinyInteger('sks');
                $table->foreignId('mahasiswa_id')->nullable()->constrained('mahasiswa')->nullOnDelete();
                $table->foreignId('prodi_id')->constrained('prodi')->cascadeOnDelete();
            });

            return;
        }

        Schema::table('mata_kuliah', function (Blueprint $table) {
            $table->id()->change();
            $table->unsignedBigInteger('mahasiswa_id')->nullable()->change();
            $table->unsignedBigInteger('prodi_id')->change();
            $table->foreign('mahasiswa_id')->references('id')->on('mahasiswa')->nullOnDelete();
            $table->foreign('prodi_id')->references('id')->on('prodi')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('mata_kuliah')) {
            Schema::table('mata_kuliah', function (Blueprint $table) {
                $table->dropForeign(['mahasiswa_id']);
                $table->dropForeign(['prodi_id']);
            });
        }
    }
};
