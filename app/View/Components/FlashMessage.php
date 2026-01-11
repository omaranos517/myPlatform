<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FlashMessage extends Component
{
    public $type; // نوع الرسالة: success, error, warning, info
    public $message; // نص الرسالة

    /**
     * Create a new component instance.
     *
     * @param string $message
     * @param string $type
     */
    public function __construct($message = '', $type = 'success')
    {
        $this->message = $message;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.flash-message');
    }
}
