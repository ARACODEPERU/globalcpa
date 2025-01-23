<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebController extends Controller
{

    public function testimage($student_id, $certificate_id, $fecha = null)
    {

        $student = AcaStudent::with('person')->find($student_id);
        //dd($student->person->full_name);
        $this->certificates_param = CertificatesParam::with('AcaCourse')->find($certificate_id);
        //dd($this->certificates_param);
        if ($fecha == null) {
            echo "Agrega un Slash --> '/' y agrega la fecha ejemplo 'test-image/Miguel de Cervantes Saavedra/23-01-2021'";
        } else {
            // create Image from file
            $img = Image::make($this->certificates_param->certificate_img);


            // write text
            //$img->text('The quick brown fox jumps over the lazy dog.');

            // write text at position
            //$img->text('The quick brown fox jumps over the lazy dog.', 120, 100);

            // $img->text($content, 1070, 496, function ($font) {
            //     $font->file('fonts/OLDENGL.TTF');
            //     $font->size(72);
            //     $font->color('#0d0603');
            //     $font->align('center');
            //     $font->valign('top');
            //     $font->angle(0);
            // });

            // $img->text("Entregado el: " . $fecha, 120, 15, function ($font) {
            //     $font->file('fonts/OLDENGL.TTF');
            //     $font->size(40);
            //     $font->color('#0d0603');
            //     $font->align('left');
            //     $font->valign('top');
            //     $font->angle(0);
            // });

            // $img->text("Pragot Especialistas en Especialización y mejora continua.", 1840, 15, function ($font) {
            //     $font->file('fonts/OLDENGL.TTF');
            //     $font->size(40);
            //     $font->color('#0d0603');
            //     $font->align('right');
            //     $font->valign('top');
            //     $font->angle(0);
            // });

            $img->text($student->person->full_name, $this->certificates_param->position_names_x, $this->certificates_param->position_names_y, function ($font) {
                $font->file($this->certificates_param->fontfamily_names);
                $font->size($this->certificates_param->font_size_names);
                $font->color('#0d0603');
                $font->align($this->certificates_param->font_align_names);
                $font->valign($this->certificates_param->font_vertical_align_names);
                $font->angle(0);
            });

            $img->text("Entregado el: " . $fecha,$this->certificates_param->position_date_x, $this->certificates_param->position_date_y , function ($font) {
                $font->file($this->certificates_param->fontfamily_date);
                $font->size($this->certificates_param->font_size_date);
                $font->color('#0d0603');
                $font->align($this->certificates_param->font_align_date);
                $font->valign($this->certificates_param->font_vertical_align_date);
                $font->angle(0);
            });
            $max_width = $this->certificates_param->max_width_title;
            $img->text($this->wrapText($this->certificates_param->AcaCourse->description, $max_width), $this->certificates_param->position_title_x, $this->certificates_param->position_title_y, function ($font) {
                $font->file($this->certificates_param->fontfamily_title);
                $font->size($this->certificates_param->font_size_title);
                $font->color('#0d0603');
                $font->align($this->certificates_param->font_align_title);
                $font->valign($this->certificates_param->font_vertical_align_title);
                $font->angle(0);
            });

            $qr = Image::make('https://borealtech.com/wp-content/uploads/2018/10/codigo-qr-1024x1024-1.jpg');
            $qr->fit(200, 200);
            $img->insert($qr, 'bottom-left', 30, 30);


            // Ejemplo de Redimensionar la imagen manteniendo la proporción para avatares y similares
            // Establecer el ancho máximo y la altura máxima deseados
            $maxWidth = 1550;
            $maxHeight = 1550;
            $img->resize($maxWidth, $maxHeight, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });



            // Obtener el contenido binario de la imagen
            $imageContent = $img->encode('png');


            // Generar la respuesta HTTP con la imagen
            $response = Response::make($imageContent);

            // Establecer el tipo de contenido de la respuesta como imagen PNG
            $response->header('Content-Type', 'image/png');


            // //QR GENERATOR
            // // Incluir la librería PHP puro
            // require_once(app_path() . '\\Phpqr\\qrlib.php');

            // $files = [
            //     "qrconst.php",
            //     "qrconfig.php",
            //     "qrtools.php",
            //     "qrspec.php",
            //     "qrimage.php",
            //     "qrinput.php",
            //     "qrbitstream.php",
            //     "qrsplit.php",
            //     "qrrscode.php",
            //     "qrmask.php",
            //     "qrencode.php"
            // ];

            // foreach ($files as $file) {
            //     require_once(app_path() . '\\Phpqr\\'.$file);
            // }


            // // Datos que deseas codificar en el código QR
            // $data = 'https://www.aracodeperu.com'; // Puedes cambiar esto por tus propios datos

            // // Generar el código QR y almacenarlo en una variable
            // $qr2 = QRcode::png($data,false ,'H', 10);
            // return $qr2;


            // Generar el código QR con un texto específico
            $qr2 = QrCode::size(300)->generate('Aracode Smart Solutions');

            //$qr2 = base64_decode($qr2);
            //$qr2 = $qr2->encode('png');
            //echo $qr2;

            //Retornar la respuesta
            return $response;
        }
    }

    public function wrapText($text, $maxWidth) {
        // Envolver el texto
        $wrappedText = wordwrap($text, $maxWidth, PHP_EOL, true);

        // Dividir el texto envuelto en líneas
        $lines = explode(PHP_EOL, $wrappedText);

        // Calcular la longitud máxima de las líneas envueltas
        $maxLineLength = max(array_map('strlen', $lines));

        // Centrar horizontalmente las líneas
        $centeredLines = array_map(function($line) use ($maxLineLength) {
            $spacesToAdd = max(0, ($maxLineLength - strlen($line)) / 2);
            $centeredLine = str_repeat(' ', $spacesToAdd) . $line;
            return $centeredLine;
        }, $lines);

        // Unir las líneas centradas de nuevo en un solo texto
        $centeredText = implode(PHP_EOL, $centeredLines);

        return $centeredText;
    }
}
