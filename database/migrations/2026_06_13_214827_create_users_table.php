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
        Schema::create('users', function (Blueprint $table) {
    $table->id();
    $table->string('student_id', 20)->unique()->nullable();
    $table->string('name', 100);
    $table->string('email', 150)->unique();
    $table->string('password', 255);
    $table->foreignId('role_id')->constrained('roles')->restrictOnDelete()->cascadeOnUpdate();
    $table->string('profile_image', 255)->nullable();
    $table->boolean('is_active')->default(true);
    $table->dateTime('created_at')->useCurrent();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
