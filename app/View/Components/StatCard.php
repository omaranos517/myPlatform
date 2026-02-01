<?php

namespace App\View\Components;

use Illuminate\View\Component;

class StatCard extends Component
{
    public $icon;
    public $value;
    public $label;

    public function __construct($icon, $value, $label)
    {
        $this->icon = $icon;
        $this->value = $value;
        $this->label = $label;
    }

    public function render()
    {
        return view('pages.Home.stat-card');
    }
}