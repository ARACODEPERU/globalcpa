<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('api_connections', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('base_url');
            $table->string('endpoint_path')->nullable();
            $table->enum('method', ['GET', 'POST', 'PUT', 'PATCH', 'DELETE'])->default('GET');
            $table->enum('auth_type', ['none', 'basic', 'bearer', 'api_key', 'digest', 'oauth2', 'ntlm', 'hawk'])->default('none');
            $table->text('auth_config')->nullable()->comment('Encrypted JSON with auth credentials');
            $table->json('headers')->nullable();
            $table->enum('body_type', ['none', 'json', 'xml', 'form_data', 'form_urlencoded', 'graphql', 'soap', 'binary'])->default('none');
            $table->text('body_template')->nullable();
            $table->enum('response_type', ['json', 'xml', 'text', 'binary'])->default('json');
            $table->integer('timeout')->default(30);
            $table->integer('retry_count')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamp('last_tested_at')->nullable();
            $table->integer('last_test_status')->nullable();
            $table->text('last_test_response')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('api_connections');
    }
};
