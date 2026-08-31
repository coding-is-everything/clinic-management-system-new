<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'tenant';

    public function up(): void
    {
        Schema::create('document_templates', function (Blueprint $table) {
            $table->id();
            $table->char('public_id', 36);
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->string('title', 255)->nullable();
            $table->string('document_type', 100)->nullable();
            $table->unsignedBigInteger('file_object_id')->nullable();
            $table->string('status', 40)->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('created_at', 6)->useCurrent();
            $table->dateTime('updated_at', 6);
            $table->dateTime('deleted_at', 6)->nullable();
            $table->unique(['public_id'], 'uq_document_templates_public_id');
            $table->index(['status'], 'idx_document_templates_status');
            $table->index(['patient_id'], 'idx_document_templates_patient_id');
            $table->index(['created_at'], 'idx_document_templates_created_at');
            $table->index(['updated_at'], 'idx_document_templates_updated_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('document_templates');
    }
};
