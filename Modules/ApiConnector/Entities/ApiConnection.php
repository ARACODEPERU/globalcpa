<?php

namespace Modules\ApiConnector\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ApiConnection extends Model
{
    protected $fillable = [
        'name',
        'description',
        'base_url',
        'endpoint_path',
        'method',
        'auth_type',
        'auth_config',
        'headers',
        'body_type',
        'body_template',
        'response_type',
        'timeout',
        'retry_count',
        'status',
        'send_extra_params',
        'last_tested_at',
        'last_test_status',
        'last_test_response',
    ];

    protected function casts(): array
    {
        return [
            'headers' => 'json',
            'auth_config' => 'encrypted',
            'status' => 'boolean',
            'send_extra_params' => 'boolean',
            'timeout' => 'integer',
            'retry_count' => 'integer',
            'last_tested_at' => 'datetime',
            'last_test_status' => 'integer',
        ];
    }

    public function parameters(): HasMany
    {
        return $this->hasMany(ApiConnectionParameter::class)->orderBy('sort_order');
    }

    public function logs(): HasMany
    {
        return $this->hasMany(ApiConnectionLog::class);
    }
}
