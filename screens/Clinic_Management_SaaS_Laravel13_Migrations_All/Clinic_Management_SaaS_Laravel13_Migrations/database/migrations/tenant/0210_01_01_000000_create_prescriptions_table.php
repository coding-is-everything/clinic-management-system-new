<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'tenant';

    public function up(): void
    {
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();
            $table->char('public_id', 36);
            $table->string('prescription_no', 60);
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('encounter_id')->nullable();
            $table->unsignedBigInteger('provider_id');
            $table->dateTime('issued_at', 6);
            $table->date('valid_until')->nullable();
            $table->enum('status', ['DRAFT', 'FINALIZED', 'PARTIALLY_DISPENSED', 'DISPENSED', 'CANCELLED', 'AMENDED'])->default('DRAFT');
            $table->text('notes')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('created_at', 6)->useCurrent();
            $table->dateTime('updated_at', 6);
            $table->dateTime('deleted_at', 6)->nullable();
            $table->unique(['public_id'], 'uq_prescriptions_public_id');
            $table->index(['status'], 'idx_prescriptions_status');
            $table->index(['patient_id'], 'idx_prescriptions_patient_id');
            $table->index(['provider_id'], 'idx_prescriptions_provider_id');
            $table->index(['created_at'], 'idx_prescriptions_created_at');
            $table->index(['updated_at'], 'idx_prescriptions_updated_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prescriptions');
    }
};
