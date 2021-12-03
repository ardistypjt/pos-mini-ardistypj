@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.7.0/nouislider.min.css" integrity="sha512-40vN6DdyQoxRJCw0klEUwZfTTlcwkOLKpP8K8125hy9iF4fi8gPpWZp60qKC6MYAFaond8yQds7cTMVU8eMbgA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
<main id="main" class="main-site left-sidebar">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="{{ route('/') }}" class="link">home</a></li>
                <li class="item-link"><span>Digital & Electronics</span></li>
            </ul>
        </div>
        <div class="row">

            <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 main-content-area">

                <div class="wrap-shop-control">

                    <h1 class="shop-title">Digital & Electronics</h1>

                    <div class="wrap-right">

                        <div class="sort-item orderby ">
                            <select name="orderby" class="use-chosen" wire:model="sorting">
                                <option value="default" selected="selected">Default sorting</option>
                                {{-- <option value="popularity">Sort by popularity</option> --}}
                                <option value="datenew">Sort by newness</option>
                                <option value="dateold">Sort by oldest</option>
                                <option value="price">Sort by price: low to high</option>
                                <option value="price-desc">Sort by price: high to low</option>
                            </select>
                        </div>

                        <div class="sort-item product-per-page">
                            <select name="post-per-page" class="use-chosen" wire:model="pageSize">
                                <option value="12" selected="selected">12 per page</option>
                                <option value="16">16 per page</option>
                                <option value="18">18 per page</option>
                                <option value="21">21 per page</option>
                                <option value="24">24 per page</option>
                                <option value="30">30 per page</option>
                                <option value="32">32 per page</option>
                            </select>
                        </div>

                        <div class="change-display-mode">
                            <a href="#" class="grid-mode display-mode active"><i class="fa fa-th"></i>Grid</a>
                            <a href="list.html" class="list-mode display-mode"><i class="fa fa-th-list"></i>List</a>
                        </div>

                    </div>

                </div><!--end wrap shop control-->

                <div class="row">

                    <ul class="product-list grid-products equal-container">
                        @foreach ($products as $product)
                            <li class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ">
                                <div class="product product-style-3 equal-elem ">
                                    <div class="product-thumnail">
                                        <a href="{{ route('product.details', $product->slug)}}" title="{{ $product->name }}">
                                            <figure><img src="{{ asset('assets_cust/assets/images/products/' . $product->image)}}" alt="{{ $product->name }}"></figure>
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <a href="{{ route('product.details', $product->slug)}}" class="product-name"><span>{{ $product->name }}</span></a>
                                        @if ($product->sale_price > 0 && $onsale->status == 1 && $onsale->sale_date > Carbon\Carbon::now())
                                            <div class="wrap-price"><ins><p class="product-price">${{ $product->sale_price }}</p></ins> <del><p class="product-price">${{ $product->regular_price }}</p></del></div>
                                        @else
                                            <div class="wrap-price"><span class="product-price">$ {{ $product->regular_price }}</span></div>    
                                        @endif
                                        @if ($product->sale_price > 0)
                                            <a href="#" class="btn add-to-cart" wire:click.prevent= "store({{$product->id}}, '{{ $product->name }}', {{ $product->sale_price }})">Add To Cart</a>
                                        @else
                                            <a href="#" class="btn add-to-cart" wire:click.prevent= "store({{$product->id}}, '{{ $product->name }}', {{ $product->regular_price }})">Add To Cart</a>    
                                        @endif
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                </div>

                <div class="wrap-pagination-info text-center">
                    {{ $products->links("pagination::bootstrap-4") }}
                    {{-- <ul class="page-numbers">
                        <li><span class="page-number-item current" >1</span></li>
                        <li><a class="page-number-item" href="#" >2</a></li>
                        <li><a class="page-number-item" href="#" >3</a></li>
                        <li><a class="page-number-item next-link" href="#" >Next</a></li>
                    </ul>
                    <p class="result-count">Showing 1-8 of 12 result</p> --}}
                </div>
            </div><!--end main products area-->

            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 sitebar">
                <div class="widget mercado-widget categories-widget">
                    <h2 class="widget-title">All Categories</h2>
                    <div class="widget-content">
                        <ul class="list-category">
                            @foreach ($category_p as $category)
                                <li class="category-item">
                                    <a href="{{ route('product.category', $category->slug)}}" class="cate-link">{{ $category->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div><!-- Categories widget-->

                <div class="widget mercado-widget filter-widget price-filter">
                    <h2 class="widget-title">Range Price <span class="text-danger">Rp.{{ $minrangeP }} - Rp.{{ $maxrangeP }}</span></h2>
                    <div class="widget-content" style="padding: 10px 5px 40px 5px;">
                        <div id="slider" wire:ignore></div>
                    </div>
                </div>
                <!-- Price-->

            </div><!--end sitebar-->

        </div><!--end row-->

    </div><!--end container-->

</main>
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.7.0/nouislider.min.js" integrity="sha512-jWNpWAWx86B/GZV4Qsce63q5jxx/rpWnw812vh0RE+SBIo/mmepwOSQkY2eVQnMuE28pzUEO7ux0a5sJX91g8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    var slider = document.getElementById('slider')
    noUiSlider.create(slider,{
        start : [1,1000],
        connect :true,
        range :{
            'min' :1,
            'max' : 1000,
        },
        pips:{
            mode:'steps',
            stepped:true,
            destiny:4
        }
    });

    slider.noUiSlider.on('update', function(value){
        @this.set('minrangeP', value[0]);
        @this.set('maxrangeP', value[1]);
    });
</script>

@endpush