<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'tenant';

    public function up(): void
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->id();
            $table->char('public_id', 36);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('provider_code', 50);
            $table->string('provider_type', 60);
            $table->string('first_name', 100);
            $table->string('last_name', 100)->nullable();
            $table->string('specialization', 150)->nullable();
            $table->string('license_no', 120)->nullable();
            $table->date('license_expiry')->nullable();
            $table->enum('status', ['ACTIVE', 'INACTIVE', 'ON_LEAVE'])->default('ACTIVE');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('created_at', 6)->useCurrent();
            $table->dateTime('updated_at', 6);
            $table->dateTime('deleted_at', 6)->nullable();
            $table->unique(['public_id'], 'uq_providers_public_id');
            $table->index(['status'], 'idx_providers_status');
            $table->index(['created_at'], 'idx_providers_created_at');
            $table->index(['updated_at'], 'idx_providers_updated_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('providers');
    }
};
