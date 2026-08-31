<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'platform';

    public function up(): void
    {
        Schema::create('saas_invoice_items', function (Blueprint $table) {
            $table->id();
            $table->char('public_id', 36);
            $table->unsignedBigInteger('saas_invoice_id');
            $table->string('description', 255);
            $table->decimal('quantity', 12, 3)->default(1);
            $table->decimal('unit_price', 14, 2)->default(0);
            $table->decimal('tax_rate', 7, 4)->default(0);
            $table->decimal('tax_amount', 14, 2)->default(0);
            $table->decimal('line_total', 14, 2)->default(0);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('created_at', 6)->useCurrent();
            $table->dateTime('updated_at', 6);
            $table->dateTime('deleted_at', 6)->nullable();
            $table->unique(['public_id'], 'uq_saas_invoice_items_public_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('saas_invoice_items');
    }
};
