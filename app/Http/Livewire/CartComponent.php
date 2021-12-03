<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;
use Brian2694\Toastr\Facades\Toastr;

class CartComponent extends Component
{
    public function render()
    {
        return view('livewire.cart-component')->layout("customers.layouts.master");
    }

    public function increaseQuantity($rowId)
    {
        $product    = Cart::get($rowId);
        $qty        = $product->qty + 1;
        Cart::update($rowId, $qty);
    }

    public function decreaseQuantity($rowId)
    {
        $product    = Cart::get($rowId);
        $qty        = $product->qty - 1;
        Cart::update($rowId, $qty);
    }

    public function remove($rowId)
    {
        Cart::remove($rowId);
        session()->flash('success_message', 'Item Telah Dihapus Dari Cart');
        // Toastr::success('Item Telah Dihapus Dari Cart :)', 'Success');
    }

    public function destroyAll()
    {
        Cart::destroy();
        session()->flash('success_message', 'Semua Item Telah Dihapus Dari Cart');
        // Toastr::success('Item Telah Dihapus Dari Cart :)', 'Success');
    }
}
