<?php

namespace Modules\Academic\Database\Seeders;

use App\Models\Modulo;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::find(1);

        $modulo = Modulo::create(['identifier' => 'M007', 'description' => 'Académico']);

        $permissions = [];

        array_push($permissions, Permission::create(['name' => 'aca_dashboard']));
        array_push($permissions, Permission::create(['name' => 'aca_suscripciones']));
        array_push($permissions, Permission::create(['name' => 'aca_suscripciones_nuevo']));
        array_push($permissions, Permission::create(['name' => 'aca_suscripciones_editar']));
        array_push($permissions, Permission::create(['name' => 'aca_suscripciones_eliminar']));
        array_push($permissions, Permission::create(['name' => 'aca_institucion_listado']));
        array_push($permissions, Permission::create(['name' => 'aca_institucion_nuevo']));
        array_push($permissions, Permission::create(['name' => 'aca_institucion_editar']));
        array_push($permissions, Permission::create(['name' => 'aca_institucion_eliminar']));
        array_push($permissions, Permission::create(['name' => 'aca_docente_listado']));
        array_push($permissions, Permission::create(['name' => 'aca_docente_nuevo']));
        array_push($permissions, Permission::create(['name' => 'aca_docente_editar']));
        array_push($permissions, Permission::create(['name' => 'aca_docente_eliminar']));
        array_push($permissions, Permission::create(['name' => 'aca_estudiante_listado']));
        array_push($permissions, Permission::create(['name' => 'aca_estudiante_nuevo']));
        array_push($permissions, Permission::create(['name' => 'aca_estudiante_editar']));
        array_push($permissions, Permission::create(['name' => 'aca_estudiante_importar_excel']));
        array_push($permissions, Permission::create(['name' => 'aca_estudiante_eliminar']));
        array_push($permissions, Permission::create(['name' => 'aca_estudiante_certificados_crear']));
        array_push($permissions, Permission::create(['name' => 'aca_cursos_listado']));
        array_push($permissions, Permission::create(['name' => 'aca_cursos_nuevo']));
        array_push($permissions, Permission::create(['name' => 'aca_cursos_editar']));
        array_push($permissions, Permission::create(['name' => 'aca_cursos_eliminar']));
        array_push($permissions, Permission::create(['name' => 'aca_cursos_listado_estudiantes']));
        array_push($permissions, Permission::create(['name' => 'aca_cursos_modulos']));
        array_push($permissions, Permission::create(['name' => 'aca_cursos_examen_configuracion']));
        array_push($permissions, Permission::create(['name' => 'aca_cursos_examen_ver']));
        array_push($permissions, Permission::create(['name' => 'aca_miscursos']));
        array_push($permissions, Permission::create(['name' => 'aca_cursos_revisar_examenes']));
        array_push($permissions, Permission::create(['name' => 'aca_estudiante_listar_comprobantes']));
        array_push($permissions, Permission::create(['name' => 'aca_estudiante_cobrar']));
        array_push($permissions, Permission::create(['name' => 'aca_certificados_listado']));
        array_push($permissions, Permission::create(['name' => 'aca_certificados_editar']));
        array_push($permissions, Permission::create(['name' => 'aca_certificados_nuevo']));
        array_push($permissions, Permission::create(['name' => 'aca_certificados_eliminar']));
        array_push($permissions, Permission::create(['name' => 'aca_tutoriales_cortos']));
        array_push($permissions, Permission::create(['name' => 'aca_tutoriales_lista']));
        array_push($permissions, Permission::create(['name' => 'aca_tutoriales_lista_nuevo']));
        array_push($permissions, Permission::create(['name' => 'aca_tutoriales_lista_editar']));
        array_push($permissions, Permission::create(['name' => 'aca_tutoriales_lista_eliminar']));
        array_push($permissions, Permission::create(['name' => 'aca_tutoriales_videos']));
        array_push($permissions, Permission::create(['name' => 'aca_tutoriales_videos_nuevo']));
        array_push($permissions, Permission::create(['name' => 'aca_tutoriales_videos_editar']));
        array_push($permissions, Permission::create(['name' => 'aca_tutoriales_videos_eliminar']));
        array_push($permissions, Permission::create(['name' => 'aca_tutoriales_lista_agregar_video']));
        array_push($permissions, Permission::create(['name' => 'aca_estudiante_exportar_excel']));
        array_push($permissions, Permission::create(['name' => 'aca_reportes']));

        foreach ($permissions as $permission) {
            $role->givePermissionTo($permission->name);
            DB::table('model_has_permissions')->insert([
                'permission_id' => $permission->id,
                'model_type' => Modulo::class,
                'model_id' => $modulo->identifier
            ]);
        }

        $alumno = Role::create(['name' => 'Alumno']);
        $alumno->givePermissionTo('aca_dashboard');
        $alumno->givePermissionTo('aca_miscursos');

        $docente = Role::create(['name' => 'Docente']);
        $docente->givePermissionTo('aca_dashboard');
        $docente->givePermissionTo('aca_cursos_listado');
    }
}
