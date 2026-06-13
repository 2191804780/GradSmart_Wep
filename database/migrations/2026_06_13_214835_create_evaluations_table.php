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
     Schema::create('evaluations', function (Blueprint $table) {
    $table->id();
    $table->foreignId('team_id')->constrained('teams')->cascadeOnDelete();
    $table->foreignId('evaluator_id')->constrained('users')->restrictOnDelete();
    $table->enum('evaluation_type', ['SUPERVISOR', 'EXAMINER']);
    $table->decimal('score_documentation', 5, 2)->nullable();
    $table->decimal('score_implementation', 5, 2)->nullable();
    $table->decimal('score_presentation', 5, 2)->nullable();
    $table->decimal('total_score', 5, 2)->nullable();
    $table->text('feedback')->nullable();
    $table->dateTime('created_at')->useCurrent();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};
