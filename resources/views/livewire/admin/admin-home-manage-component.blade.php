@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css" integrity="sha512-63+XcK3ZAZFBhAVZ4irKWe9eorFG0qYsy2CaM5Z+F3kUn76ukznN0cp4SArgItSbDFD1RrrWgVMBY9C/2ZoURA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" integrity="sha512-aEe/ZxePawj0+G2R+AaIxgrQuKT68I28qh+wgLrcAJOz3rxCP+TwrK5SPN+E5I+1IQjNtcfvb96HDagwrKRdBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.css" integrity="sha512-2e0Kl/wKgOUm/I722SOPMtmphkIjECJFpJrTRRyL8gjJSJIP2VofmEbqyApMaMfFhU727K3voz0e5EgE3Zf2Dg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.min.css" integrity="sha512-tjNtfoH+ezX5NhKsxuzHc01N4tSBoz15yiML61yoQN/kxWU0ChLIno79qIjqhiuTrQI0h+XPpylj0eZ9pKPQ9g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

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
                    <h2 class="text-white font-weight-bold my-2 mr-5">Sales Periode</h2>
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
                <div class="col-lg-6">
                    <div class="card card-custom gutter-b ">
                        <!--begin::Header-->
                        <div class="card-header border-0 py-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder text-dark">Manage Home Sale</span>
                            </h3>
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pl-10 pr-10">
                            <form wire:submit.prevent="storeHomeSale">
                                <div class="form-group row">
                                    <label class="col-form-label col-4">Sale Date</label>
                                    <div class="col-8">
                                        <div class="input-group date" >
                                            <input type="text" class="form-control sale_date" id="sale_date" placeholder="Select date &amp; time" wire:model="sale_date" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-search-input" class="col-4 col-form-label">Status</label>
                                    <div class="radio-inline col-8">
                                        <label class="radio radio-danger">
                                            <input type="radio" wire:model="status" value="1" name="radios" />
                                        <span></span>Active</label>
                                        <label class="radio radio-danger">
                                            <input type="radio" wire:model="status" value="0" name="radios" />
                                        <span></span>Non Active</label>
                                        @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary font-weight-bold">Submit</button>
                                </div>
                            </form>
                        </div>
                        <!--end::Body-->
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card card-custom gutter-b">
                        <!--begin::Header-->
                        <div class="card-header border-0 py-10">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder text-dark">Manage Home Category</span>
                            </h3>
                            
                        </div>
                        <!--end::Header-->
                        <div class="pl-10 pr-10">
                            <form wire:submit.prevent="storeHomeCategory">
                                @csrf
                                {{-- <input type="hidden" wire:model="idhidden" value="{{$idhidden}}"> --}}
                                <div class="form-group row">
                                    <label class="col-form-label col-4">Multi Select</label>
                                    <div class="col-8" wire:ignore>
                                        <select class="form-control select2 sel_category" name="category[]" id="kt_select2_3" wire:model="selected_category" multiple="multiple">
                                            <optgroup label="Select Category">
                                                @foreach ($categories as $category)        
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-search-input" class="col-4 col-form-label">Number Product</label>
                                    <div class="col-8">
                                        <input class="form-control" type="text" wire:model="number_product" id="example-search-input"/>
                                        @error('number_product')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <br>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary font-weight-bold">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
@push('scripts')
    <script>
        $(function () {
                $('#sale_date').datetimepicker({
                    format :'Y-MM-DD hh:mm:ss',
                })
                .on('dp.change', function(ev){
                    var data = $('#sale_date').val();
                    @this.set('sale_date', data);
                });
            
        }); 
        $(document).ready(function(){
            $('.sel_category').select2();
                $('.sel_category').on('change', function(e){
                    var data = $('.sel_category').select2("val");
                    @this.set('selected_category', data);
            });
        });
    </script>
    <script src="{{ asset('assets/js/pages/crud/forms/widgets/select2f552.js?v=7.1.8')}}"></script>
    {{-- <script src="{{ asset('assets/js/pages/crud/forms/widgets/bootstrap-datetimepickerf552.js?v=7.1.8') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js" integrity="sha512-GDey37RZAxFkpFeJorEUwNoIbkTwsyC736KNSYucu1WJWFK9qTdzYub8ATxktr6Dwke7nbFaioypzbDOQykoRg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush

