<?php

namespace Modules\ApiConnector\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApiConnectionLog extends Model
{
    protected $fillable = [
        'api_connection_id',
        'request_url',
        'request_method',
        'request_headers',
        'request_body',
        'response_status',
        'response_headers',
        'response_body',
        'response_time_ms',
        'ip_address',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'request_headers' => 'json',
            'response_headers' => 'json',
            'response_time_ms' => 'integer',
        ];
    }

    public function connection(): BelongsTo
    {
        return $this->belongsTo(ApiConnection::class, 'api_connection_id');
    }
}
