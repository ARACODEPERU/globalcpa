<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('api_connection_parameters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('api_connection_id')->constrained('api_connections')->cascadeOnDelete();
            $table->string('name');
            $table->string('label')->nullable();
            $table->enum('type', ['string', 'integer', 'boolean', 'number', 'date', 'file'])->default('string');
            $table->enum('location', ['query', 'header', 'body_json', 'body_xml', 'body_form', 'path'])->default('query');
            $table->boolean('required')->default(false);
            $table->text('default_value')->nullable();
            $table->text('description')->nullable();
            $table->string('validation_rules')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('api_connection_parameters');
    }
};
