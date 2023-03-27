<?php

namespace Kuber\View\Components\Charts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Visits extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $visits,
        public $id = 'visitsYear',
    )
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('kuber::components.charts.visits');
    }
}
