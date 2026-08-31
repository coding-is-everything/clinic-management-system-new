<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'platform';

    public function up(): void
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->char('public_id', 36);
            $table->string('plan_code', 50);
            $table->string('name', 150);
            $table->text('description')->nullable();
            $table->enum('billing_interval', ['MONTHLY', 'QUARTERLY', 'YEARLY', 'CUSTOM'])->default('MONTHLY');
            $table->decimal('base_price', 14, 2)->default(0);
            $table->char('currency_code', 3)->default('INR');
            $table->unsignedInteger('trial_days')->default(0);
            $table->tinyInteger('is_active')->default(1);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('created_at', 6)->useCurrent();
            $table->dateTime('updated_at', 6);
            $table->dateTime('deleted_at', 6)->nullable();
            $table->unique(['public_id'], 'uq_plans_public_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
