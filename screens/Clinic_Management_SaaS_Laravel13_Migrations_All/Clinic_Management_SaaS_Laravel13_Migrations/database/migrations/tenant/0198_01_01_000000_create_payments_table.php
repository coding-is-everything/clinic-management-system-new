<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'tenant';

    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->char('public_id', 36);
            $table->string('payment_no', 60);
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('invoice_id')->nullable();
            $table->string('payment_method', 40);
            $table->string('reference_no', 190)->nullable();
            $table->decimal('amount', 14, 2);
            $table->char('currency_code', 3)->default('INR');
            $table->enum('status', ['PENDING', 'CONFIRMED', 'FAILED', 'REVERSED'])->default('PENDING');
            $table->dateTime('received_at', 6)->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('created_at', 6)->useCurrent();
            $table->dateTime('updated_at', 6);
            $table->dateTime('deleted_at', 6)->nullable();
            $table->unique(['public_id'], 'uq_payments_public_id');
            $table->index(['status'], 'idx_payments_status');
            $table->index(['patient_id'], 'idx_payments_patient_id');
            $table->index(['created_at'], 'idx_payments_created_at');
            $table->index(['updated_at'], 'idx_payments_updated_at');
            $table->index(['invoice_id'], 'idx_payments_invoice_id');
            $table->index(['reference_no'], 'idx_payments_reference_no');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
