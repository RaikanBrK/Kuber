<?php

namespace Kuber\View\Components\Alerts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AlertError extends Component
{
    public $validation;

    /**
     * Create a new component instance.
     */
    public function __construct(public $text = null)
    {
        if ($this->text == null) {
            $this->validation = session()->has('error');
            $this->text = $this->validation ? session('error') : false;
        } else {
            $this->validation = true;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('kuber::components.alerts.alert-error');
    }
}
