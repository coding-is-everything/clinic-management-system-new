<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'tenant';

    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->char('public_id', 36);
            $table->string('document_no', 80);
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->string('document_type', 100);
            $table->string('title', 255);
            $table->text('description')->nullable();
            $table->enum('status', ['DRAFT', 'AVAILABLE', 'ARCHIVED', 'REVOKED'])->default('DRAFT');
            $table->unsignedInteger('current_version_no')->default(1);
            $table->date('retention_until')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('created_at', 6)->useCurrent();
            $table->dateTime('updated_at', 6);
            $table->dateTime('deleted_at', 6)->nullable();
            $table->unique(['public_id'], 'uq_documents_public_id');
            $table->index(['status'], 'idx_documents_status');
            $table->index(['patient_id'], 'idx_documents_patient_id');
            $table->index(['created_at'], 'idx_documents_created_at');
            $table->index(['updated_at'], 'idx_documents_updated_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
