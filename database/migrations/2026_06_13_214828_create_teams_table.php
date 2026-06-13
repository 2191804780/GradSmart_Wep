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
        Schema::create('teams', function (Blueprint $table) {
    $table->id();
    $table->string('name', 100);
    $table->foreignId('department_id')->constrained('departments')->restrictOnDelete();
    $table->string('invite_code', 20)->unique()->nullable();
    $table->tinyInteger('max_members')->default(5);
    $table->foreignId('supervisor_id')->nullable()->constrained('users')->nullOnDelete();
    $table->foreignId('created_by')->constrained('users')->restrictOnDelete();
    $table->dateTime('created_at')->useCurrent();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
