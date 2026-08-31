<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'platform';

    public function up(): void
    {
        Schema::create('subscription_changes', function (Blueprint $table) {
            $table->id();
            $table->char('public_id', 36);
            $table->unsignedBigInteger('subscription_id');
            $table->string('from_plan_code', 50)->nullable();
            $table->string('to_plan_code', 50);
            $table->dateTime('effective_at', 6);
            $table->text('reason')->nullable();
            $table->enum('status', ['REQUESTED', 'SCHEDULED', 'APPLIED', 'CANCELLED'])->default('REQUESTED');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('created_at', 6)->useCurrent();
            $table->dateTime('updated_at', 6);
            $table->dateTime('deleted_at', 6)->nullable();
            $table->unique(['public_id'], 'uq_subscription_changes_public_id');
            $table->index(['status'], 'idx_subscription_changes_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subscription_changes');
    }
};
