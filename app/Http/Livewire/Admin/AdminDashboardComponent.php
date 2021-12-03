<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Livewire\Component;

class AdminDashboardComponent extends Component
{
    public function render()
    {
        $total_user = count(User::select('id')->get());
        $total_sales = count(Product::where('sale_price', '!=', null)->get());
        $total_products = count(Product::select('id')->get());
        $total_category = count(Category::select('id')->get());

        return view('livewire.admin.admin-dashboard-component', compact('total_user', 'total_sales', 'total_products', 'total_category'))->layout("layouts.master", ['title' => 'Dashboard']);
    }
}
