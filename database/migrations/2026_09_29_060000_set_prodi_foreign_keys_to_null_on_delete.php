<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->dropForeign(['prodi_id']);
        });

        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->unsignedBigInteger('prodi_id')->nullable()->change();
        });

        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->foreign('prodi_id')->references('id')->on('prodi')->nullOnDelete();
        });

        Schema::table('mata_kuliah', function (Blueprint $table) {
            $table->dropForeign(['prodi_id']);
        });

        Schema::table('mata_kuliah', function (Blueprint $table) {
            $table->unsignedBigInteger('prodi_id')->nullable()->change();
        });

        Schema::table('mata_kuliah', function (Blueprint $table) {
            $table->foreign('prodi_id')->references('id')->on('prodi')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->dropForeign(['prodi_id']);
            $table->foreign('prodi_id')->references('id')->on('prodi')->cascadeOnDelete();
        });

        Schema::table('mata_kuliah', function (Blueprint $table) {
            $table->dropForeign(['prodi_id']);
            $table->foreign('prodi_id')->references('id')->on('prodi')->cascadeOnDelete();
        });
    }
};