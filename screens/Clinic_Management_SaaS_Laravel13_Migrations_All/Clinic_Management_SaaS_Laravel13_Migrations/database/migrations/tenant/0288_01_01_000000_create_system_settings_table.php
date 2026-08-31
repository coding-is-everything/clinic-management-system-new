<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'tenant';

    public function up(): void
    {
        Schema::create('system_settings', function (Blueprint $table) {
            $table->id();
            $table->char('public_id', 36);
            $table->string('setting_group', 100);
            $table->string('setting_key', 150);
            $table->json('setting_value')->nullable();
            $table->tinyInteger('is_encrypted')->default(0);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('created_at', 6)->useCurrent();
            $table->dateTime('updated_at', 6);
            $table->dateTime('deleted_at', 6)->nullable();
            $table->unique(['public_id'], 'uq_system_settings_public_id');
            $table->index(['created_at'], 'idx_system_settings_created_at');
            $table->index(['updated_at'], 'idx_system_settings_updated_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('system_settings');
    }
};
