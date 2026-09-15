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

    /**
     * El contenido pegado desde Word trae parrafos y listas anidados en divs
     * envolventes. La reparacion nunca debe perder texto del articulo.
     */
    public function test_conserva_todo_el_texto_visible_de_un_pegado_de_word(): void
    {
        $html = '<div><div>&nbsp;</div>'
            . '<div><p>En el estado de resultados hay cinco categorías:</p></div>'
            . '<div><ul><li><p>la categoría operativa</p></li></ul></div>'
            . '<div><p>la categoría de inversión</p></div>'
            . '<div><ul><li><p>la categoría de financiamiento</p></li></ul></div>'
            . '</div>';

        $clean = ArticleContentCleaner::cleanLists($html);

        $this->assertSame($this->textoVisible($html), $this->textoVisible($clean));
    }

    /**
     * Red de seguridad: si el parseo perdiera contenido, se devuelve el HTML
     * original en lugar de un articulo mutilado.
     */
    public function test_devuelve_el_original_cuando_el_parseo_perderia_contenido(): void
    {
        // Texto despues de un </html> suelto se descarta al re-serializar.
        $html = '<ul><li>un item</li></ul></html>el resto del articulo';

        $clean = ArticleContentCleaner::cleanLists($html);

        $this->assertSame($html, $clean);
    }

    /**
     * Propiedad que debe cumplirse siempre: la reparacion no pierde ni una letra
     * del articulo, sea cual sea lo mal formado que venga el HTML.
     */
    public function test_nunca_pierde_texto_visible(): void
    {
        $fragmentos = [
            '<ul><li>uno</li><p>dos</p></ul>',
            '<body><ul><li>uno</li></ul></body>texto suelto del articulo',
            '<ul><li>uno</li></ul></div><div><ul><li>dos</li></ul>',
            '<div><ul><li>uno</li></ul>&nbsp;</div>',
            '<table><tr><td><ul><li>uno</li></ul>texto de la celda</td></tr></table>',
            '<ul><li>uno</li></ul><script>var x = 1; el resto del articulo',
        ];

        foreach ($fragmentos as $fragmento) {
            $this->assertSame(
                $this->textoVisible($fragmento),
                $this->textoVisible(ArticleContentCleaner::cleanLists($fragmento)),
                'Se perdio texto con: ' . $fragmento
            );
        }
    }

    private function textoVisible(string $html): string
    {
        $texto = strip_tags(html_entity_decode($html, ENT_QUOTES, 'UTF-8'));

        return preg_replace('/[\s\x{00A0}]+/u', '', $texto) ?? '';
    }
}
