<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'tenant';

    public function up(): void
    {
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();
            $table->char('public_id', 36);
            $table->string('code', 80);
            $table->string('generic_name', 190);
            $table->string('brand_name', 190)->nullable();
            $table->string('drug_class', 120)->nullable();
            $table->string('route', 80)->nullable();
            $table->tinyInteger('controlled_flag')->default(0);
            $table->tinyInteger('high_alert_flag')->default(0);
            $table->enum('status', ['ACTIVE', 'INACTIVE'])->default('ACTIVE');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('created_at', 6)->useCurrent();
            $table->dateTime('updated_at', 6);
            $table->dateTime('deleted_at', 6)->nullable();
            $table->unique(['public_id'], 'uq_medicines_public_id');
            $table->index(['status'], 'idx_medicines_status');
            $table->index(['created_at'], 'idx_medicines_created_at');
            $table->index(['updated_at'], 'idx_medicines_updated_at');
            $table->index(['code'], 'idx_medicines_code');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medicines');
    }
};
