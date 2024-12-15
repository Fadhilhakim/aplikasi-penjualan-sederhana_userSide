<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class header extends Component
{
    public $discount_products;
    public $dashboard;

    public function __construct($discountProducts, $dashboard)
    {
        $this->discount_products = $discountProducts;
        $this->dashboard = $dashboard;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.header');
    }
}
