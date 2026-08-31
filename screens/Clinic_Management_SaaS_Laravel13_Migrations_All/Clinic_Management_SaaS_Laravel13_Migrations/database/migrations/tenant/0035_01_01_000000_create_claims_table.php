<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'tenant';

    public function up(): void
    {
        Schema::create('claims', function (Blueprint $table) {
            $table->id();
            $table->char('public_id', 36);
            $table->string('claim_no', 70);
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('insurance_member_id')->nullable();
            $table->unsignedBigInteger('invoice_id')->nullable();
            $table->unsignedBigInteger('payer_id');
            $table->date('claim_date');
            $table->decimal('claimed_amount', 14, 2)->default(0);
            $table->decimal('approved_amount', 14, 2)->nullable();
            $table->decimal('deducted_amount', 14, 2)->default(0);
            $table->enum('status', ['DRAFT', 'SUBMITTED', 'ACKNOWLEDGED', 'APPROVED', 'PARTIAL', 'DENIED', 'SETTLED', 'CLOSED'])->default('DRAFT');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('created_at', 6)->useCurrent();
            $table->dateTime('updated_at', 6);
            $table->dateTime('deleted_at', 6)->nullable();
            $table->unique(['public_id'], 'uq_claims_public_id');
            $table->index(['status'], 'idx_claims_status');
            $table->index(['patient_id'], 'idx_claims_patient_id');
            $table->index(['created_at'], 'idx_claims_created_at');
            $table->index(['updated_at'], 'idx_claims_updated_at');
            $table->index(['invoice_id'], 'idx_claims_invoice_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('claims');
    }
};
