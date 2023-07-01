@extends('admin/layout.tmpl')
@section('content')

<div class="card">
    <span class="row pl-4">
        <a href="{{ route('admin.products') }}" class="btn btn-link">All</a>
        <a href="{{ route('admin.product.pending') }}" class="btn btn-link">Pending</a>
        <a href="{{ route('admin.trashProduct') }}" class="btn btn-link">Trashed</a>
        <a href="{{ route('admin.product.draft') }}" class="btn btn-link">Draft</a>
    </span>
    
</div>
            
<div class="card">
    <div class="card-header">
        <h4>Product table</h4>
        <div class="card-header-form">
            

            <form action="{{ route('admin.product.search') }}">
                <div class="input-group">
                    <input type="text" name="query" class="form-control" placeholder="Search">
                    <div class="input-group-btn">
                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <form action="{{ route('product.action') }}">

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped">
                    <tr class=" bg-primary text-light">
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
                        <th>Status</th>
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
                            <span class="badge bg-orange">{{ $product->status }}</span>
                        </td>

                        <td>
                            <a href="{{ route('admin.editProduct', $product->id) }}" class="btn btn-link"><i class="fas fa-edit "></i>Edit</a>
                            <a href="{{ route('admin.trash.product',  $product->id) }}" class="btn btn-link"> <i class="fas fa-trash "></i> Trash</a>
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
                        <ul class="pagination mb-0">
                            <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1 <span
                                class="sr-only">(current)</span></a></li>
                            <li class="page-item">
                            <a class="page-link" href="#">2</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                            <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                            </li>
                        </ul>
                    </nav>
                </div> 
            </div>
        </div>

    </form>
</div>
   

@endsection