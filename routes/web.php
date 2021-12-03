<?php

use App\Http\Livewire\Admin\AdminDashboardComponent;
use App\Http\Livewire\Admin\AdminCategoriesComponent;
use App\Http\Livewire\Admin\AdminHomeManageComponent;
use App\Http\Livewire\Admin\AdminProductComponent;
use App\Http\Livewire\Admin\AdminHomeSlidersComponent;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\CheckOutComponent;
use App\Http\Livewire\DetailsProductComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\SearchComponent;
use App\Http\Livewire\ShopComponent;
use App\Http\Livewire\User\UserDashboardComponent;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', HomeComponent::class)->name('/');

Route::get('/shop', ShopComponent::class)->name('shop');

Route::get('/cart', CartComponent::class)->name('cart');

Route::get('/checkout', CheckOutComponent::class)->name('checkout');

Route::get('/product/{slug}', DetailsProductComponent::class)->name('product.details');

Route::get('/product-category/{category_slug}', CategoryComponent::class)->name('product.category');

Route::get('/search', SearchComponent::class)->name('product.search');


// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

//! Admin
Route::middleware(['auth:sanctum', 'verified', 'authadmin'])->group(function () {
    Route::get('/admin/admin-dashboard', AdminDashboardComponent::class,)->name('admin.dashboard');
    Route::get('/admin/admin-categories', AdminCategoriesComponent::class)->name('admin.categories');
    Route::get('/admin/admin-products', AdminProductComponent::class)->name('admin.products');
    Route::get('/admin/admin-home-sliders', AdminHomeSlidersComponent::class)->name('admin.homesliders');
    Route::get('/admin/admin-home-categories', AdminHomeManageComponent::class)->name('admin.homemanage');
});

//? User
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/user-dashboard', UserDashboardComponent::class)->name('user.dashboard');
});
