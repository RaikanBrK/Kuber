<?php

namespace Kuber\View\Components\Charts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Kuber\Traits\Browser;

class Browsers extends Component
{
    use Browser;

    public $month1 = null;
    public $month2 = null;

    /**
     * Create a new component instance.
     */
    public function __construct(
        public $browsers,
        public $id = 'browsersQuarterly',
    )
    {
        $monthQuarterly = $this->getMonthQuarterly(now()->month);
        $this->month1 = $monthQuarterly[0];
        $this->month2 = $monthQuarterly[1];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('kuber::components.charts.browsers');
    }
}
