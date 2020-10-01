<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Card extends Component
{

    public $title;
    public $smallTitle;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title = null, $smallTitle = null)
    {
        $this->title = $title;
        $this->smallTitle = $smallTitle;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.card');
    }
}
