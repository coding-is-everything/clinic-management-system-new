<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'tenant';

    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->char('public_id', 36);
            $table->string('appointment_no', 60);
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('provider_id');
            $table->unsignedBigInteger('service_id');
            $table->unsignedBigInteger('location_id');
            $table->dateTime('scheduled_start', 6);
            $table->dateTime('scheduled_end', 6);
            $table->enum('status', ['BOOKED', 'CONFIRMED', 'RESCHEDULED', 'CHECKED_IN', 'IN_QUEUE', 'IN_CONSULTATION', 'COMPLETED', 'CANCELLED', 'NO_SHOW'])->default('BOOKED');
            $table->string('booking_source', 40)->nullable();
            $table->text('reason')->nullable();
            $table->dateTime('confirmed_at', 6)->nullable();
            $table->dateTime('checked_in_at', 6)->nullable();
            $table->dateTime('completed_at', 6)->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('created_at', 6)->useCurrent();
            $table->dateTime('updated_at', 6);
            $table->dateTime('deleted_at', 6)->nullable();
            $table->unique(['public_id'], 'uq_appointments_public_id');
            $table->index(['status'], 'idx_appointments_status');
            $table->index(['patient_id'], 'idx_appointments_patient_id');
            $table->index(['provider_id'], 'idx_appointments_provider_id');
            $table->index(['location_id'], 'idx_appointments_location_id');
            $table->index(['created_at'], 'idx_appointments_created_at');
            $table->index(['updated_at'], 'idx_appointments_updated_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
