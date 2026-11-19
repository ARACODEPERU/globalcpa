<?php

namespace Modules\Academic\Entities;

use Illuminate\Database\Eloquent\Model;

class AcaSubscriptionUtmSetting extends Model
{
    protected $table = 'aca_subscription_utm_settings';

    protected $fillable = [
        'campaign',
        'channels',
    ];

    protected $casts = [
        'channels' => 'array',
    ];
}
