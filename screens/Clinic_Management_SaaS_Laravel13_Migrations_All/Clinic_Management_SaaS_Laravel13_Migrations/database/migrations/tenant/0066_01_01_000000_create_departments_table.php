<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'tenant';

    public function up(): void
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->char('public_id', 36);
            $table->unsignedBigInteger('location_id');
            $table->string('code', 50);
            $table->string('name', 150);
            $table->text('description')->nullable();
            $table->enum('status', ['ACTIVE', 'INACTIVE'])->default('ACTIVE');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('created_at', 6)->useCurrent();
            $table->dateTime('updated_at', 6);
            $table->dateTime('deleted_at', 6)->nullable();
            $table->unique(['public_id'], 'uq_departments_public_id');
            $table->index(['status'], 'idx_departments_status');
            $table->index(['location_id'], 'idx_departments_location_id');
            $table->index(['created_at'], 'idx_departments_created_at');
            $table->index(['updated_at'], 'idx_departments_updated_at');
            $table->index(['code'], 'idx_departments_code');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};
