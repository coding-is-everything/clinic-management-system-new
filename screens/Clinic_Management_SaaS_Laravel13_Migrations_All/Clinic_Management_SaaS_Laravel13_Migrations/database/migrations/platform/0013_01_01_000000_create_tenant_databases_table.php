<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'platform';

    public function up(): void
    {
        Schema::create('tenant_databases', function (Blueprint $table) {
            $table->id();
            $table->char('public_id', 36);
            $table->unsignedBigInteger('tenant_id');
            $table->string('connection_key', 100);
            $table->string('database_name', 150);
            $table->string('database_host', 255);
            $table->unsignedSmallInteger('database_port')->default(3306);
            $table->string('database_engine', 50)->default('mysql');
            $table->string('schema_version', 50)->nullable();
            $table->string('credential_secret_ref', 255);
            $table->enum('status', ['PENDING', 'PROVISIONING', 'READY', 'FAILED', 'MIGRATING', 'DISABLED'])->default('PENDING');
            $table->dateTime('last_health_check_at', 6)->nullable();
            $table->dateTime('last_migration_at', 6)->nullable();
            $table->json('metadata')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('created_at', 6)->useCurrent();
            $table->dateTime('updated_at', 6);
            $table->dateTime('deleted_at', 6)->nullable();
            $table->unique(['public_id'], 'uq_tenant_databases_public_id');
            $table->index(['status'], 'idx_tenant_databases_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tenant_databases');
    }
};
