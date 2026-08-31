<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'tenant';

    public function up(): void
    {
        Schema::create('inventory_items', function (Blueprint $table) {
            $table->id();
            $table->char('public_id', 36);
            $table->string('sku', 80);
            $table->string('name', 190);
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('uom_id');
            $table->string('item_type', 50);
            $table->tinyInteger('track_batch')->default(1);
            $table->tinyInteger('track_expiry')->default(0);
            $table->enum('status', ['ACTIVE', 'INACTIVE'])->default('ACTIVE');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('created_at', 6)->useCurrent();
            $table->dateTime('updated_at', 6);
            $table->dateTime('deleted_at', 6)->nullable();
            $table->unique(['public_id'], 'uq_inventory_items_public_id');
            $table->index(['status'], 'idx_inventory_items_status');
            $table->index(['created_at'], 'idx_inventory_items_created_at');
            $table->index(['updated_at'], 'idx_inventory_items_updated_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventory_items');
    }
};
