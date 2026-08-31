<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'tenant';

    public function up(): void
    {
        Schema::create('lab_tests', function (Blueprint $table) {
            $table->id();
            $table->char('public_id', 36);
            $table->string('code', 80);
            $table->string('name', 190);
            $table->string('specimen_type', 100)->nullable();
            $table->string('result_type', 40)->default('TEXT');
            $table->string('unit', 40)->nullable();
            $table->json('reference_range')->nullable();
            $table->json('critical_range')->nullable();
            $table->unsignedInteger('turnaround_minutes')->nullable();
            $table->decimal('price', 14, 2)->default(0);
            $table->enum('status', ['ACTIVE', 'INACTIVE'])->default('ACTIVE');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('created_at', 6)->useCurrent();
            $table->dateTime('updated_at', 6);
            $table->dateTime('deleted_at', 6)->nullable();
            $table->unique(['public_id'], 'uq_lab_tests_public_id');
            $table->index(['status'], 'idx_lab_tests_status');
            $table->index(['created_at'], 'idx_lab_tests_created_at');
            $table->index(['updated_at'], 'idx_lab_tests_updated_at');
            $table->index(['code'], 'idx_lab_tests_code');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lab_tests');
    }
};
