<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'tenant';

    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->char('public_id', 36);
            $table->string('username', 120)->nullable();
            $table->string('email', 190)->nullable();
            $table->string('phone', 30)->nullable();
            $table->string('password_hash', 255);
            $table->string('first_name', 100);
            $table->string('middle_name', 100)->nullable();
            $table->string('last_name', 100)->nullable();
            $table->string('display_name', 220)->nullable();
            $table->enum('status', ['INVITED', 'ACTIVE', 'INACTIVE', 'LOCKED'])->default('INVITED');
            $table->dateTime('last_login_at', 6)->nullable();
            $table->dateTime('password_changed_at', 6)->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('created_at', 6)->useCurrent();
            $table->dateTime('updated_at', 6);
            $table->dateTime('deleted_at', 6)->nullable();
            $table->unique(['public_id'], 'uq_users_public_id');
            $table->index(['status'], 'idx_users_status');
            $table->index(['created_at'], 'idx_users_created_at');
            $table->index(['updated_at'], 'idx_users_updated_at');
            $table->index(['email'], 'idx_users_email');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
