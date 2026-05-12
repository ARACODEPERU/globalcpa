<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE api_connections MODIFY COLUMN auth_type ENUM('none','basic','bearer','api_key','digest','oauth2','ntlm','hawk','jwt') DEFAULT 'none'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE api_connections MODIFY COLUMN auth_type ENUM('none','basic','bearer','api_key','digest','oauth2','ntlm','hawk') DEFAULT 'none'");
    }
};
