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
        if (! Schema::hasTable('prodi')) {
            Schema::create('prodi', function (Blueprint $table) {
                $table->id();
                $table->string('nama_prodi', 150);
                $table->string('akreditasi', 50);
                $table->string('foto_profil')->nullable();
            });

            return;
        }

        if (Schema::hasColumn('prodi', 'akreditas') && ! Schema::hasColumn('prodi', 'akreditasi')) {
            Schema::table('prodi', fn (Blueprint $table) => $table->renameColumn('akreditas', 'akreditasi'));
        }

        if (Schema::hasColumn('prodi', 'foto_prodi') && ! Schema::hasColumn('prodi', 'foto_profil')) {
            Schema::table('prodi', fn (Blueprint $table) => $table->renameColumn('foto_prodi', 'foto_profil'));
        }

        Schema::table('prodi', function (Blueprint $table) {
            if (! Schema::hasColumn('prodi', 'nama_prodi')) {
                $table->string('nama_prodi', 150)->nullable();
            }

            if (! Schema::hasColumn('prodi', 'akreditasi')) {
                $table->string('akreditasi', 50)->nullable();
            } else {
                $table->string('akreditasi', 50)->nullable()->change();
            }

            if (! Schema::hasColumn('prodi', 'foto_profil')) {
                $table->string('foto_profil')->nullable();
            } else {
                $table->string('foto_profil')->nullable()->change();
            }

            $table->id()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Keep existing program data intact when rolling back this compatibility migration.
    }
};
