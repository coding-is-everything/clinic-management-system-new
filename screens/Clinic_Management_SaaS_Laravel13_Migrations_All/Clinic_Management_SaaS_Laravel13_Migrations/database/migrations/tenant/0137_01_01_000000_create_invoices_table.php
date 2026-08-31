<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'tenant';

    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->char('public_id', 36);
            $table->string('invoice_no', 60);
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('location_id');
            $table->date('invoice_date');
            $table->date('due_date')->nullable();
            $table->decimal('subtotal', 14, 2)->default(0);
            $table->decimal('discount_amount', 14, 2)->default(0);
            $table->decimal('tax_amount', 14, 2)->default(0);
            $table->decimal('total_amount', 14, 2)->default(0);
            $table->decimal('paid_amount', 14, 2)->default(0);
            $table->decimal('balance_amount', 14, 2)->default(0);
            $table->enum('status', ['DRAFT', 'ISSUED', 'PARTIALLY_PAID', 'PAID', 'CANCELLED', 'OVERDUE'])->default('DRAFT');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('created_at', 6)->useCurrent();
            $table->dateTime('updated_at', 6);
            $table->dateTime('deleted_at', 6)->nullable();
            $table->unique(['public_id'], 'uq_invoices_public_id');
            $table->index(['status'], 'idx_invoices_status');
            $table->index(['patient_id'], 'idx_invoices_patient_id');
            $table->index(['location_id'], 'idx_invoices_location_id');
            $table->index(['created_at'], 'idx_invoices_created_at');
            $table->index(['updated_at'], 'idx_invoices_updated_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
