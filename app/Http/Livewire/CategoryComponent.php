<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Cart;
use Livewire\Component;
use Livewire\WithPagination;
use Brian2694\Toastr\Facades\Toastr;

class CategoryComponent extends Component
{
    use WithPagination;
    public $sorting;
    public $pageSize;
    public $category_slug;
    public $minrangeP;
    public $maxrangeP;

    public function mount($category_slug)
    {
        $this->sorting = "default";
        $this->pageSize = 12;
        $this->category_slug = $category_slug;

        $this->minrangeP = 1;
        $this->maxrangeP = 1000;
    }

    public function render()
    {
        $category       = Category::where('slug', $this->category_slug)->first();
        $category_id    = $category->id;
        $category_name    = $category->name;
        if ($this->sorting == 'datenew') {
            $products = Product::where('category_id', $category_id)->whereBetween('regular_price', [$this->minrangeP, $this->maxrangeP])->orderBy('created_at', 'ASC')->paginate($this->pageSize);
        } elseif ($this->sorting == 'dateold') {
            $products = Product::where('category_id', $category_id)->whereBetween('regular_price', [$this->minrangeP, $this->maxrangeP])->orderBy('created_at', 'DESC')->paginate($this->pageSize);
        } elseif ($this->sorting == 'price') {
            $products = Product::where('category_id', $category_id)->whereBetween('regular_price', [$this->minrangeP, $this->maxrangeP])->orderBy('regular_price', 'ASC')->paginate($this->pageSize);
        } elseif ($this->sorting == 'price-desc') {
            $products = Product::where('category_id', $category_id)->whereBetween('regular_price', [$this->minrangeP, $this->maxrangeP])->orderBy('regular_price', 'DESC')->paginate($this->pageSize);
        } else {
            $products = Product::where('category_id', $category_id)->whereBetween('regular_price', [$this->minrangeP, $this->maxrangeP])->paginate($this->pageSize);
        }

        $category_p = Category::all();
        return view('livewire.category-component', compact('products', 'category_p', 'category_id', 'category_name'))->layout("customers.layouts.master");
    }

    public function store($product_id, $product_name, $product_price)
    {
        Cart::add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        Toastr::success('Item Telah Ditambahkan ke Cart :)', 'Success');
        // session()->flash('success_message', 'Item Telah Ditambahkan ke Cart');
        return redirect()->route('cart');
    }
}
