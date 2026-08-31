<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'tenant';

    public function up(): void
    {
        Schema::create('file_objects', function (Blueprint $table) {
            $table->id();
            $table->char('public_id', 36);
            $table->string('storage_driver', 80);
            $table->string('storage_key', 500);
            $table->string('original_name', 255)->nullable();
            $table->string('mime_type', 120);
            $table->unsignedBigInteger('size_bytes');
            $table->char('checksum_sha256', 64)->nullable();
            $table->enum('visibility', ['PRIVATE', 'CONTROLLED'])->default('PRIVATE');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('created_at', 6)->useCurrent();
            $table->dateTime('updated_at', 6);
            $table->dateTime('deleted_at', 6)->nullable();
            $table->unique(['public_id'], 'uq_file_objects_public_id');
            $table->index(['created_at'], 'idx_file_objects_created_at');
            $table->index(['updated_at'], 'idx_file_objects_updated_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('file_objects');
    }
};
