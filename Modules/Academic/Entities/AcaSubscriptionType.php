<?php

namespace Modules\Academic\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Academic\Database\factories\AcaSubscriptionTypeFactory;

class AcaSubscriptionType extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title',
        'usine',
        'description',
        'details',
        'prices',
        'status',
        'period',
        'order_number',
        'allow_all_courses',
        'allow_all_specializations',
        'allow_all_webinars',
        'allow_zoom_content',
        'allow_webinar_content'
    ];

    protected $casts = [
        'details' => 'array',
        'prices' => 'array',
        'allow_all_courses' => 'boolean',
        'allow_all_specializations' => 'boolean',
        'allow_all_webinars' => 'boolean',
        'allow_zoom_content' => 'boolean',
        'allow_webinar_content' => 'boolean',
    ];
}
