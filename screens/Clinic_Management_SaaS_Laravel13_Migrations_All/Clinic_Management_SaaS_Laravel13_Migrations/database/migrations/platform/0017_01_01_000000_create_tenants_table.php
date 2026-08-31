<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'platform';

    public function up(): void
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->char('public_id', 36);
            $table->string('tenant_code', 50);
            $table->string('legal_name', 255);
            $table->string('display_name', 255);
            $table->enum('status', ['PROVISIONING', 'READY', 'ACTIVE', 'SUSPENDED', 'ARCHIVED', 'DECOMMISSIONED'])->default('PROVISIONING');
            $table->string('timezone', 64)->default('Asia/Kolkata');
            $table->char('currency_code', 3)->default('INR');
            $table->string('locale', 20)->default('en-IN');
            $table->string('primary_contact_name', 150)->nullable();
            $table->string('primary_contact_email', 190)->nullable();
            $table->string('primary_contact_phone', 30)->nullable();
            $table->json('metadata')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('created_at', 6)->useCurrent();
            $table->dateTime('updated_at', 6);
            $table->dateTime('deleted_at', 6)->nullable();
            $table->unique(['public_id'], 'uq_tenants_public_id');
            $table->index(['status'], 'idx_tenants_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
};
