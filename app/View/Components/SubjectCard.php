<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SubjectCard extends Component
{
    public $subject;
    public $index;

    public function __construct($subject, $index = 0)
    {
        $this->subject = $subject;
        $this->index = $index;
    }

    public function render()
    {
        return view('pages.Home.subject-card');
    }
}