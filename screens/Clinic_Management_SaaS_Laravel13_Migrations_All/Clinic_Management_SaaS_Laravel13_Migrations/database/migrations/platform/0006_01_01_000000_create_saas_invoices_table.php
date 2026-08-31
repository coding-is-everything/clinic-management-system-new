<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'platform';

    public function up(): void
    {
        Schema::create('saas_invoices', function (Blueprint $table) {
            $table->id();
            $table->char('public_id', 36);
            $table->unsignedBigInteger('tenant_id');
            $table->string('invoice_no', 60);
            $table->date('billing_period_start');
            $table->date('billing_period_end');
            $table->decimal('subtotal', 14, 2)->default(0);
            $table->decimal('tax_amount', 14, 2)->default(0);
            $table->decimal('discount_amount', 14, 2)->default(0);
            $table->decimal('total_amount', 14, 2)->default(0);
            $table->char('currency_code', 3)->default('INR');
            $table->enum('status', ['DRAFT', 'ISSUED', 'PAID', 'PARTIALLY_PAID', 'VOID', 'OVERDUE'])->default('DRAFT');
            $table->date('due_date')->nullable();
            $table->dateTime('issued_at', 6)->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('created_at', 6)->useCurrent();
            $table->dateTime('updated_at', 6);
            $table->dateTime('deleted_at', 6)->nullable();
            $table->unique(['public_id'], 'uq_saas_invoices_public_id');
            $table->index(['status'], 'idx_saas_invoices_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('saas_invoices');
    }
};
