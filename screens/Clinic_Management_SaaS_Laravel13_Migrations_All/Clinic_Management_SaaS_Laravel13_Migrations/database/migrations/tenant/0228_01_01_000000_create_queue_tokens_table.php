<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'tenant';

    public function up(): void
    {
        Schema::create('queue_tokens', function (Blueprint $table) {
            $table->id();
            $table->char('public_id', 36);
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->unsignedBigInteger('provider_id')->nullable();
            $table->unsignedBigInteger('location_id')->nullable();
            $table->dateTime('scheduled_at', 6)->nullable();
            $table->string('status', 50)->nullable();
            $table->text('notes')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('created_at', 6)->useCurrent();
            $table->dateTime('updated_at', 6);
            $table->dateTime('deleted_at', 6)->nullable();
            $table->unique(['public_id'], 'uq_queue_tokens_public_id');
            $table->index(['status'], 'idx_queue_tokens_status');
            $table->index(['patient_id'], 'idx_queue_tokens_patient_id');
            $table->index(['provider_id'], 'idx_queue_tokens_provider_id');
            $table->index(['location_id'], 'idx_queue_tokens_location_id');
            $table->index(['created_at'], 'idx_queue_tokens_created_at');
            $table->index(['updated_at'], 'idx_queue_tokens_updated_at');
            $table->index(['scheduled_at'], 'idx_queue_tokens_scheduled_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('queue_tokens');
    }
};
