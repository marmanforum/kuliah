<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::getDriverName() !== 'mysql') {
            return;
        }

        DB::statement("
            ALTER TABLE prodi
            MODIFY akreditasi ENUM(
                'unggul',
                'baik',
                'sangat baik',
                'belum terakreditasi'
            ) NOT NULL
        ");
    }

    public function down(): void
    {
        if (DB::getDriverName() !== 'mysql') {
            return;
        }

        DB::statement("
            ALTER TABLE prodi
            MODIFY akreditasi VARCHAR(255) NOT NULL
        ");
    }
};