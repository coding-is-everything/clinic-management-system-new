<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'platform';

    public function up(): void
    {
        Schema::create('tenant_provisioning_logs', function (Blueprint $table) {
            $table->id();
            $table->char('public_id', 36);
            $table->unsignedBigInteger('tenant_id');
            $table->char('operation_id', 36);
            $table->string('step', 100);
            $table->enum('status', ['STARTED', 'COMPLETED', 'FAILED', 'SKIPPED']);
            $table->text('message')->nullable();
            $table->json('details')->nullable();
            $table->dateTime('started_at', 6);
            $table->dateTime('completed_at', 6)->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('created_at', 6)->useCurrent();
            $table->dateTime('updated_at', 6);
            $table->dateTime('deleted_at', 6)->nullable();
            $table->unique(['public_id'], 'uq_tenant_provisioning_logs_public_id');
            $table->index(['status'], 'idx_tenant_provisioning_logs_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tenant_provisioning_logs');
    }
};
