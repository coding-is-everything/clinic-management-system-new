<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'platform';

    public function up(): void
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->char('public_id', 36);
            $table->unsignedBigInteger('tenant_id');
            $table->unsignedBigInteger('plan_id');
            $table->enum('status', ['TRIAL', 'ACTIVE', 'PAST_DUE', 'SUSPENDED', 'CANCELLED', 'EXPIRED']);
            $table->dateTime('start_at', 6);
            $table->dateTime('end_at', 6)->nullable();
            $table->dateTime('trial_end_at', 6)->nullable();
            $table->tinyInteger('auto_renew')->default(1);
            $table->string('external_subscription_ref', 190)->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('created_at', 6)->useCurrent();
            $table->dateTime('updated_at', 6);
            $table->dateTime('deleted_at', 6)->nullable();
            $table->unique(['public_id'], 'uq_subscriptions_public_id');
            $table->index(['status'], 'idx_subscriptions_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
