<?php

namespace Kuber\View\Components\Charts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Kuber\Traits\Browser;

class BrowsersBar extends Component
{
    use Browser;

    public $month1 = null;
    public $month2 = null;

    /**
     * Create a new component instance.
     */
    public function __construct(
        public $browsers,
        public $id = 'browsersBarYear',
    )
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('kuber::components.charts.browsers-bar');
    }
}
