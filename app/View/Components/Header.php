<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Header extends Component
{
    public $showNavBtns;

    public function __construct($showNavBtns = 'main')
    {
        $this->showNavBtns = $showNavBtns;
    }

    public function render()
    {
        return view('components.header');
    }
}

