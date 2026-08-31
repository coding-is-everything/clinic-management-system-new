<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'platform';

    public function up(): void
    {
        Schema::create('usage_counters', function (Blueprint $table) {
            $table->id();
            $table->char('public_id', 36);
            $table->unsignedBigInteger('tenant_id');
            $table->string('metric_code', 100);
            $table->date('period_start');
            $table->date('period_end');
            $table->decimal('usage_value', 18, 4)->default(0);
            $table->decimal('limit_value', 18, 4)->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('created_at', 6)->useCurrent();
            $table->dateTime('updated_at', 6);
            $table->dateTime('deleted_at', 6)->nullable();
            $table->unique(['public_id'], 'uq_usage_counters_public_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usage_counters');
    }
};
