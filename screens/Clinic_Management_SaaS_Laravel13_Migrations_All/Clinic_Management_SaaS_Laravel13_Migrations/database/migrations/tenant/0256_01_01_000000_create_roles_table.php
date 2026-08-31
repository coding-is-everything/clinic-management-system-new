<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'tenant';

    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->char('public_id', 36);
            $table->string('name', 100);
            $table->string('code', 80);
            $table->text('description')->nullable();
            $table->tinyInteger('is_system')->default(0);
            $table->tinyInteger('is_active')->default(1);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('created_at', 6)->useCurrent();
            $table->dateTime('updated_at', 6);
            $table->dateTime('deleted_at', 6)->nullable();
            $table->unique(['public_id'], 'uq_roles_public_id');
            $table->index(['created_at'], 'idx_roles_created_at');
            $table->index(['updated_at'], 'idx_roles_updated_at');
            $table->index(['code'], 'idx_roles_code');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
