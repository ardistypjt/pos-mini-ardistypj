<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Cart;
use Livewire\Component;
use Livewire\WithPagination;
use Brian2694\Toastr\Facades\Toastr;

class SearchComponent extends Component
{
    use WithPagination;
    public $sorting;
    public $pageSize;

    public $search;
    public $product_cat;
    public $product_cat_id;


    public function mount()
    {
        $this->sorting = "default";
        $this->pageSize = 12;
        $this->fill(request()->only('search', 'product_cat', 'product_cat_id'));
    }

    public function render()
    {
        if ($this->sorting == 'datenew') {
            $products = Product::where('name', 'like', '%' . $this->search . '%')->where('category_id', 'like', '%' . $this->product_cat_id . '%')->orderBy('created_at', 'ASC')->paginate($this->pageSize);
        } elseif ($this->sorting == 'dateold') {
            $products = Product::where('name', 'like', '%' . $this->search . '%')->where('category_id', 'like', '%' . $this->product_cat_id . '%')->orderBy('created_at', 'DESC')->paginate($this->pageSize);
        } elseif ($this->sorting == 'price') {
            $products = Product::where('name', 'like', '%' . $this->search . '%')->where('category_id', 'like', '%' . $this->product_cat_id . '%')->orderBy('regular_price', 'ASC')->paginate($this->pageSize);
        } elseif ($this->sorting == 'price-desc') {
            $products = Product::where('name', 'like', '%' . $this->search . '%')->where('category_id', 'like', '%' . $this->product_cat_id . '%')->orderBy('regular_price', 'DESC')->paginate($this->pageSize);
        } else {
            $products = Product::where('name', 'like', '%' . $this->search . '%')->where('category_id', 'like', '%' . $this->product_cat_id . '%')->paginate($this->pageSize);
        }

        $category_p = Category::all();
        return view('livewire.search-component', compact('products', 'category_p'))->layout("customers.layouts.master");
    }

    public function store($product_id, $product_name, $product_price)
    {
        Cart::add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        Toastr::success('Item Telah Ditambahkan ke Cart :)', 'Success');
        // session()->flash('success_message', 'Item Telah Ditambahkan ke Cart');
        return redirect()->route('cart');
    }
}
