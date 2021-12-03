<?php

namespace App\Http\Livewire\Admin;

use App\Models\HomeSlider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class AdminHomeSlidersComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $title, $subtitle, $price, $link, $status, $image;

    public $judulform = 'Tambah Slider';
    public $imgwiremodel = 'image';
    public $newimage;
    public $idhidden;
    public $currentPage = 1;

    public $hapusslider = null;

    protected $listeners =  ['deleteconfirmed' => 'deleteslider'];

    protected function rules()
    {
        return [
            'title' => 'required',
            'subtitle' => 'required',
            'price' => 'required',
            'link' => 'required',
            'status' => 'required|numeric',
            'image' => 'required',
        ];
    }


    public function render()
    {
        $sliders = HomeSlider::paginate(5);
        return view('livewire.admin.admin-home-sliders-component', compact('sliders'))->layout('layouts.master', ['title' => 'Admin Home SLiders']);
    }

    public function addform()
    {
        $this->judulform = 'Tambah Sliders';
        $this->imgwiremodel = 'image';
        $this->title = '';
        $this->subtitle = '';
        $this->price = '';
        $this->link = '';
        $this->status = '';
        $this->image = '';
        $this->newimage = '';
    }

    public function editform($id)
    {
        $slider = HomeSlider::find($id);
        $this->imgwiremodel = 'newimage';

        $this->idhidden = $slider->id;
        $this->judulform = 'Edit Slider ' . $slider->title;
        $this->title = $slider->title;
        $this->subtitle = $slider->subtitle;
        $this->price = $slider->price;
        $this->link = $slider->link;
        $this->status = $slider->status;
        $this->image = $slider->image;
        $this->newimage = '';
    }


    public function storeslider()
    {
        $updateID = $this->idhidden;
        if ($updateID > 0) {
            $slider = HomeSlider::where('id', $updateID)->first();
            $this->validate();

            $slider->title = $this->title;
            $slider->subtitle = $this->subtitle;
            $slider->price = $this->price;
            $slider->link = $this->link;
            $slider->status = $this->status;
            if ($this->newimage) {
                // Delete File lama
                $file = public_path('assets_cust/assets/images/sliders/' . $slider->image);
                if (file_exists($file)) {
                    @unlink($file);
                }

                $imgname = Carbon::now()->timestamp . rand(100, 999) . '.' . $this->newimage->getClientOriginalExtension();
                $slider->image = $imgname;
                $this->newimage->storePubliclyAs('sliders', $imgname, 'imagefile');
            }
            $slider->save();
            session()->flash("success", "Data slider telah diubah !", "success");
        } else {
            $this->validate();
            $imgname = Carbon::now()->timestamp . rand(100, 999) . '.' . $this->image->getClientOriginalExtension();

            $slider = new HomeSlider;

            $slider->title = $this->title;
            $slider->subtitle = $this->subtitle;
            $slider->price = $this->price;
            $slider->link = $this->link;
            $slider->status = $this->status;
            $slider->image = $imgname;
            $this->image->storePubliclyAs('sliders', $imgname, 'imagefile');
            $slider->save();
            session()->flash("success", "Data slider telah ditambahkan !", "success");
        }
    }


    public function confirmDelete($id)
    {
        $this->hapusslider = $id;
        $this->dispatchBrowserEvent('show-delete-confirm');
    }


    public function deleteslider()
    {
        $slider = HomeSlider::find($this->hapusslider);
        $file = public_path('assets_cust/assets/images/sliders/' . $slider->image);

        if (file_exists($file)) {
            @unlink($file);
        }
        $slider->delete();
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
