<?php

namespace Modules\CMS\Entities;

use Illuminate\Database\Eloquent\Model;

class CmsLandingLead extends Model
{
    /**
     * Atributos que se guardan como array (json).
     */
    protected $casts = [
        'interest_areas' => 'array',
    ];

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'landing_id',
        'menu_id',
        'person_id',
        'name',
        'email',
        'phone',
        'interest_areas',
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'utm_term',
        'utm_content',
        'utm_id',
        'fbclid',
        'gclid',
        'referer',
        'landing_url',
        'traffic_source',
    ];
}
