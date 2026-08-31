<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'tenant';

    public function up(): void
    {
        Schema::create('inventory_batches', function (Blueprint $table) {
            $table->id();
            $table->char('public_id', 36);
            $table->unsignedBigInteger('inventory_item_id');
            $table->string('batch_no', 100);
            $table->date('manufacture_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->decimal('purchase_cost', 14, 2)->nullable();
            $table->decimal('selling_price', 14, 2)->nullable();
            $table->decimal('current_quantity', 12, 3)->default(0);
            $table->enum('status', ['ACTIVE', 'EXPIRED', 'BLOCKED', 'DEPLETED'])->default('ACTIVE');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('created_at', 6)->useCurrent();
            $table->dateTime('updated_at', 6);
            $table->dateTime('deleted_at', 6)->nullable();
            $table->unique(['public_id'], 'uq_inventory_batches_public_id');
            $table->index(['status'], 'idx_inventory_batches_status');
            $table->index(['created_at'], 'idx_inventory_batches_created_at');
            $table->index(['updated_at'], 'idx_inventory_batches_updated_at');
            $table->index(['inventory_item_id'], 'idx_inventory_batches_inventory_item_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventory_batches');
    }
};
