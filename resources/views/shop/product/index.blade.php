@extends('shop.layouts.app')
@section('title')
    My Products
@endsection

@section('content')


   @if ($products->count() <= 0)
        <div class="col-12 col-md-12 col-sm-12">
            <div class="card">
            <div class="card-header">
                <h4></h4>
            </div>
            <div class="card-body">
                <div class="empty-state" data-height="400">
                <div class="empty-state-icon">
                    <i class="fas fa-question"></i>
                </div>
                <h2>No Product Found</h2>
                <p class="lead">
                    Create yout first product to see them here.
                </p>
                <a href="{{ route('vendor.createproduct') }}" class="btn btn-primary mt-4">Create new</a>
                {{-- <a href="#" class="mt-4 bb">Need Help?</a> --}}
                </div>
            </div>
            </div>
        </div>
   @else
   <form action="{{ route('vendor.product.action') }}">
        <div class="card">
            <div class="card-header p-2 row">
                <span class="col-4">
                    <a class="btn btn-light" href="{{ route('vendor.createproduct') }}">Create New Product</a>
                </span>
                <span class="content-justify-left bb">
                    <a class="btn btn-link" href="{{ route('vendor.all.product') }}">All</a>
                    <a class="btn btn-link" href="{{ route('vendor.product') }}">Published</a>
                    <a class="btn btn-link" href="{{ route('vendor.pending.product') }}">Pending Approval</a>
                    <a class="btn btn-link" href="{{ route('vendor.draft.product') }}">draft</a>
                    <a class="btn btn-link" href="{{ route('vendor.trashed.product') }}">trashed</a>
                </span>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-light">
                <h5 class="card-title">My Products</h5>
            </div>
            <div class="card-body  mt-0 table-responsive">
                <table class="table font-bold">
                    <tr class="bg-light pt-0">
                        <th class="text-center">
                            <div class="custom-checkbox custom-checkbox-table custom-control">
                                <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad"
                                    class="custom-control-input" id="checkbox-all">
                                <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                            </div>
                        </th>
                        <th> </th>
                        <th> </th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Action</th>
                        {{-- <th>Price Total</th> --}}
                    </tr>
                        
                    @foreach ($products as $product) 
                        <tr>

                            <td class="p-0 text-center">
                                <div class="custom-checkbox custom-control">
                                    <input type="checkbox" data-checkboxes="mygroup" value="{{ $product->id }}" class="custom-control-input"
                                        id="checkbox-{{ $product->id }}" name="selected[]">
                                    <label for="checkbox-{{ $product->id }}" class="custom-control-label">&nbsp;</label>
                                </div>


                                </div>
                            </td>

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
                                <span class="badge bg-orange">{{ $product->status = ($product->status == 'pending') ? 'Pending Approval' : $product->status ;  }}</span>
                            </td>

                            <td>
                                <div class="dropdown d-inline">
                                <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton2"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Action
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item has-icon" href="{{ route('vendor.viewproduct', $product->id) }}"><i class="far fa-eye"></i> View</a>
                                    <a class="dropdown-item has-icon" href="{{ route('vendor.editproduct', $product->id) }}"><i class="fas fa-edit "></i> Edit</a>
                                    <a class="dropdown-item has-icon" href="{{ route('vendor.trash.product', $product->id) }}"><i class="fa fa-trash" aria-hidden="true"></i> Trash</a>
                                    {{-- <a class="dropdown-item has-icon" href="#"><i class="far fa-clock"></i> Something else here</a> --}}
                                </div>
                                </div>
                            </td>
                            
                        </tr>   
                    @endforeach
                </table>
            </div>

            <div class="card-footer bg-light">
                <div class="row d-flex">
                {{-- footer left elenemt --}}
                    <div class="flex-grow-1">
                        <nav class="d-inline-block">
                            <ul class="pagination mb-0">
                                <div class="form-group row p-2">
                                    {{-- <label for="my-select">Text</label> --}}
                                    <select id="my-select" class="form-control col-8" name="action">
                                        <option value="pending">set as Pending</option>
                                        <option value="draft">set to draft</option>
                                        <option value="trash">Move to trash</option>
                                        <option value="delete">Delete Selected</option>
                                    </select>
                                    <button type="submit" class="btn btn link-light col-4">Submit</button>
                                </div>
                            </ul>
                        </nav>
                    </div> 
                    
                    {{-- footer right elenemt --}}
                    <div class="text-right">
                        <nav class="d-inline-block">
                            {{ $products->render() }}
                        </nav>
                    </div> 
                </div>
            </div>
        </div> 
   </form>
   @endif 

       

@endsection