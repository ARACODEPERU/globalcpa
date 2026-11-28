<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    /**
     * Id del pais Peru dentro del catalogo de paises.
     * Se usa para decidir si la ubicacion se pide por ubigeo (Peru)
     * o como ciudad de texto libre (extranjero).
     */
    public static function peruId(): int
    {
        $id = static::where('description', 'Perú')
            ->orWhere('description', 'Peru')
            ->orWhere('country_code', 'PE')
            ->value('id');

        return (int) ($id ?: 1);
    }
}
