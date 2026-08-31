<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'tenant';

    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->char('public_id', 36);
            $table->string('patient_no', 60);
            $table->string('mrn', 80)->nullable();
            $table->string('first_name', 100);
            $table->string('middle_name', 100)->nullable();
            $table->string('last_name', 100)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('gender', 40)->nullable();
            $table->string('blood_group', 10)->nullable();
            $table->string('primary_phone', 30)->nullable();
            $table->string('email', 190)->nullable();
            $table->string('preferred_language', 50)->nullable();
            $table->enum('status', ['ACTIVE', 'INACTIVE', 'ARCHIVED', 'DECEASED'])->default('ACTIVE');
            $table->text('notes')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('created_at', 6)->useCurrent();
            $table->dateTime('updated_at', 6);
            $table->dateTime('deleted_at', 6)->nullable();
            $table->unique(['public_id'], 'uq_patients_public_id');
            $table->index(['status'], 'idx_patients_status');
            $table->index(['created_at'], 'idx_patients_created_at');
            $table->index(['updated_at'], 'idx_patients_updated_at');
            $table->index(['email'], 'idx_patients_email');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
