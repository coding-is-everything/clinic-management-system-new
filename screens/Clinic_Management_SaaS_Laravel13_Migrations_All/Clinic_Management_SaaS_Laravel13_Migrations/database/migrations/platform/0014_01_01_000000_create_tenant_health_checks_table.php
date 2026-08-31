<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'platform';

    public function up(): void
    {
        Schema::create('tenant_health_checks', function (Blueprint $table) {
            $table->id();
            $table->char('public_id', 36);
            $table->unsignedBigInteger('tenant_id');
            $table->string('check_type', 80);
            $table->enum('status', ['HEALTHY', 'DEGRADED', 'FAILED', 'UNKNOWN']);
            $table->unsignedInteger('latency_ms')->nullable();
            $table->string('schema_version', 50)->nullable();
            $table->json('details')->nullable();
            $table->dateTime('checked_at', 6);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('created_at', 6)->useCurrent();
            $table->dateTime('updated_at', 6);
            $table->dateTime('deleted_at', 6)->nullable();
            $table->unique(['public_id'], 'uq_tenant_health_checks_public_id');
            $table->index(['status'], 'idx_tenant_health_checks_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tenant_health_checks');
    }
};
