<?php

namespace Kuber\View\Components\Widget;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Card extends Component
{
    /**
     * Create a new component instance.
     *
     * @param string|null $title Título do card
     * @param string $theme Tema do card do adminlte
     * @param string|null $send Ativar botão de enviar --- save OR create
     * @param string|null $back Rota para voltar o usuário
     */
    public function __construct(
        public $title = null,
        public $theme = 'lightblue',
        public $send = false,
        public $back = false,
        public $collapsible = null,
        public $removable = null,
        public $maximizable = null,
    )
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('kuber::components.widget.card');
    }
}
