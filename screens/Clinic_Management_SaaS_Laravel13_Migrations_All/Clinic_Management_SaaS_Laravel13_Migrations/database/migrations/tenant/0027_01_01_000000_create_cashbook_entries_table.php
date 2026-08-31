<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'tenant';

    public function up(): void
    {
        Schema::create('cashbook_entries', function (Blueprint $table) {
            $table->id();
            $table->char('public_id', 36);
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->unsignedBigInteger('invoice_id')->nullable();
            $table->decimal('amount', 14, 2)->nullable();
            $table->char('currency_code', 3)->nullable();
            $table->string('reference_no', 190)->nullable();
            $table->string('status', 50)->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('created_at', 6)->useCurrent();
            $table->dateTime('updated_at', 6);
            $table->dateTime('deleted_at', 6)->nullable();
            $table->unique(['public_id'], 'uq_cashbook_entries_public_id');
            $table->index(['status'], 'idx_cashbook_entries_status');
            $table->index(['patient_id'], 'idx_cashbook_entries_patient_id');
            $table->index(['created_at'], 'idx_cashbook_entries_created_at');
            $table->index(['updated_at'], 'idx_cashbook_entries_updated_at');
            $table->index(['invoice_id'], 'idx_cashbook_entries_invoice_id');
            $table->index(['reference_no'], 'idx_cashbook_entries_reference_no');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cashbook_entries');
    }
};
