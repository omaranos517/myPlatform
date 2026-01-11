<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Section;

class SupportModel extends Component
{

    public $guest;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->guest = ! Auth::check(); // لو غير مسجل = true
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.support-model');
    }
}
