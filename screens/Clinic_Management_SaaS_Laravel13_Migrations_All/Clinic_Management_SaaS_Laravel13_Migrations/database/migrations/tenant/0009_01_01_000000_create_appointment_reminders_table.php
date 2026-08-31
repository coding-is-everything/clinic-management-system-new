<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'tenant';

    public function up(): void
    {
        Schema::create('appointment_reminders', function (Blueprint $table) {
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
            $table->unique(['public_id'], 'uq_appointment_reminders_public_id');
            $table->index(['status'], 'idx_appointment_reminders_status');
            $table->index(['patient_id'], 'idx_appointment_reminders_patient_id');
            $table->index(['provider_id'], 'idx_appointment_reminders_provider_id');
            $table->index(['location_id'], 'idx_appointment_reminders_location_id');
            $table->index(['created_at'], 'idx_appointment_reminders_created_at');
            $table->index(['updated_at'], 'idx_appointment_reminders_updated_at');
            $table->index(['scheduled_at'], 'idx_appointment_reminders_scheduled_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointment_reminders');
    }
};
