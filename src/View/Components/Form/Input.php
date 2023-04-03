<?php

namespace Kuber\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $type,
        public $name = null,
        public $label = null,
        public $value = null,
        public $placeholder = null,
        public $class = null,
        public $formGroupClass = null,
    )
    {
        $this->setDefaultValues('name');
        $this->setDefaultValues('label');
        $this->setDefaultValues('value');
    }

    public function setDefaultValues($attr)
    {
        $method = 'setDefault' . ucfirst($attr);
        if ($this->$attr == null && method_exists($this, $method)) {
            $this->$method();
        }
    }

    public function setDefaultName()
    {
        $this->name = $this->type;
    }

    public function setDefaultLabel()
    {
        $this->label = __('validation.attributes.' . $this->name);
    }

    public function setDefaultValue()
    {
        $this->value = request()->old($this->name);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('kuber::components.form.input');
    }
}
