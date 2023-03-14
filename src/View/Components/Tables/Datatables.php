<?php

namespace Kuber\View\Components\Tables;

use Closure;
use DateTime;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;

class Datatables extends Component
{
    public $actions = [];

    /**
     * Create a new component instance.
     */
    public function __construct(public $head, public $items, public $action = false, public $routeBase = null, public array $exceptActions = [])
    {
        if ($this->routeBase == null) {
            $this->routeBaseDefault();
        }

        $this->createActions();

        $this->deleteActions();
    }

    public function formatData($data)
    {
        $data = new DateTime($data);
        return $data->format('d/m/Y H:i');
    }

    private function routeBaseDefault()
    {
        $paths = explode(".", Route::current()->getName());
        array_pop($paths);
        $this->routeBase = implode(".", $paths);
    }

    private function createActions()
    {
        $this->actions = [
            'viewer' => [
                'action' => 'viewer',
                'route' => $this->routeBase . '.show',
                'icon' => 'info',
            ],
            'edit' => [
                'action' => 'edit',
                'route' => $this->routeBase . '.edit',
                'icon' => 'edit',
            ],
            'delete' => [
                'action' => 'delete',
                'route' => $this->routeBase . '.destroy',
                'icon' => 'trash-alt',
            ],
        ];
    }

    public function deleteActions()
    {
        foreach($this->exceptActions as $action) {
            unset($this->actions[$action]);
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('kuber::components.tables.datatables');
    }
}
