<?php

namespace Modules\ApiConnector\Database\Seeders;

use App\Models\Modulo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $modulo = Modulo::create(['identifier' => 'M020', 'description' => 'Api Connector']);

        $permissions = [];

        array_push($permissions, Permission::create(['name' => 'api_connector_listar']));
        array_push($permissions, Permission::create(['name' => 'api_connector_crear']));
        array_push($permissions, Permission::create(['name' => 'api_connector_editar']));
        array_push($permissions, Permission::create(['name' => 'api_connector_eliminar']));
        array_push($permissions, Permission::create(['name' => 'api_connector_probar']));

        $roles = Role::whereIn('name', ['administrator', 'admin'])->get();

        foreach ($roles as $role) {
            foreach ($permissions as $permission) {
                $role->givePermissionTo($permission->name);
                DB::table('model_has_permissions')->insert([
                    'permission_id' => $permission->id,
                    'model_type' => Modulo::class,
                    'model_id' => $modulo->identifier
                ]);
            }
        }
    }
}
