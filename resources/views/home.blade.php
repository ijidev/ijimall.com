@extends('layouts.app')

@section('content')
<div class="container">
    {{-- <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Products') }}</div> --}}

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- {{ __('You are logged in!') }} --}}
                <div class="row">
                        
                    <div class="card-columns">
                        @forelse ($products as $product)
                        <div class="card">
                            <img class="card-img-top" src="{{ asset('/assets/products/product-1.png') }}" alt="">
                            <div class="card-body">
                                <h4 class="card-title">{{ $product->name }}</h4>
                                <p class="card-text">{{ $product->description }}</p>
                                <a href="{{ Route('cart.add', $product->id) }}" class="btn btn-light">Add to Cart</a>
                            </div>

                        </div>
                        @empty
                         <div class="h4">No product found</div>
                        @endforelse
                        
                    </div>
                    
                </div>  
                 
                    
                {{-- <div class="card col-md-3 ">
                    <div class="card-header">
                        <img class="card-img-top" src="{{ asset('/assets/products/product-1.png') }}" alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title">{{ $product->name }}</h4>
                        <p class="card-text">{{ $product->description }}</p>
                    </div>  
                    </div>
                        <a href="{{ Route('cart.add', $product->id) }}" class="card-link">Add to Cart</a>
                    
                </div> --}}
                       
                

               {{-- </div>
            </div>
        </div>
    </div> --}}
</div>
@endsection
