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
    Schema::table('users', function (Blueprint $table) {
        if (!Schema::hasColumn('users', 'department_id')) {
            $table->foreignId('department_id')
                ->nullable()
                ->after('role_id')
                ->constrained('departments')
                ->nullOnDelete();
        }

        if (!Schema::hasColumn('users', 'is_department_head')) {
            $table->boolean('is_department_head')
                ->default(false)
                ->after('department_id');
        }
    });
}
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
