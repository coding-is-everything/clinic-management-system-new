<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'tenant';

    public function up(): void
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->char('public_id', 36);
            $table->string('code', 150);
            $table->string('module_code', 80);
            $table->string('name', 150);
            $table->text('description')->nullable();
            $table->tinyInteger('is_system')->default(1);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('created_at', 6)->useCurrent();
            $table->dateTime('updated_at', 6);
            $table->dateTime('deleted_at', 6)->nullable();
            $table->unique(['public_id'], 'uq_permissions_public_id');
            $table->index(['created_at'], 'idx_permissions_created_at');
            $table->index(['updated_at'], 'idx_permissions_updated_at');
            $table->index(['code'], 'idx_permissions_code');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
