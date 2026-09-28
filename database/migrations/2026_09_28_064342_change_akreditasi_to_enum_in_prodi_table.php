<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE prodi
            MODIFY akreditasi ENUM(
                'unggul',
                'baik',
                'sangat baik',
                'belum terakreditasi'
            ) NULL
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE prodi
            MODIFY akreditasi VARCHAR(50) NULL
        ");
    }
};