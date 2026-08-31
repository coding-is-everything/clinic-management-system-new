<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'tenant';

    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->char('public_id', 36);
            $table->string('code', 60);
            $table->string('name', 180);
            $table->string('service_type', 80)->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedSmallInteger('default_duration_minutes')->nullable();
            $table->decimal('default_price', 14, 2)->default(0);
            $table->tinyInteger('taxable')->default(1);
            $table->enum('status', ['DRAFT', 'ACTIVE', 'RETIRED'])->default('DRAFT');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('created_at', 6)->useCurrent();
            $table->dateTime('updated_at', 6);
            $table->dateTime('deleted_at', 6)->nullable();
            $table->unique(['public_id'], 'uq_services_public_id');
            $table->index(['status'], 'idx_services_status');
            $table->index(['created_at'], 'idx_services_created_at');
            $table->index(['updated_at'], 'idx_services_updated_at');
            $table->index(['code'], 'idx_services_code');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
