@extends('frontend.layouts.app')
@section('content')

@if ($items->count() >= 1)
    
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
        @foreach ($items as $item)
        <tr>
            <td scope="row"><a href="{{ route('cart.delete', $item->id) }}" class="btn btn-banger">X</a></td>
            <td>{{ $item->product->name }}</td>
            <td>{{$currency->symbol . $amount = $item->amount * $currency->rate }}</td>
            <form action="{{ route('cart.update' , $item->id) }}">
                <td>
                    <div class="col-5">
                        <input type="number" class="form-control" name="quantity" value="{{ $item->quantity }}" min="1" max="100" step="1" data-decimals="0" required>
                    </div>
                    <button class="btn-primary" >update</button>
                </td> 
            </form>
        </tr>
        @endforeach
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
<div>Cart Total: {{$currency->symbol . $items->sum('amount') * $currency->rate }}</div>
{{-- <div>Total Payable: {{$currency->symbol . $total = Cart::session(Auth::user())->getTotal() * $currency->rate}}</div> --}}
<a class="btn btn-link" href="{{ route('cart.checkout') }}">Procced to Checkout</a>

@else
    <h3>cart is empty</h3>
@endif

@endsection



