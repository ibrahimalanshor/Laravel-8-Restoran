<?php

namespace App\View\Components;

use Illuminate\View\Component;

class NavItem extends Component
{
    public $icon, $name, $target, $active;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($icon = null, $name, $target = null, $active = null)
    {
        $this->icon = $icon;
        $this->name = $name;
        $this->target = $target;
        $this->active = $active;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.nav-item');
    }
}
