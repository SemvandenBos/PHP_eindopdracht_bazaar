<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Card extends Component
{
    public $title;
    public $description;

    public function __construct($title = null, $description = null)
    {
        $this->title = $title;
        $this->description = $description;
    }

    public function render()
    {
        return view('components.card');
    }
}
