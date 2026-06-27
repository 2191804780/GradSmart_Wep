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
    Schema::create('team_invitations', function (Blueprint $table) {
        $table->id();
        $table->foreignId('team_id')->constrained('teams')->cascadeOnDelete();
        $table->foreignId('invited_user_id')->constrained('users')->cascadeOnDelete();
        $table->foreignId('invited_by')->constrained('users')->cascadeOnDelete();
        $table->string('member_role')->default('MEMBER');
        $table->text('note')->nullable();
        $table->enum('status', ['PENDING', 'ACCEPTED', 'REJECTED'])->default('PENDING');
        $table->timestamp('created_at')->useCurrent();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_invitations');
    }
};
