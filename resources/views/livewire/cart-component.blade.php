<main id="main" class="main-site">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="#" class="link">home</a></li>
                <li class="item-link"><span>login</span></li>
            </ul>
        </div>
        <div class=" main-content-area">
            @if (Session::has('success_message'))
                <script>
                    toastr.success("{{ Session::get('success_message') }}");
                </script>
            @endif
            <div class="wrap-iten-in-cart">
                <h3 class="box-title">Products Name</h3>
                @if (Cart::count() > 0)
                    <ul class="products-cart">
                        @foreach (Cart::content() as $item)
                        {{-- {{dd(Cart::content())}} --}}
                            <li class="pr-cart-item">
                                <div class="product-image">
                                    <figure><img src="{{ asset('assets_cust/assets/images/products/'. $item->model['image'])}}" alt="{{ $item->model['name']}}"></figure>
                                </div>
                                <div class="product-name">
                                    
                                    <a class="link-to-product" href="{{ route('product.details', $item->model['slug']) }}">{{ $item->model['name'] }}</a>
                                </div>
                                @if ($item->model['sale_price'] > 0)
                                    <div class="price-field produtc-price"><p class="price">Rp. {{ $item->model['sale_price'] }}</p></div>
                                @else
                                    <div class="price-field produtc-price"><p class="price">Rp. {{ $item->model['regular_price'] }}</p></div>
                                @endif
                                <div class="quantity">
                                    <div class="quantity-input">
                                        <input type="text" name="product-quatity" value="{{ $item->qty }}" data-max="{{ $item->quantity }}" pattern="[0-9]*" >									
                                        <a class="btn btn-increase" wire:click.prevent="increaseQuantity('{{$item->rowId}}')" href="#"></a>
                                        <a class="btn btn-reduce" wire:click.prevent="decreaseQuantity('{{$item->rowId}}')" href="#"></a>
                                    </div>
                                </div>
                                <div class="price-field sub-total"><p class="price">Rp. {{ $item->subtotal }}</p></div>
                                <div class="delete">
                                    <a href="#" wire:click.prevent="remove('{{$item->rowId}}')" class="btn btn-delete" title="">
                                        <span>Delete from your cart</span>
                                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </li>  	
                        @endforeach										
                    </ul>
                @else
                    <b> Tidak ada Item </b>
                @endif
                
            </div>

            <div class="summary">
                <div class="order-summary">
                    <h4 class="title-box">Order Summary</h4>
                    <p class="summary-info"><span class="title">Subtotal</span><b class="index">Rp. {{ Cart::subtotal() }}</b></p>
                    <p class="summary-info"><span class="title">Tax</span><b class="index">Rp. {{ Cart::tax() }}</b></p>
                    <p class="summary-info"><span class="title">Shipping</span><b class="index">Free Shipping</b></p>
                    <p class="summary-info total-info "><span class="title">Total</span><b class="index">Rp. {{ Cart::subtotal() }}</b></p>
                </div>
                <div class="checkout-info">
                    <a class="btn btn-checkout" href="checkout.html">Check out</a>
                    <a class="link-to-shop" href="shop.html">Continue Shopping<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                </div>
                <div class="update-clear">
                    <a class="btn btn-clear" wire:click.prevent="destroyAll()" href="#">Clear Shopping Cart</a>
                    <a class="btn btn-update" href="#">Update Shopping Cart</a>
                </div>
            </div>

        </div><!--end main content area-->
    </div><!--end container-->

</main>