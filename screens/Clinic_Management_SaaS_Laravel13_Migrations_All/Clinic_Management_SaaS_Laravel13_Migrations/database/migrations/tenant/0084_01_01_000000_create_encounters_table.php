<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'tenant';

    public function up(): void
    {
        Schema::create('encounters', function (Blueprint $table) {
            $table->id();
            $table->char('public_id', 36);
            $table->string('encounter_no', 60);
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('appointment_id')->nullable();
            $table->unsignedBigInteger('provider_id');
            $table->unsignedBigInteger('location_id');
            $table->string('encounter_type', 80);
            $table->dateTime('started_at', 6);
            $table->dateTime('ended_at', 6)->nullable();
            $table->enum('status', ['DRAFT', 'IN_PROGRESS', 'FINALIZED', 'AMENDED', 'CLOSED', 'CANCELLED'])->default('DRAFT');
            $table->tinyInteger('confidential')->default(0);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('created_at', 6)->useCurrent();
            $table->dateTime('updated_at', 6);
            $table->dateTime('deleted_at', 6)->nullable();
            $table->unique(['public_id'], 'uq_encounters_public_id');
            $table->index(['status'], 'idx_encounters_status');
            $table->index(['patient_id'], 'idx_encounters_patient_id');
            $table->index(['provider_id'], 'idx_encounters_provider_id');
            $table->index(['location_id'], 'idx_encounters_location_id');
            $table->index(['created_at'], 'idx_encounters_created_at');
            $table->index(['updated_at'], 'idx_encounters_updated_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('encounters');
    }
};
