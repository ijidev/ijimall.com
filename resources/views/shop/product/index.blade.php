@extends('shop.layouts.app')
@section('title')
    My Products
@endsection

@section('content')

<div class="card">
    <div class="card-header p-2">
        <a class="btn btn-light" href="{{ route('vendor.createproduct') }}">Create New Product</a>
    </div>
</div>
    
<div class="card">
    <div class="card-body col-md-12">
        <h5 class="card-title">My Products</h5>
        <table class="table font-bold">
            <thead>
                <tr>
                    <th> </th>
                    <th> </th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Action</th>
                    {{-- <th>Price Total</th> --}}
                </tr>
            </thead>
            
            
            <tbody>
                @forelse ($products as $product)
                {{-- {{ dd($item) }} --}}
                {{-- @php
                    $total = $item->price * $item->pivot->quantity 
                @endphp --}}

                  <tr>
                    <td class="align-left">
                        <img alt="product image" src="{{ asset('dashboard_asset/assets/img/products/product-1.png') }}"
                        class="rounded-circle" width="40" data-toggle="tooltip"
                        title="{{ $product->name }}">
                    </td>
                    
                    <td>
                        {{ $product->name }}
                    </td>
                
                    {{-- <td>
                        x{{ $item->pivot->quantity }}
                    </td> --}}

                    <td>
                        ${{ $product->price }}
                    </td>

                    <td>
                        {{ $product->description }}
                    </td>

                    <td>
                        <div class="dropdown d-inline">
                        <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton2"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item has-icon" href="{{ route('vendor.viewproduct', $product->id) }}"><i class="far fa-eye"></i> View</a>
                            <a class="dropdown-item has-icon" href="{{ route('vendor.editproduct', $product->id) }}"><i class="far fa-trash text-bg-dark"></i> Update</a>
                            <a class="dropdown-item has-icon" href="{{ route('vendor.deleteproduct', $product->id) }}"><i class="far fa-trash text-bg-dark"></i> Deleet</a>
                            {{-- <a class="dropdown-item has-icon" href="#"><i class="far fa-clock"></i> Something else here</a> --}}
                        </div>
                        </div>
                    </td>
                    
                </tr> 
                @empty 
                
                @endforelse
                
            </tbody>
        </table>
    </div>
</div>
       

@endsection