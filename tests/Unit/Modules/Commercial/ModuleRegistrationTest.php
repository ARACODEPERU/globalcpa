<?php

namespace Tests\Unit\Modules\Commercial;

use Tests\TestCase;

/*
 * El modulo Comercial entra al repositorio con rutas, paginas Vue y un Menu.js, pero
 * nada avisa si alguien olvida los dos pasos que lo hacen visible: habilitarlo en
 * modules_statuses.json (si no, nwidart no registra su provider y no existen las rutas
 * comm_*) e importarlo en el rail de menus (si no, el modulo no aparece aunque el
 * usuario sea administrador con permisos). Estas pruebas fijan ambos pasos, mas la
 * proteccion contra el route() pelado que tumbaba el panel entero.
 */
class ModuleRegistrationTest extends TestCase
{
    private const MODULE = 'Commercial';
    private const STATUSES_FILE = 'modules_statuses.json';
    private const MENU_DATA = 'resources/js/Components/vristo/layout/MenuData.js';

    public function test_el_modulo_comercial_esta_habilitado(): void
    {
        $statuses = json_decode($this->read(self::STATUSES_FILE), true);

        $this->assertIsArray($statuses, 'modules_statuses.json no es un JSON valido.');
        $this->assertArrayHasKey(
            self::MODULE,
            $statuses,
            'Sin la entrada en modules_statuses.json nwidart no registra el provider: no hay rutas comm_* ni migraciones del modulo.'
        );
        $this->assertTrue($statuses[self::MODULE], 'El modulo Comercial figura deshabilitado.');
    }

    public function test_el_rail_de_modulos_importa_y_registra_su_menu(): void
    {
        $menuData = $this->read(self::MENU_DATA);
        $rutaMenu = 'Modules/' . self::MODULE . '/Resources/assets/js/Menu.js';

        $this->assertStringContainsString("import menu" . self::MODULE . " from '" . $rutaMenu . "';", $menuData);
        $this->assertMatchesRegularExpression(
            '/^\s*menu' . self::MODULE . ',\s*$/m',
            $menuData,
            'El import existe pero el modulo no esta agregado al array MenuData, asi que el rail no puede pintarlo.'
        );
    }

    public function test_el_menu_de_comercial_no_usa_route_pelado(): void
    {
        $menu = $this->read('Modules/' . self::MODULE . '/Resources/assets/js/Menu.js');

        $this->assertStringNotContainsString(
            'route("',
            $menu,
            'Un route() sin proteger lanza el error de Ziggy al importar el menu y deja el panel sin renderizar.'
        );
        $this->assertStringContainsString('menuRoute("', $menu);
    }

    /**
     * Un import hacia un Menu.js inexistente rompe el build de vite (fue justo lo que
     * paso con el helper menuRoute), asi que se comprueba que cada menu importado exista.
     */
    public function test_cada_menu_importado_en_el_rail_existe(): void
    {
        preg_match_all('/^import\s+\w+\s+from\s+\'([^\']*\/Menu\.js)\';$/m', $this->read(self::MENU_DATA), $coincidencias);

        $this->assertNotEmpty($coincidencias[1], 'No se encontro ningun import de Menu.js en el rail.');

        foreach ($coincidencias[1] as $ruta) {
            $this->assertFileExists(base_path($ruta), "El rail importa un menu que no existe: $ruta");
        }
    }

    private function read(string $relativePath): string
    {
        $path = base_path($relativePath);

        $this->assertFileExists($path);

        return file_get_contents($path);
    }
}
