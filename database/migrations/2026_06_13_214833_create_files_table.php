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
       Schema::create('files', function (Blueprint $table) {
        $table->id();
        $table->foreignId('project_id')->constrained('projects')->cascadeOnDelete();
        $table->string('filename', 255);
        $table->string('path', 500);
        $table->bigInteger('size');
        $table->smallInteger('version')->default(1);
        $table->boolean('is_final_submission')->default(false);
        $table->foreignId('uploaded_by')->constrained('users')->restrictOnDelete();
        $table->dateTime('uploaded_at')->useCurrent();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
