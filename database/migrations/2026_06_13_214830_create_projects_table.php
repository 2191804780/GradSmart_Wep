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
       Schema::create('projects', function (Blueprint $table) {
    $table->id();
    $table->string('title', 200);
    $table->text('description')->nullable();
    $table->enum('status', ['ACTIVE', 'ARCHIVED', 'COMPLETED'])->default('ACTIVE');
    $table->foreignId('team_id')->unique()->constrained('teams')->restrictOnDelete();
    $table->foreignId('supervisor_id')->nullable()->constrained('users')->nullOnDelete();
    $table->date('expected_end_date');
    $table->date('actual_end_date')->nullable();
    $table->decimal('progress', 5, 2)->default(0.00);
    $table->dateTime('created_at')->useCurrent();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
