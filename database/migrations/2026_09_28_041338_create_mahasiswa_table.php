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
        if (! Schema::hasTable('mahasiswa')) {
            Schema::create('mahasiswa', function (Blueprint $table) {
                $table->id();
                $table->string('nim', 30)->unique();
                $table->string('nama_mahasiswa', 150);
                $table->string('jenis_kelamin', 20);
                $table->text('alamat');
                $table->string('foto_mahasiswa')->nullable();
                $table->foreignId('prodi_id')->constrained('prodi')->cascadeOnDelete();
            });

            return;
        }

        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->id()->change();
            $table->string('nim', 30)->nullable()->change();
            $table->string('nama_mahasiswa', 150)->nullable()->change();
            $table->string('jenis_kelamin', 20)->nullable()->change();
            $table->string('foto_mahasiswa')->nullable()->change();
            $table->unsignedBigInteger('prodi_id')->nullable()->change();
        });

        DB::table('mahasiswa')->where('jenis_kelamin', 'pria')->update(['jenis_kelamin' => 'Laki-laki']);
        DB::table('mahasiswa')->where('jenis_kelamin', 'wanita')->update(['jenis_kelamin' => 'Perempuan']);

        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->unique('nim');
            $table->foreign('prodi_id')->references('id')->on('prodi')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('mahasiswa')) {
            Schema::table('mahasiswa', function (Blueprint $table) {
                $table->dropForeign(['prodi_id']);
                $table->dropUnique(['nim']);
            });
        }
    }
};
