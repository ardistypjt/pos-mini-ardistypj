<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;
use illuminate\support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class AdminProductComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $name, $slug, $short_description, $description, $regular_price, $sale_price;
    public $stok_status, $quantity, $image, $category_id, $idhidden;
    public $newimage;
    public $searchTerm;
    public $currentPage = 1;

    public $imgwiremodel = 'image';
    public $judulform = 'Tambah Products';
    public $hapusproduct = null;

    protected $listeners =  ['deleteconfirmed' => 'deleteproduct'];


    protected function rules()
    {
        return [
            'name' => 'required|unique:products,name,' . $this->idhidden,
            'slug' => 'required|unique:products,slug,' . $this->idhidden,
            'short_description' => 'required',
            'description' => 'required',
            'regular_price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'stok_status' => 'required',
            'quantity' => 'required',
            'image' => 'required',
            'category_id' => 'required',
        ];
    }

    protected $message = [
        'category_id.required' => 'Category required',
    ];

    public function render()
    {
        $searchTerm = '%' . $this->searchTerm . '%';
        $categories = Category::all();
        $products   = Product::where('name', 'like', $searchTerm)->paginate(5);
        return view('livewire.admin.admin-product-component', compact('products', 'categories'))->layout('layouts.master', ['title' => 'Admin Products']);
    }


    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }


    public function storeproduct()
    {
        $updateID = $this->idhidden;
        if ($updateID > 0) {
            $product = Product::where('id', $updateID)->first();
            $this->validate();

            $product->name = $this->name;
            $product->slug = $this->slug;
            $product->short_description = $this->short_description;
            $product->description = $this->description;
            $product->regular_price = $this->regular_price;
            $product->sale_price = $this->sale_price;
            $product->stok_status = $this->stok_status;
            $product->quantity = $this->quantity;
            $product->category_id = $this->category_id;
            if ($this->newimage) {
                // Delete File lama
                $file = public_path('assets_cust/assets/images/products/' . $product->image);
                if (file_exists($file)) {
                    @unlink($file);
                }
                $imgname = Carbon::now()->timestamp . rand(100, 999) . '.' . $this->newimage->getClientOriginalExtension();
                $product->image = $imgname;
                $this->newimage->storePubliclyAs('products', $imgname, 'imagefile');
            }
            $product->save();
            session()->flash("success", "Data product telah diubah !", "success");
        } else {
            $this->validate();
            $imgname = Carbon::now()->timestamp . rand(100, 999) . '.' . $this->image->getClientOriginalExtension();

            $product = new Product;

            $product->name = $this->name;
            $product->slug = $this->slug;
            $product->short_description = $this->short_description;
            $product->description = $this->description;
            $product->regular_price = $this->regular_price;
            $product->sale_price = $this->sale_price;
            $product->stok_status = $this->stok_status;
            $product->quantity = $this->quantity;
            $product->image = $imgname;
            $this->image->storePubliclyAs('products', $imgname, 'imagefile');
            $product->category_id = $this->category_id;
            $product->save();
            session()->flash("success", "Data product telah ditambahkan !", "success");
        }
    }


    public function addform()
    {
        $this->judulform = 'Tambah Product';
        $this->imgwiremodel = 'image';
        $this->name = '';
        $this->slug = '';
        $this->idhidden = '';
        $this->short_description = '';
        $this->description = '';
        $this->regular_price = '';
        $this->sale_price = '';
        $this->stok_status = '';
        $this->quantity = '';
        $this->image = '';
        $this->category_id = '';
        $this->newimage = '';
    }


    public function editform($id)
    {
        $product = Product::find($id);

        $this->imgwiremodel = 'newimage';
        $this->judulform = 'Edit Product ' . $product->name;
        $this->idhidden = $product->id;
        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->short_description = $product->short_description;
        $this->description = $product->description;
        $this->regular_price = $product->regular_price;
        $this->sale_price = $product->sale_price;
        $this->stok_status = $product->stok_status;
        $this->quantity = $product->quantity;
        $this->image = $product->image;
        $this->category_id = $product->category_id;
        $this->newimage = '';
    }


    public function confirmDelete($id)
    {
        $this->hapusproduct = $id;
        $this->dispatchBrowserEvent('show-delete-confirm');
    }


    public function deleteproduct()
    {
        $product = Product::find($this->hapusproduct);
        $file = public_path('assets_cust/assets/images/products/' . $product->image);

        if (file_exists($file)) {
            @unlink($file);
        }
        $product->delete();
        // session()->flash("success", "Data category telah dihapus !", "success");
    }

    public function setPage($url)
    {
        $this->currentPage = explode('page=', $url)[1];
        Paginator::currentPageResolver(function () {
            return $this->currentPage;
        });
    }
}
