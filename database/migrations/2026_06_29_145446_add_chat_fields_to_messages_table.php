<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->string('conversation_type')->default('private')->after('receiver_id');
            $table->unsignedBigInteger('team_id')->nullable()->after('conversation_type');
            $table->string('attachment_path')->nullable()->after('content');
            $table->string('attachment_name')->nullable()->after('attachment_path');
        });
    }

    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropColumn([
                'conversation_type',
                'team_id',
                'attachment_path',
                'attachment_name',
            ]);
        });
    }
};