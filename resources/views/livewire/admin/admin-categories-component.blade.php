<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    @if (Session::has('success'))
        <script>
            toastr.optionsOverride = 'positionclass = "toast-bottom-right"';
            toastr.options.positionClass = 'toast-bottom-right';
            toastr.success("{{ Session::get("success") }}");
        </script>
    @endif
    <script>
        window.addEventListener('show-delete-confirm', event => {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!"
                }).then(function(result) {
                if (result.value) {
                    Livewire.emit('deleteconfirmed')
                    Swal.fire(
                        "Deleted!",
                        "Your file has been deleted.",
                        "success"
                    )
                }
            });
        });
    </script>
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
        <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Heading-->
                <div class="d-flex flex-column">
                    <!--begin::Title-->
                    <h2 class="text-white font-weight-bold my-2 mr-5">Kelola Kategori</h2>
                    <!--end::Title-->
                </div>
                <!--end::Heading-->
            </div>
            <!--end::Info-->
        </div>
    </div>
    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card card-custom gutter-b ">
                        <!--begin::Header-->
                        <div class="card-header border-0 py-10">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder text-dark">List Kategori</span>
                                <span class="text-muted mt-3 font-weight-bold font-size-sm">More than 400+ new members</span>
                            </h3>
                            <div class="card-toolbar">
                                <a href="#" class="btn btn-success font-weight-bolder font-size-sm" wire:click.prevent="addform">
                                <span class="svg-icon svg-icon-md svg-icon-white">
                                    <!--begin::Svg Icon | path:/metronic/theme/html/demo2/dist/assets/media/svg/icons/Communication/Add-user.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24" />
                                            <path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                            <path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>Add New Category</a>
                            </div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body py-0">
                            <!--begin::Table-->
                            <div class="table-responsive">
                                <table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_1">
                                    <thead>
                                        <tr class="text-center">
                                            <th class="pr-0" style="width: 50px">no</th>
                                            <th style="min-width: 200px">Name</th>
                                            <th style="min-width: 200px">Slug</th>
                                            <th class="pr-0 text-right" style="min-width: 150px">action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr class="text-center">
                                                <td class="pl-0">
                                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ $loop->iteration }}</span>
                                                </td>
                                                <td class="pr-0">
                                                    <span class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $category->name }}</span>
                                                </td>
                                                <td class="pl-0">
                                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ $category->slug }}</span>
                                                </td>
                                                <td class="pr-0 text-right">
                                                    <a href="javascript:void(0)" class="btn btn-icon btn-light btn-hover-success btn-sm mx-3" wire:click.prevent="editform({{ $category->id }})">
                                                        <span class="svg-icon svg-icon-md svg-icon-primary">
                                                            <!--begin::Svg Icon | path:/metronic/theme/html/demo2/dist/assets/media/svg/icons/Communication/Write.svg-->
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24" height="24" />
                                                                    <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)" />
                                                                    <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                                </g>
                                                            </svg>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </a>
                                                    <a href="javascript:void(0)" class="btn btn-icon btn-light btn-hover-danger btn-sm" wire:click.prevent="confirmDelete({{ $category->id }})">
                                                        <span class="svg-icon svg-icon-md svg-icon-primary">
                                                            <!--begin::Svg Icon | path:/metronic/theme/html/demo2/dist/assets/media/svg/icons/General/Trash.svg-->
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24" height="24" />
                                                                    <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero" />
                                                                    <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3" />
                                                                </g>
                                                            </svg>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!--end::Table-->
                            <br>
                            <div class="text-right">
                                {{ $categories->links("pagination::custom-paginate") }}
                            </div>
                            
                        </div>
                        <!--end::Body-->
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card card-custom gutter-b card-header border-1  ">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder text-dark" >{{ $judulform }}</span>
                            {{-- <span class="text-muted mt-3 font-weight-bold font-size-sm">More than 400+ new members</span> --}}
                        </h3>
                        <form wire:submit.prevent="storecategory">
                            @csrf
                            <input type="hidden" wire:model="idhidden" value="{{$idhidden}}">
                            <div class="form-group row">
                                <label  class="col-4 col-form-label">Name</label>
                                <div class="col-8">
                                    <input class="form-control" type="text" value="{{ old('name')}}" wire:model="name" wire:keyup="generateSlug" id="example-text-input"/>
                                </div>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="example-search-input" class="col-4 col-form-label">Slug</label>
                                <div class="col-8">
                                    <input class="form-control" type="search" value="{{ old('slug')}}" wire:model="slug" id="example-search-input"/>
                                </div>
                                @error('slug')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary font-weight-bold">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>


