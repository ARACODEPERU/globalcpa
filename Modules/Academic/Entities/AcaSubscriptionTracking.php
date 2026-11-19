<?php

namespace Modules\Academic\Entities;

use Illuminate\Database\Eloquent\Model;

class AcaSubscriptionTracking extends Model
{
    /**
     * Nombre explicito: Eloquent pluralizaria "Tracking" de forma inesperada.
     */
    protected $table = 'aca_subscription_tracking';

    protected $fillable = [
        'subscription_type_id',
        'event',
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
        'client_ip',
    ];

    protected $casts = [
        'subscription_type_id' => 'integer',
    ];
}
