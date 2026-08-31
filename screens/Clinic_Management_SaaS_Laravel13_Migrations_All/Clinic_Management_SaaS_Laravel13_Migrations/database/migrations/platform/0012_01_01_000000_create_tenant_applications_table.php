<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'platform';

    public function up(): void
    {
        Schema::create('tenant_applications', function (Blueprint $table) {
            $table->id();
            $table->char('public_id', 36);
            $table->string('application_no', 60);
            $table->string('requested_name', 255);
            $table->string('contact_name', 150);
            $table->string('contact_email', 190);
            $table->string('contact_phone', 30)->nullable();
            $table->json('business_address')->nullable();
            $table->string('requested_plan_code', 50)->nullable();
            $table->json('application_data')->nullable();
            $table->enum('status', ['DRAFT', 'SUBMITTED', 'UNDER_REVIEW', 'APPROVED', 'REJECTED', 'CANCELLED'])->default('DRAFT');
            $table->dateTime('submitted_at', 6)->nullable();
            $table->dateTime('reviewed_at', 6)->nullable();
            $table->unsignedBigInteger('reviewed_by')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('created_at', 6)->useCurrent();
            $table->dateTime('updated_at', 6);
            $table->dateTime('deleted_at', 6)->nullable();
            $table->unique(['public_id'], 'uq_tenant_applications_public_id');
            $table->index(['status'], 'idx_tenant_applications_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tenant_applications');
    }
};
