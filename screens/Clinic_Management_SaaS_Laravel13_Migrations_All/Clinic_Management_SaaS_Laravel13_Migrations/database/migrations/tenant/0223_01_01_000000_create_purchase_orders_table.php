<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'tenant';

    public function up(): void
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->char('public_id', 36);
            $table->unsignedBigInteger('location_id')->nullable();
            $table->unsignedBigInteger('inventory_item_id')->nullable();
            $table->decimal('quantity', 12, 3)->nullable();
            $table->decimal('unit_cost', 14, 2)->nullable();
            $table->string('status', 50)->nullable();
            $table->string('reference_no', 100)->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('created_at', 6)->useCurrent();
            $table->dateTime('updated_at', 6);
            $table->dateTime('deleted_at', 6)->nullable();
            $table->unique(['public_id'], 'uq_purchase_orders_public_id');
            $table->index(['status'], 'idx_purchase_orders_status');
            $table->index(['location_id'], 'idx_purchase_orders_location_id');
            $table->index(['created_at'], 'idx_purchase_orders_created_at');
            $table->index(['updated_at'], 'idx_purchase_orders_updated_at');
            $table->index(['inventory_item_id'], 'idx_purchase_orders_inventory_item_id');
            $table->index(['reference_no'], 'idx_purchase_orders_reference_no');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};
