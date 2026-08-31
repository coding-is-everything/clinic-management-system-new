<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'tenant';

    public function up(): void
    {
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->id();
            $table->char('public_id', 36);
            $table->string('name', 190)->nullable();
            $table->text('description')->nullable();
            $table->string('status', 50)->nullable();
            $table->json('attributes')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('created_at', 6)->useCurrent();
            $table->dateTime('updated_at', 6);
            $table->dateTime('deleted_at', 6)->nullable();
            $table->unique(['public_id'], 'uq_password_reset_tokens_public_id');
            $table->index(['status'], 'idx_password_reset_tokens_status');
            $table->index(['created_at'], 'idx_password_reset_tokens_created_at');
            $table->index(['updated_at'], 'idx_password_reset_tokens_updated_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('password_reset_tokens');
    }
};
