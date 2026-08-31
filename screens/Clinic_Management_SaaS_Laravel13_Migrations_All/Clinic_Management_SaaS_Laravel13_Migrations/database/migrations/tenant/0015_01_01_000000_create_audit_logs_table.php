<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'tenant';

    public function up(): void
    {
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->char('public_id', 36);
            $table->unsignedBigInteger('actor_user_id')->nullable();
            $table->string('event_type', 100);
            $table->string('entity_type', 100)->nullable();
            $table->unsignedBigInteger('entity_id')->nullable();
            $table->string('action', 80);
            $table->json('old_values')->nullable();
            $table->json('new_values')->nullable();
            $table->char('request_id', 36)->nullable();
            $table->binary('ip_address', length: 16)->nullable();
            $table->dateTime('occurred_at', 6);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('created_at', 6)->useCurrent();
            $table->dateTime('updated_at', 6);
            $table->dateTime('deleted_at', 6)->nullable();
            $table->unique(['public_id'], 'uq_audit_logs_public_id');
            $table->index(['created_at'], 'idx_audit_logs_created_at');
            $table->index(['updated_at'], 'idx_audit_logs_updated_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};
