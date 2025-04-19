<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Modules\Academic\Entities\AcaSubscriptionType;

class Subscriptions extends Component
{
    protected $subscriptions;

    public function __construct()
    {
        $this->subscriptions = AcaSubscriptionType::where('status', true)
            ->orderBy('order_number')
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.subscriptions', [
            'subscriptions' => $this->subscriptions
        ]);
    }
}
