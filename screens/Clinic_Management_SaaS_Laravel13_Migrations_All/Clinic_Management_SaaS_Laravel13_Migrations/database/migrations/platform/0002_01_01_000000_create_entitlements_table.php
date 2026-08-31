<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'platform';

    public function up(): void
    {
        Schema::create('entitlements', function (Blueprint $table) {
            $table->id();
            $table->char('public_id', 36);
            $table->string('entitlement_code', 80);
            $table->string('name', 150);
            $table->enum('type', ['BOOLEAN', 'INTEGER', 'DECIMAL', 'TEXT'])->default('BOOLEAN');
            $table->string('default_value', 255)->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('is_active')->default(1);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('created_at', 6)->useCurrent();
            $table->dateTime('updated_at', 6);
            $table->dateTime('deleted_at', 6)->nullable();
            $table->unique(['public_id'], 'uq_entitlements_public_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('entitlements');
    }
};
