<main id="main">
    <div class="container">
    <style>
        .btn {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            display: inline-block;
            font-size: 15px;
            position: relative;
        }
    </style>
        <!--MAIN SLIDE-->
        <div class="wrap-main-slide">
            <div class="slide-carousel owl-carousel style-nav-1" data-items="1" data-loop="1" data-nav="true" data-dots="false">
                @foreach ($sliders as $slider)
                    <div class="item-slide">
                        <img src="{{ asset('assets_cust/assets/images/sliders/'. $slider->image)}}" alt="" class="img-slide">
                        <div class="slide-info slide-1">
                            <h2 class="f-title">New !!  <b>{{ $slider->title }}</b></h2>
                            <span class="subtitle">{{ $slider->subtitle }}</span>
                            <p class="sale-info">Only price: <span class="price"> $ {{ $slider->price }}</span></p>
                            <a href="{{ $slider->link }}" class="btn-link">Shop Now</a>
                        </div>
                    </div>
                @endforeach
                
                
            </div>
        </div>

        <!--On Sale-->
        @if ($sale_products -> count() > 0 && $onsale->status == 1 && $onsale->sale_date > Carbon\Carbon::now() )
            <div class="wrap-show-advance-info-box style-1 has-countdown">
                <h3 class="title-box">On Sale</h3>
                <div class="wrap-countdown mercado-countdown" data-expire="{{ Carbon\Carbon::parse($onsale->sale_date)->format('Y/m/d h:m:s') }}"></div>
                <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container " data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}'>
                    @foreach ($sale_products as $sale_product)    
                        <div class="product product-style-2 equal-elem ">
                            <div class="product-thumnail">
                                <a href="{{ route('product.details', $sale_product->slug )}}" title="{{ $sale_product->name }}">
                                    <figure><img src="{{ asset('assets_cust/assets/images/products/'. $sale_product->image)}}" width="800" height="800" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                                </a>
                                <div class="group-flash">
                                    <span class="flash-item sale-label">sale</span>
                                </div>
                                <div class="wrap-btn">
                                    <a href="{{ route('product.details', $sale_product->slug )}}" class="function-link">quick view</a>
                                </div>
                            </div>
                            <div class="product-info" style="text-align: center;">
                                <a href="{{ route('product.details', $sale_product->slug )}}" class="product-name"><span>{{ $sale_product->name }}</span></a>
                                <div class="wrap-price"><ins><p class="product-price">Rp. {{ $sale_product->sale_price }}</p></ins> <del><p class="product-price">${{ $sale_product->regular_price }}</p></del></div>
                                <h6 style="text-align: left;">{{ $sale_product->short_description}}</h6>
                                <a href="{{ route('product.details', $sale_product->slug)}}" class="btn" style="margin-top: 10px;">Beli</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>    
        @endif

        <!--Latest Products-->
        <div class="wrap-show-advance-info-box style-1">
            <h3 class="title-box">Latest Products</h3>
            
            <div class="wrap-products">
                <div class="wrap-product-tab tab-style-1">						
                    <div class="tab-contents">
                        <div class="tab-content-item active" id="digital_1a">
                            <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}' >
                                
                                @foreach ($lastproduct as $lproduct)
                                    <div class="product product-style-2 equal-elem ">
                                        <div class="product-thumnail">
                                            <a href="{{ route('product.details', $lproduct->slug)}}" title="{{ $lproduct->name }}">
                                                <figure><img src="{{ asset('assets_cust/assets/images/products/'. $lproduct->image)}}" width="800" height="800" alt="{{ $lproduct->name }}"></figure>
                                            </a>
                                            <div class="group-flash">
                                                <span class="flash-item new-label">new</span>
                                            </div>
                                            <div class="wrap-btn">
                                                <a href="{{ route('product.details', $lproduct->slug)}}" class="function-link">quick view</a>
                                            </div>
                                        </div>
                                        <div class="product-info" style="text-align: center;">
                                            <a href="{{ route('product.details', $lproduct->slug)}}" class="product-name"><span>{{ $lproduct->name }}</span></a>
                                            <div class="wrap-price"><span class="product-price">Rp.  {{ $lproduct->regular_price }}</span></div>
                                            <h6 style="text-align: left;">{{ $lproduct->short_description}}</h6>
                                            <a href="{{ route('product.details', $lproduct->slug)}}" class="btn" style="margin-top: 10px;">Beli</a>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>							
                    </div>
                </div>
            </div>
        </div>
        <!--Product Categories-->
        <div class="wrap-show-advance-info-box style-1">
            <h3 class="title-box">Product Categories</h3>
        
            <div class="wrap-products">
                <div class="wrap-product-tab tab-style-1">
                    <div class="tab-control">
                        @foreach ($categories as $key=>$category)    
                            <a href="#category_{{ $category->slug }}" class="tab-control-item {{$key==0 ? 'active':''}}">{{ $category->name }}</a>
                        @endforeach
                    </div>
                    <div class="tab-contents">

                        @foreach ($categories as $key=>$category)
                            <div class="tab-content-item {{$key==0 ? 'active':''}}" id="category_{{ $category->slug }}">
                                <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}' >
                                    @php
                                        $c_products      = App\Models\Product::where('category_id', $category->id)->get()->take($no_of_product);
                                    @endphp
                                    @foreach ($c_products as $c_product)
                                        <div class="product product-style-2 equal-elem ">
                                            <div class="product-thumnail">
                                                <a href="{{ route('product.details', $c_product->slug)}}" title="{{ $c_product->name }}">
                                                    <figure><img src="{{ asset('assets_cust/assets/images/products/'. $c_product->image)}}" width="800" height="800" alt="{{ $c_product->name }}"></figure>
                                                </a>
                                            </div>
                                            <div class="product-info"  style="text-align: center;">
                                                <a  href="{{ route('product.details', $c_product->slug)}}" class="product-name"><span style="text-align: center; font-size:medium;">{{ $c_product->name }}</span></a>
                                                <div style="text-align: center;" class="wrap-price"><span class="product-price">Rp. {{ $c_product->regular_price }}</span></div>
                                                <h6  style="text-align: left;">{{ $c_product->short_description}}</h6>
                                                <a href="{{ route('product.details', $c_product->slug)}}" class="btn" style="margin-top: 10px;">Beli</a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach

                        
                    </div>
                </div>
            </div>
        </div>			

    </div>

</main>