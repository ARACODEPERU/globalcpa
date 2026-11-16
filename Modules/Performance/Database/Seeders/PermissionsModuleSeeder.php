<?php

namespace Modules\Performance\Database\Seeders;

use App\Models\Modulo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsModuleSeeder extends Seeder
{
    /**
     * Registra los permisos del modulo y los asigna al rol admin.
     */
    public function run(): void
    {
        $role = Role::where('name', 'admin')->first();

        $modulo = Modulo::firstOrCreate(
            ['identifier' => 'M022'],
            ['description' => 'Performance y Rendimiento']
        );

        $permissions = [
            'perf_images',
            'perf_images_resize',
            'perf_maintenance',
        ];

        foreach ($permissions as $name) {
            $permission = Permission::firstOrCreate([
                'name' => $name,
                'guard_name' => 'web',
            ]);

            if ($role) {
                $role->givePermissionTo($permission->name);
            }

            DB::table('model_has_permissions')->updateOrInsert(
                [
                    'permission_id' => $permission->id,
                    'model_type' => Modulo::class,
                    'model_id' => $modulo->identifier,
                ],
                []
            );
        }
    }
}
