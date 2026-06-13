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
        Schema::create('comments', function (Blueprint $table) {
    $table->id();
    $table->foreignId('project_id')->nullable()->constrained('projects')->cascadeOnDelete();
    $table->foreignId('task_id')->nullable()->constrained('tasks')->cascadeOnDelete();
    $table->foreignId('user_id')->constrained('users')->restrictOnDelete();
    $table->text('content');
    $table->dateTime('created_at')->useCurrent();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
