<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'tenant';

    public function up(): void
    {
        Schema::create('communication_templates', function (Blueprint $table) {
            $table->id();
            $table->char('public_id', 36);
            $table->string('code', 80);
            $table->string('name', 190);
            $table->string('channel', 40);
            $table->string('language_code', 10)->nullable();
            $table->string('subject', 255)->nullable();
            $table->longText('body');
            $table->json('variables')->nullable();
            $table->enum('status', ['DRAFT', 'ACTIVE', 'RETIRED'])->default('DRAFT');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('created_at', 6)->useCurrent();
            $table->dateTime('updated_at', 6);
            $table->dateTime('deleted_at', 6)->nullable();
            $table->unique(['public_id'], 'uq_communication_templates_public_id');
            $table->index(['status'], 'idx_communication_templates_status');
            $table->index(['created_at'], 'idx_communication_templates_created_at');
            $table->index(['updated_at'], 'idx_communication_templates_updated_at');
            $table->index(['code'], 'idx_communication_templates_code');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('communication_templates');
    }
};
