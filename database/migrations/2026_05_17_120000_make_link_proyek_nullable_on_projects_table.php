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
        if (Schema::hasColumn('projects', 'nama_proyek') && ! Schema::hasColumn('projects', 'title')) {
            Schema::table('projects', fn (Blueprint $table) => $table->renameColumn('nama_proyek', 'title'));
        }

        if (Schema::hasColumn('projects', 'deskripsi') && ! Schema::hasColumn('projects', 'description')) {
            Schema::table('projects', fn (Blueprint $table) => $table->renameColumn('deskripsi', 'description'));
        }

        if (Schema::hasColumn('projects', 'foto_proyek') && ! Schema::hasColumn('projects', 'image')) {
            Schema::table('projects', fn (Blueprint $table) => $table->renameColumn('foto_proyek', 'image'));
        }

        if (Schema::hasColumn('projects', 'link_proyek') && ! Schema::hasColumn('projects', 'link')) {
            Schema::table('projects', fn (Blueprint $table) => $table->renameColumn('link_proyek', 'link'));
        }

        if (Schema::hasColumn('projects', 'link')) {
            Schema::table('projects', fn (Blueprint $table) => $table->string('link')->nullable()->change());
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('projects', 'title') && ! Schema::hasColumn('projects', 'nama_proyek')) {
            Schema::table('projects', fn (Blueprint $table) => $table->renameColumn('title', 'nama_proyek'));
        }

        if (Schema::hasColumn('projects', 'description') && ! Schema::hasColumn('projects', 'deskripsi')) {
            Schema::table('projects', fn (Blueprint $table) => $table->renameColumn('description', 'deskripsi'));
        }

        if (Schema::hasColumn('projects', 'image') && ! Schema::hasColumn('projects', 'foto_proyek')) {
            Schema::table('projects', fn (Blueprint $table) => $table->renameColumn('image', 'foto_proyek'));
        }

        if (Schema::hasColumn('projects', 'link') && ! Schema::hasColumn('projects', 'link_proyek')) {
            Schema::table('projects', fn (Blueprint $table) => $table->renameColumn('link', 'link_proyek'));
        }
    }
};
