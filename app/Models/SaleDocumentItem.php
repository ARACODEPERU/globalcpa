<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SaleDocumentItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_id',
        'product_id',
        'cod_product',
        'decription_product',
        'unit_type',
        'quantity',
        'mto_base_igv',
        'percentage_igv',
        'igv',
        'total_tax',
        'type_afe_igv',
        'icbper',
        'factor_icbper',
        'mto_value_sale',
        'mto_value_unit',
        'mto_price_unit',
        'price_sale',
        'mto_total',
        'mto_discount',
        'json_discounts',
        'entity_name_product',
    ];

    public function document(): BelongsTo
    {
        return $this->belongsTo(SaleDocument::class, 'document_id', 'id');
    }

    public function product(): HasOne
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
