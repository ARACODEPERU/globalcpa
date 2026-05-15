<?php

namespace Modules\ApiConnector\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApiConnectionParameter extends Model
{
    protected $fillable = [
        'api_connection_id',
        'name',
        'label',
        'type',
        'location',
        'required',
        'default_value',
        'description',
        'validation_rules',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'required' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function connection(): BelongsTo
    {
        return $this->belongsTo(ApiConnection::class, 'api_connection_id');
    }
}
