{{-- <x-mail::message> --}}
@extends('layouts.app')
@section('content')
    
# Order Invoice

Thank you for your order.

<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>e</td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <th>#</th>
            <th>#</th>
            <th>#</th>
        </tr>
    </tfoot>
</table>


{{-- <x-mail::button :url="''"> 
Button Text
 </x-mail::button> --}}

Thanks,<br>
{{ config('app.name') }}
{{-- </x-mail::message> --}}

@endsection