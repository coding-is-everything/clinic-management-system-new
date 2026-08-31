<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'platform';

    public function up(): void
    {
        Schema::create('subscription_renewals', function (Blueprint $table) {
            $table->id();
            $table->char('public_id', 36);
            $table->unsignedBigInteger('subscription_id');
            $table->date('renewal_date');
            $table->decimal('amount', 14, 2);
            $table->char('currency_code', 3)->default('INR');
            $table->enum('status', ['UPCOMING', 'RENEWED', 'FAILED', 'CANCELLED'])->default('UPCOMING');
            $table->unsignedInteger('attempts')->default(0);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('created_at', 6)->useCurrent();
            $table->dateTime('updated_at', 6);
            $table->dateTime('deleted_at', 6)->nullable();
            $table->unique(['public_id'], 'uq_subscription_renewals_public_id');
            $table->index(['status'], 'idx_subscription_renewals_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subscription_renewals');
    }
};
