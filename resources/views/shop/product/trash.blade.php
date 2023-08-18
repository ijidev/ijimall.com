@extends('shop.layouts.app')
@section('title')
    Trashed Product
@endsection

@section('content')

<form action="{{ route('vendor.product.action') }}">

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped">
                    <tr class=" bg-light">
                        <th class="text-center">
                            <div class="custom-checkbox custom-checkbox-table custom-control">
                                <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad"
                                    class="custom-control-input" id="checkbox-all">
                                <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                            </div>
                        </th>
                        <th>image</th>
                        <th>Product</th>
                        <th>Product description</th>
                        <th>status</th>
                        <th class="text-center">Edit</th>
                        {{-- <th>Parent</th> --}}
                        
                    </tr>
                    @forelse ($products as $product)
                    
                    <tr>
                        <td class="p-0 text-center">
                            <div class="custom-checkbox custom-control">
                                <input type="checkbox" data-checkboxes="mygroup" value="{{ $product->id }}" class="custom-control-input"
                                    id="checkbox-{{ $product->id }}" name="selected[]">
                                <label for="checkbox-{{ $product->id }}" class="custom-control-label">&nbsp;</label>
                            </div>
    
    
                            </div>
                        </td>
    
                        <td>
                            <img alt="image" src="{{ asset('dashboard_asset/assets/img/products/product-1.png') }}"
                                class="rounded-circle" width="35" data-toggle="tooltip"
                                title="{{ $product->name }}">
                        </td>
    
                        <td>
                            {{ $product->name }}
                        </td>
    
                        <td>
                            {{ $product->description }}
                        </td>
    
                        <td>
                            <span class="badge bg-light">{{ 'trashed' }}</span>
                        </td>
    
                        <td>
                            <a href="{{ route('vendor.restore.product', $product->id) }}" class="btn btn-link"><i class="fas fa-edit "></i>Restore</a>
                            <a href="{{ route('vendor.deleteproduct',  $product->id) }}" class="btn btn-link"> <i class="fas fa-trash "></i> Delete</a>
                        </td>
    
                    </tr>
                    @empty
                    <tr>
                        <td>
    
                        </td>
    
                        <td>
    
                        </td>
    
                        <td>
                            <h6>
                                No Product found
                            </h6>
                        </td>
                            
                        
                    </tr>
                    @endforelse
                    
    
                </table>
            </div>
        </div>
    
        <div class="card-footer">
            <div class="row d-flex">
            {{-- footer left elenemt --}}
                <div class="flex-grow-1">
                    <nav class="d-inline-block">
                        <ul class="pagination mb-0">
                            <div class="form-group row m-2">
                                {{-- <label for="my-select">Text</label> --}}
                                <select id="my-select" class="form-control col-8" name="action">
                                    <option value="delete">Delete Selected</option>
                                    <option value="restore">Restore Selected</option>
                                </select>
                                <button type="submit" class="btn btn bg-orange col-4">Submit</button>
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

@endsection
