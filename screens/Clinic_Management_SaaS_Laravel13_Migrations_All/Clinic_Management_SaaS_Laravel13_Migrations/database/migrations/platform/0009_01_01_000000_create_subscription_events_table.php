<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'platform';

    public function up(): void
    {
        Schema::create('subscription_events', function (Blueprint $table) {
            $table->id();
            $table->char('public_id', 36);
            $table->unsignedBigInteger('subscription_id');
            $table->string('event_type', 80);
            $table->string('provider_event_id', 190)->nullable();
            $table->json('payload')->nullable();
            $table->dateTime('processed_at', 6)->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('created_at', 6)->useCurrent();
            $table->dateTime('updated_at', 6);
            $table->dateTime('deleted_at', 6)->nullable();
            $table->unique(['public_id'], 'uq_subscription_events_public_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subscription_events');
    }
};
