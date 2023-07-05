@extends('layouts.app')
@section('content')


<table class="table">
    <thead>
        <tr>
            <th>Remove</th>
            <th>Product</th> 
            <th>Price</th>
            <th>Quantity</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($cart_items as $item)
        <tr>
            <td scope="row"><a href="{{ route('cart.delete', $item->id) }}" class="btn btn-banger">X</a></td>
            <td>{{ $item->name }}</td>
            <td>{{$currency->symbol . $price = Cart::get($item->id)->getPriceSum() * $currency->rate }}</td>
            {{-- <form action="{{ route('cart.update' , $item->id) }}"> --}}
                <td>
                    <div class="col-5">
                        <input type="number" class="form-control" value="{{ $item->quantity }}" min="1" max="100" step="1" data-decimals="0" required>

                    </div>
                    
                    {{-- <a href="{{ route('cart.update_r' , $item->id) }}" class="btn btn-danger">-</a>
                      
                    <a href="{{ route('cart.update' , $item->id) }}" class="btn btn-primary">+</a> --}}
                    
                    
                    {{-- <button class="btn-primary" >update</button> --}}
                </td> 
            {{-- </form> --}}
        </tr>
        @empty
        Your cart is empty
        @endforelse
    </tbody>
</table> 

<form action="{{ route('coupon') }}">
    <div class="input-group col-sm-4">
        <input type="text" name="coupon" class="form-control" required placeholder="coupon code">
        <div class="input-group-append">
            <button class="btn btn-outline-primary" type="submit"> <i class="fa fa-arrow-right" aria-hidden="true"></i> </button>
        </div><!-- .End .input-group-append -->
    </div><!-- End .input-group -->
</form>
<div>Product Total: {{$currency->symbol . $subtotal = Cart::session(Auth::user())->getSubTotal() * $currency->rate}}</div>
<div>Total Payable: {{$currency->symbol . $total = Cart::session(Auth::user())->getTotal() * $currency->rate}}</div>
<a class="btn btn-primary" href="{{ route('cart.checkout') }}">Proceed to checkout</a>
   

@endsection



