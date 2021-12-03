<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\HomeCategory;
use App\Models\HomeSales;
use App\Models\HomeSlider;
use App\Models\Product;
use Livewire\Component;

class HomeComponent extends Component
{
    public function render()
    {
        $sliders        = HomeSlider::where('status', 1)->get();
        $lastproduct    = Product::orderBy('created_at', 'DESC')->get()->take(8);
        $category       = HomeCategory::find(1);
        $cat            = explode(',', $category->sel_category);
        $categories     = Category::whereIn('id', $cat)->get();
        $no_of_product  = $category->no_of_product;
        $sale_products  = Product::where('sale_price', '>', 0)->inRandomOrder()->get()->take(8);
        $onsale         = HomeSales::find(1);
        return view('livewire.home-component', compact('sliders', 'lastproduct', 'categories', 'no_of_product', 'sale_products', 'onsale'))->layout("customers.layouts.master");
    }
}
