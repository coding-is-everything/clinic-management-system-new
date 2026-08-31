<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'platform';

    public function up(): void
    {
        Schema::create('saas_payments', function (Blueprint $table) {
            $table->id();
            $table->char('public_id', 36);
            $table->unsignedBigInteger('tenant_id');
            $table->unsignedBigInteger('saas_invoice_id');
            $table->string('payment_ref', 100);
            $table->string('provider', 80)->nullable();
            $table->string('provider_transaction_id', 190)->nullable();
            $table->decimal('amount', 14, 2);
            $table->char('currency_code', 3)->default('INR');
            $table->enum('status', ['PENDING', 'PAID', 'FAILED', 'REFUNDED'])->default('PENDING');
            $table->dateTime('paid_at', 6)->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('created_at', 6)->useCurrent();
            $table->dateTime('updated_at', 6);
            $table->dateTime('deleted_at', 6)->nullable();
            $table->unique(['public_id'], 'uq_saas_payments_public_id');
            $table->index(['status'], 'idx_saas_payments_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('saas_payments');
    }
};
