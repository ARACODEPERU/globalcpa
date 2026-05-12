<?php

namespace Modules\ApiConnector\Database\Seeders;

use Illuminate\Database\Seeder;

class ApiConnectorDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            PermissionsSeeder::class
        ]);
    }
}
