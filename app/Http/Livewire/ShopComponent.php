<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\HomeSales;
use App\Models\Product;
use Cart;
use Livewire\Component;
use Livewire\WithPagination;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Pagination\Paginator;

class ShopComponent extends Component
{
    use WithPagination;
    public $sorting;
    public $pageSize;
    public $currentPage = 1;

    public $minrangeP;
    public $maxrangeP;

    public function mount()
    {
        $this->sorting = "default";
        $this->pageSize = 12;

        $this->minrangeP = 1;
        $this->maxrangeP = 1000000000;
    }

    public function render()
    {
        if ($this->sorting == 'datenew') {
            $products = Product::whereBetween('regular_price', [$this->minrangeP, $this->maxrangeP])->orderBy('created_at', 'ASC')->paginate($this->pageSize);
        } elseif ($this->sorting == 'dateold') {
            $products = Product::whereBetween('regular_price', [$this->minrangeP, $this->maxrangeP])->orderBy('created_at', 'DESC')->paginate($this->pageSize);
        } elseif ($this->sorting == 'price') {
            $products = Product::whereBetween('regular_price', [$this->minrangeP, $this->maxrangeP])->orderBy('regular_price', 'ASC')->paginate($this->pageSize);
        } elseif ($this->sorting == 'price-desc') {
            $products = Product::whereBetween('regular_price', [$this->minrangeP, $this->maxrangeP])->orderBy('regular_price', 'DESC')->paginate($this->pageSize);
        } else {
            $products = Product::whereBetween('regular_price', [$this->minrangeP, $this->maxrangeP])->paginate($this->pageSize);
        }
        $onsale = HomeSales::find(1);
        $category_p = Category::all();
        return view('livewire.shop-component', compact('products', 'category_p', 'onsale'))->layout("customers.layouts.master");
    }

    public function store($product_id, $product_name, $product_price)
    {
        Cart::add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        Toastr::success('Item Telah Ditambahkan ke Cart :)', 'Success');
        // session()->flash('success_message', 'Item Telah Ditambahkan ke Cart');
        return redirect()->route('cart');
    }

    public function setPage($url)
    {
        $this->currentPage = explode('page=', $url)[1];
        Paginator::currentPageResolver(function () {
            return $this->currentPage;
        });
    }
}
