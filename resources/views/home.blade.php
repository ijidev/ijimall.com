@extends('frontend.layouts.front')

@section('content')
<div class="card-body">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
</div>

<div class="">
    @include('frontend.partials.homeslider')
</div>

@include('frontend.partials.popularcart')
<div class="row">
        
    {{-- @forelse ($products as $product)
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
        <div class="card">
            <img class="card-img-top" src="{{ asset('/assets/products/product-1.png') }}" alt="">
            <div class="card-body">
                <h4 class="card-title">{{ $product->name }}</h4>
                <p class="card-text">{{ $product->description }}</p>
                <span>{{ $currency->symbol. $price = $product->price * $currency->rate }}</span>
                <a href="{{ Route('cart.add', $product->id) }}" class="btn btn-light">Add to Cart</a>
            </div>
        </div>
    </div>
    @empty
        <div class="h4">No product found</div>
    @endforelse --}}
    
</div>  

<div class="mb-6" ></div><!-- End .mb-6 -->

@include('frontend.partials.homeproduct')

<div class="icon-boxes-container">
    <div class="container">
        <div class="row">
            <div class="col-6 col-md-3 col-lg-3">
                <div class="icon-box icon-box-side">
                    <span class="icon-box-icon text-dark">
                        <i class="icon-rocket"></i>
                    </span>
                    <div class="icon-box-content">
                        <h3 class="icon-box-title">Free Shipping</h3><!-- End .icon-box-title -->
                        <p>orders $50 or more</p>
                    </div><!-- End .icon-box-content -->
                </div><!-- End .icon-box -->
            </div><!-- End .col-sm-6 col-lg-3 -->

            <div class="col-6 col-md-3 col-lg-3">
                <div class="icon-box icon-box-side">
                    <span class="icon-box-icon text-dark">
                        <i class="icon-rotate-left"></i>
                    </span>

                    <div class="icon-box-content">
                        <h3 class="icon-box-title">Free Returns</h3><!-- End .icon-box-title -->
                        <p>within 30 days</p>
                    </div><!-- End .icon-box-content -->
                </div><!-- End .icon-box -->
            </div><!-- End .col-sm-6 col-lg-3 -->

            <div class="col-6 col-md-3 col-lg-3">
                <div class="icon-box icon-box-side">
                    <span class="icon-box-icon text-dark">
                        <i class="icon-info-circle"></i>
                    </span>

                    <div class="icon-box-content">
                        <h3 class="icon-box-title">Get 20% Off 1 Item</h3><!-- End .icon-box-title -->
                        <p>When you sign up</p>
                    </div><!-- End .icon-box-content -->
                </div><!-- End .icon-box -->
            </div><!-- End .col-sm-6 col-lg-3 -->

            <div class="col-6 col-md-3 col-lg-3">
                <div class="icon-box icon-box-side">
                    <span class="icon-box-icon text-dark">
                        <i class="icon-life-ring"></i>
                    </span>

                    <div class="icon-box-content">
                        <h3 class="icon-box-title">We Support</h3><!-- End .icon-box-title -->
                        <p>24/7 amazing services</p>
                    </div><!-- End .icon-box-content -->
                </div><!-- End .icon-box -->
            </div><!-- End .col-sm-6 col-lg-3 -->
        </div><!-- End .row -->
    </div><!-- End .container -->
</div><!-- End .icon-boxes-container -->

<div class="footer-newsletter bg-image" style="background-image: url({{ asset('front_assets/assets/images/backgrounds/bg-2.jpg') }})">
    <div class="container">
        <div class="heading text-center">
            <h3 class="title">Get The Latest Deals</h3><!-- End .title -->
            <p class="title-desc">and receive <span>$20 coupon</span> for first shopping</p><!-- End .title-desc -->
        </div><!-- End .heading -->

        <div class="row">
            <div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                <form action="#">
                    <div class="input-group">
                        <input type="email" class="form-control" placeholder="Enter your Email Address" aria-label="Email Adress" aria-describedby="newsletter-btn" required>
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit" id="newsletter-btn"><span>Subscribe</span><i class="icon-long-arrow-right"></i></button>
                        </div><!-- .End .input-group-append -->
                    </div><!-- .End .input-group -->
                </form>
            </div><!-- End .col-sm-10 offset-sm-1 col-lg-6 offset-lg-3 -->
        </div><!-- End .row -->
    </div><!-- End .container -->
</div><!-- End .footer-newsletter bg-image -->




@endsection
