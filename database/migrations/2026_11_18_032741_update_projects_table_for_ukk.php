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
        Schema::table('projects', function (Blueprint $table) {
            $table->string('category')->default('Web Application')->after('title');
            $table->text('problem_statement')->nullable()->after('description');
            $table->text('project_objective')->nullable()->after('problem_statement');
            $table->string('tech_stack')->nullable()->after('project_objective');
            $table->string('role')->default('Fullstack Developer')->after('tech_stack');
            $table->text('features')->nullable()->after('role');
            $table->string('demo_url')->nullable()->after('features');
            $table->string('github_url')->nullable()->after('demo_url');
            $table->text('process_flow')->nullable()->after('github_url');
            $table->text('user_feedback')->nullable()->after('process_flow');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn([
                'category',
                'problem_statement',
                'project_objective',
                'tech_stack',
                'role',
                'features',
                'demo_url',
                'github_url',
                'process_flow',
                'user_feedback',
            ]);
        });
    }
};
