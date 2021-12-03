<?php

namespace App\Http\Livewire;

use App\Models\HomeSales;
use App\Models\Product;
use Livewire\Component;
use Cart;
use Brian2694\Toastr\Facades\Toastr;

class DetailsProductComponent extends Component
{
    public $slug;

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function render()
    {
        $product = Product::where('slug', $this->slug)->first();
        $popular_products = Product::inRandomOrder()->limit(4)->get();
        $related_products = Product::where('category_id', $product->category_id)->inRandomOrder()->limit(6)->get();
        $onsale         = HomeSales::find(1);
        return view('livewire.details-product-component', compact('product', 'popular_products', 'related_products', 'onsale'))->layout("customers.layouts.master");
    }

    public function store($product_id, $product_name, $product_price)
    {
        Cart::add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        Toastr::success('Item Telah Ditambahkan ke Cart :)', 'Success');
        // session()->flash('success_message', 'Item Telah Ditambahkan ke Cart');
        return redirect()->route('cart');
    }
}
