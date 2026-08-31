<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'tenant';

    public function up(): void
    {
        Schema::create('dispensing_items', function (Blueprint $table) {
            $table->id();
            $table->char('public_id', 36);
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->unsignedBigInteger('provider_id')->nullable();
            $table->unsignedBigInteger('medicine_id')->nullable();
            $table->decimal('quantity', 12, 3)->nullable();
            $table->string('dose', 100)->nullable();
            $table->string('frequency', 100)->nullable();
            $table->string('status', 50)->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('created_at', 6)->useCurrent();
            $table->dateTime('updated_at', 6);
            $table->dateTime('deleted_at', 6)->nullable();
            $table->unique(['public_id'], 'uq_dispensing_items_public_id');
            $table->index(['status'], 'idx_dispensing_items_status');
            $table->index(['patient_id'], 'idx_dispensing_items_patient_id');
            $table->index(['provider_id'], 'idx_dispensing_items_provider_id');
            $table->index(['created_at'], 'idx_dispensing_items_created_at');
            $table->index(['updated_at'], 'idx_dispensing_items_updated_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dispensing_items');
    }
};
