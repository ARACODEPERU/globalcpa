<?php

namespace Modules\Dental\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Dental\Database\Seeders\PermissionsDentalTableSeeder;

class DentalDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PermissionsDentalTableSeeder::class
        ]);
    }
}
