<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'tenant';

    public function up(): void
    {
        Schema::create('imaging_orders', function (Blueprint $table) {
            $table->id();
            $table->char('public_id', 36);
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->unsignedBigInteger('provider_id')->nullable();
            $table->unsignedBigInteger('order_id')->nullable();
            $table->string('status', 50)->nullable();
            $table->json('result_data')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('created_at', 6)->useCurrent();
            $table->dateTime('updated_at', 6);
            $table->dateTime('deleted_at', 6)->nullable();
            $table->unique(['public_id'], 'uq_imaging_orders_public_id');
            $table->index(['status'], 'idx_imaging_orders_status');
            $table->index(['patient_id'], 'idx_imaging_orders_patient_id');
            $table->index(['provider_id'], 'idx_imaging_orders_provider_id');
            $table->index(['created_at'], 'idx_imaging_orders_created_at');
            $table->index(['updated_at'], 'idx_imaging_orders_updated_at');
            $table->index(['order_id'], 'idx_imaging_orders_order_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('imaging_orders');
    }
};
