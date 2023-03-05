<?php

namespace Kuber\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputRounded extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public $type, public $name = null, public $label = null, public $placeholder, public $description, public $value = '', public $icon = 'user', public $formGroup = '')
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('kuber::components.form.input-rounded');
    }
}
