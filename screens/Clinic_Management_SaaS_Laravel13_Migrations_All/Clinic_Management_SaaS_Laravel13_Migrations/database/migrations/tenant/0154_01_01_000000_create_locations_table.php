<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'tenant';

    public function up(): void
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->char('public_id', 36);
            $table->string('code', 50);
            $table->string('name', 150);
            $table->string('location_type', 50)->default('CLINIC');
            $table->unsignedBigInteger('parent_location_id')->nullable();
            $table->string('phone', 30)->nullable();
            $table->string('email', 190)->nullable();
            $table->json('address')->nullable();
            $table->enum('status', ['ACTIVE', 'INACTIVE'])->default('ACTIVE');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('created_at', 6)->useCurrent();
            $table->dateTime('updated_at', 6);
            $table->dateTime('deleted_at', 6)->nullable();
            $table->unique(['public_id'], 'uq_locations_public_id');
            $table->index(['status'], 'idx_locations_status');
            $table->index(['created_at'], 'idx_locations_created_at');
            $table->index(['updated_at'], 'idx_locations_updated_at');
            $table->index(['code'], 'idx_locations_code');
            $table->index(['email'], 'idx_locations_email');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
