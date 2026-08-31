<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'tenant';

    public function up(): void
    {
        Schema::create('patient_flags', function (Blueprint $table) {
            $table->id();
            $table->char('public_id', 36);
            $table->unsignedBigInteger('patient_id');
            $table->json('details')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('created_at', 6)->useCurrent();
            $table->dateTime('updated_at', 6);
            $table->dateTime('deleted_at', 6)->nullable();
            $table->unique(['public_id'], 'uq_patient_flags_public_id');
            $table->index(['patient_id'], 'idx_patient_flags_patient_id');
            $table->index(['created_at'], 'idx_patient_flags_created_at');
            $table->index(['updated_at'], 'idx_patient_flags_updated_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patient_flags');
    }
};
