<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'tenant';

    public function up(): void
    {
        Schema::create('provider_api_logs', function (Blueprint $table) {
            $table->id();
            $table->char('public_id', 36);
            $table->string('event_type', 80)->nullable();
            $table->string('reference_type', 100)->nullable();
            $table->unsignedBigInteger('reference_id')->nullable();
            $table->text('message')->nullable();
            $table->json('payload')->nullable();
            $table->dateTime('event_at', 6)->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('created_at', 6)->useCurrent();
            $table->dateTime('updated_at', 6);
            $table->dateTime('deleted_at', 6)->nullable();
            $table->unique(['public_id'], 'uq_provider_api_logs_public_id');
            $table->index(['created_at'], 'idx_provider_api_logs_created_at');
            $table->index(['updated_at'], 'idx_provider_api_logs_updated_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('provider_api_logs');
    }
};
