<?php

namespace Kuber\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ButtonRounded extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public $text, public $class = '')
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('kuber::components.form.button-rounded');
    }
}
