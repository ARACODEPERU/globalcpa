<?php

namespace Tests\Unit\Modules\Blog\Services;

use Modules\Blog\Services\ArticleContentCleaner;
use Tests\TestCase;

/*
 * El HTML guardado de los articulos puede traer listas mal formadas: TinyMCE las
 * reordena al abrir el editor, pero en la web publica el navegador las parte en
 * pedazos (textos sin vineta y vinetas sueltas). Estas pruebas fijan el contrato
 * del reparador: solo tocamos listas, y el contenido valido se devuelve intacto.
 */
class ArticleContentCleanerTest extends TestCase
{
    public function test_deja_intacto_el_contenido_sin_listas(): void
    {
        $html = '<p>categoría operativa.</p><p>Sin listas por aquí.</p>';

        $this->assertSame($html, ArticleContentCleaner::cleanLists($html));
    }

    public function test_mete_dentro_de_li_el_contenido_suelto_en_la_lista(): void
    {
        $html = '<ul><li>la categoría operativa.</li><p>la categoría de impuestos sobre la renta</p><li>.</li></ul>';

        $clean = ArticleContentCleaner::cleanLists($html);

        $this->assertSame(3, substr_count($clean, '<li>'));
        $this->assertSame(0, substr_count($clean, '</li><p>'));
        // El parrafo se conserva dentro del item (igual que hace TinyMCE al reparar).
        $this->assertStringContainsString('<li><p>la categoría de impuestos sobre la renta</p></li>', $clean);
    }

    public function test_quita_el_br_inicial_que_deja_la_vineta_sola(): void
    {
        $html = '<ul><li><br>la categoría de inversión.</li></ul>';

        $clean = ArticleContentCleaner::cleanLists($html);

        $this->assertStringNotContainsString('<br>', $clean);
        $this->assertStringContainsString('<li>la categoría de inversión.</li>', $clean);
    }

    public function test_une_listas_contiguas_del_mismo_tipo(): void
    {
        $html = '<ul><li>primera</li></ul><ul><li>segunda</li></ul>';

        $clean = ArticleContentCleaner::cleanLists($html);

        $this->assertSame(1, substr_count($clean, '<ul>'));
        $this->assertSame(2, substr_count($clean, '<li>'));
    }

    public function test_no_une_listas_de_tipo_distinto(): void
    {
        $html = '<ul><li>viñeta</li></ul><ol><li>numerada</li></ol>';

        $clean = ArticleContentCleaner::cleanLists($html);

        $this->assertSame(1, substr_count($clean, '<ul>'));
        $this->assertSame(1, substr_count($clean, '<ol>'));
    }

    public function test_conserva_los_acentos_y_las_tablas(): void
    {
        $html = '<table><tr><td>Gestión</td></tr></table><ul><li><br>año fiscal</li></ul>';

        $clean = ArticleContentCleaner::cleanLists($html);

        $this->assertStringContainsString('Gestión', $clean);
        $this->assertStringContainsString('año fiscal', $clean);
        $this->assertStringContainsString('<table>', $clean);
    }

    public function test_deja_intacta_una_lista_bien_formada_con_subitems(): void
    {
        $html = '<ul><li>Padre<ul><li>Hijo</li></ul></li><li>Hermano</li></ul>';

        $clean = ArticleContentCleaner::cleanLists($html);

        $this->assertSame(2, substr_count($clean, '<ul>'));
        $this->assertSame(3, substr_count($clean, '<li>'));
    }

    public function test_elimina_items_que_quedan_vacios(): void
    {
        $html = '<ul><li>contenido</li><li><br></li></ul>';

        $clean = ArticleContentCleaner::cleanLists($html);

        $this->assertSame(1, substr_count($clean, '<li>'));
    }
}
