<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'tenant';

    public function up(): void
    {
        Schema::create('patient_analytics', function (Blueprint $table) {
            $table->id();
            $table->char('public_id', 36);
            $table->string('metric_code', 100);
            $table->date('metric_date');
            $table->decimal('value_decimal', 20, 6)->nullable();
            $table->bigInteger('value_integer')->nullable();
            $table->json('dimension')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('created_at', 6)->useCurrent();
            $table->dateTime('updated_at', 6);
            $table->dateTime('deleted_at', 6)->nullable();
            $table->unique(['public_id'], 'uq_patient_analytics_public_id');
            $table->index(['created_at'], 'idx_patient_analytics_created_at');
            $table->index(['updated_at'], 'idx_patient_analytics_updated_at');
            $table->index(['metric_date'], 'idx_patient_analytics_metric_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patient_analytics');
    }
};
