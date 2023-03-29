<?php

namespace Kuber\View\Components\Charts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Browsers extends Component
{
    public $month1 = null;
    public $month2 = null;

    /**
     * Create a new component instance.
     */
    public function __construct(
        public $browsers,
        public $id = 'browsersYear',
    )
    {
        $monthQuarterly = $this->getMonthQuarterly();
        $this->month1 = $monthQuarterly[0];
        $this->month2 = $monthQuarterly[1];
    }

    protected function getMonthQuarterly()
    {
        $month = now()->month;

        if ($month >= 1 && $month <= 3) {
            return [1, 3];
        } else if ($month >= 4 && $month <= 6) {
            return [4, 6];
        } else if ($month >= 7 && $month <= 9) {
            return [7, 9];
        } else if ($month >= 10 && $month <= 12) {
            return [10, 12];
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('kuber::components.charts.browsers');
    }
}
