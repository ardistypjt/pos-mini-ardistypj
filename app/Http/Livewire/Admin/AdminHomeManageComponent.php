<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\HomeCategory;
use App\Models\HomeSales;
use Livewire\Component;

class AdminHomeManageComponent extends Component
{
    public $hapuscategory = null;
    public $selected_category = [];

    public $idhidden, $number_product;
    public $sale_date, $status;


    protected function rules()
    {
        return [
            'number_product' => 'numeric',
        ];
    }


    public function mount()
    {
        //Home Category
        $category = HomeCategory::find(1);
        $this->selected_category = explode(',', $category->sel_category);
        $this->number_product = $category->no_of_product;

        //Home Sales
        $sale = HomeSales::find(1);
        $this->sale_date = $sale->sale_date;
        $this->status = $sale->status;
    }

    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.admin-home-manage-component', compact('categories'))->layout('layouts.master', ['title' => 'Admin Home Category']);
    }

    public function storeHomeCategory()
    {
        $category = HomeCategory::find(1);
        $this->validate();
        $category->sel_category = implode(',', $this->selected_category);
        $category->no_of_product = $this->number_product;
        $category->save();
        session()->flash("success", "Data Home Category telah di Update !", "success");
    }

    public function storeHomeSale()
    {
        $sale = HomeSales::find(1);
        $sale->sale_date = $this->sale_date;
        $sale->status = $this->status;
        $sale->save();
        session()->flash("success", "Data Home Sales telah di Update !", "success");
    }
}
