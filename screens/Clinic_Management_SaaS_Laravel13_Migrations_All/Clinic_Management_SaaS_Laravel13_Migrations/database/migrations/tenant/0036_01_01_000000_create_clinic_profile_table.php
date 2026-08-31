<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'tenant';

    public function up(): void
    {
        Schema::create('clinic_profile', function (Blueprint $table) {
            $table->id();
            $table->char('public_id', 36);
            $table->string('legal_name', 255);
            $table->string('display_name', 255);
            $table->string('registration_no', 120)->nullable();
            $table->string('tax_identifier', 120)->nullable();
            $table->string('primary_phone', 30)->nullable();
            $table->string('primary_email', 190)->nullable();
            $table->string('website', 255)->nullable();
            $table->json('address')->nullable();
            $table->json('branding')->nullable();
            $table->char('default_currency', 3)->default('INR');
            $table->string('default_timezone', 64)->default('Asia/Kolkata');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('created_at', 6)->useCurrent();
            $table->dateTime('updated_at', 6);
            $table->dateTime('deleted_at', 6)->nullable();
            $table->unique(['public_id'], 'uq_clinic_profile_public_id');
            $table->index(['created_at'], 'idx_clinic_profile_created_at');
            $table->index(['updated_at'], 'idx_clinic_profile_updated_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clinic_profile');
    }
};
