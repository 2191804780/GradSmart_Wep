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
        Schema::create('ai_reports', function (Blueprint $table) {
    $table->id();
    $table->foreignId('project_id')->constrained('projects')->cascadeOnDelete();
    $table->enum('risk_level', ['LOW', 'MEDIUM', 'HIGH', 'UNDEFINED']);
    $table->float('delay_probability');
    $table->float('completion_rate');
    $table->float('time_consumed_rate');
    $table->dateTime('generated_at')->useCurrent();
   });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ai_reports');
    }
};
