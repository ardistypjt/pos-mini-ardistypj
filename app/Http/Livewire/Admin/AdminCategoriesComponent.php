<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use illuminate\support\Str;
use Alert;
use Illuminate\Pagination\Paginator;
use Livewire\WithPagination;

class AdminCategoriesComponent extends Component
{
    use WithPagination;

    public $name, $slug, $idhidden;
    public $judulform = 'Tambah Category';
    public $hapuscategory = null;
    public $currentPage = 1;

    protected $listeners =  ['deleteconfirmed' => 'deletecategory'];

    protected $rules = [
        'name' => 'required|unique:categories',
        'slug' => 'required|unique:categories',
    ];


    public function render()
    {
        $categories = Category::paginate(5);
        return view('livewire.admin.admin-categories-component', compact('categories'))->layout('layouts.master', ['title' => 'Manage Category']);
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function storecategory()
    {
        $updateID = $this->idhidden;
        if ($updateID > 0) {
            $edit = Category::where('id', $updateID)->first();
            $this->validate();
            $category = [
                'name'      => $this->name,
                'slug'  => $this->slug,
            ];
            $edit->update($category);
            session()->flash("success", "Data category telah diubah !", "success");
        } else {
            $this->validate();
            $category = new Category;
            $category->name = $this->name;
            $category->slug = $this->slug;
            $category->save();
            session()->flash("success", "Data category telah ditambahkan !", "success");
        }
    }

    public function addform()
    {
        $this->judulform = 'Tambah Category';
        $this->name = '';
        $this->slug = '';
        $this->idhidden = '';
    }

    public function editform($id)
    {
        $category = Category::find($id);
        $this->judulform = 'Edit Category';
        $this->name = $category->name;
        $this->slug = $category->slug;
        $this->idhidden = $category->id;
    }

    public function confirmDelete($id)
    {
        $this->hapuscategory = $id;
        $this->dispatchBrowserEvent('show-delete-confirm');
    }

    public function deletecategory()
    {
        $category = Category::find($this->hapuscategory);
        $category->delete();
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
