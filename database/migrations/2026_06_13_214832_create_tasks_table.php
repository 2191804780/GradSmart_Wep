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
       Schema::create('tasks', function (Blueprint $table) {
    $table->id();
    $table->foreignId('parent_id')->nullable()->constrained('tasks')->cascadeOnDelete();
    $table->string('title', 200);
    $table->text('description')->nullable();
    $table->enum('status', ['TODO', 'IN_PROGRESS', 'DONE'])->default('TODO');
    $table->date('deadline');
    $table->foreignId('project_id')->constrained('projects')->cascadeOnDelete();
    $table->foreignId('assigned_to')->nullable()->constrained('users')->nullOnDelete();
    $table->foreignId('created_by')->constrained('users')->restrictOnDelete();
    $table->dateTime('created_at')->useCurrent();
  });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
