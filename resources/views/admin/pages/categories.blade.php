@extends('admin.layout.tmpl')
@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Add New category</h4>
                    </div>
                    <form action="{{ route('create.category') }}" >
                        <div class="card-body">
                            <div class="form-group">
                                <label>Category name</label>
                                <input type="text" name="category" placeholder="enter name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Parent Category</label>
                                <select class="form-control" name="parent">
                                    <option value="">Parent Category</option>

                                    @foreach ($categories->where('parent_id', '==', null) as $category)
                                        <option value='{{ $category->id }}'>{{ $category->name }}</option>

                                        @foreach ($categories->where('parent_id', $category->id) as $sub)
                                            <option value='{{ $sub->id }}'>{{ $sub->name }}</option>
                                        @endforeach
                                    @endforeach
                                    
                                </select>
                            </div>
    
                            <label for="Category_image">Category Image</label>
                            <div class="form-group">
                                <input type="file" value="image" class="fom-control">
                            </div>
                            <button class="btn btn-light">Add Category</button>
                        </div>
                    </form>
                </div>
            </div>

            
                <div class="col-12 col-md-6 col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Categories</h4>
                        <div class="card-header-form">
                            <form>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <form action="{{ route('action') }}">

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
                                        <th>Category</th>
                                        <th>Edit</th>
                                        {{-- <th>Parent</th> --}}
                                        {{-- <th>Product count</th> --}}
                                        
                                    </tr>
                                    @forelse ($categories->where('parent_id', '==', null) as $category)
                                    
                                    <tr class="bg-light">
                                        <td class="p-0 text-center">
                                            <div class="custom-checkbox custom-control">
                                                <input type="checkbox" data-checkboxes="mygroup" value="{{ $category->id }}" class="custom-control-input"
                                                    id="checkbox-{{ $category->id }}" name="selected[]">
                                                <label for="checkbox-{{ $category->id }}" class="custom-control-label">&nbsp;</label>
                                            </div>


                                            </div>
                                        </td>

                                        <td>
                                            <img alt="image" src="{{ asset('dashboard_asset/assets/img/products/product-1.png') }}"
                                                class="rounded-circle" width="35" data-toggle="tooltip"
                                                title="{{ $category->name }}">
                                        </td>

                                        <td>
                                            {{ $category->name }}
                                        </td>

                                        <td>
                                            <a href="{{ route('admin.cat.edit', $category->id) }}" class="btn btn-link"><i class="fas fa-edit "></i>Edit</a>
                                            <a href="{{ route('admin.cat.delete',  $category->id) }}" class="btn btn-link"> <i class="fas fa-trash "></i> Delete</a>
                                        </td>

                                    </tr>

                                        @forelse ($category->subcat->where('parent_id', $category->id) as $sub)
                                                
                                            <tr>
                                                
                                                <td class="p-0 text-center">
                                                    <div class="custom-checkbox custom-control">
                                                        <input type="checkbox" value="{{ $sub->id }}" data-checkboxes="mygroup" class="custom-control-input"
                                                            id="checkbox-{{ $sub->name }}" name="selected[]">
                                                        <label for="checkbox-{{ $sub->name }}" class="custom-control-label">&nbsp;</label>
                                                    </div>
                                                </td>
            
                                                <td>
                                                    
                                                </td>

                                                <td>
                                                    <div class="badge bg-light">sub</div> {{ $sub->name }} 
                                                </td>

                                                <td>
                                                    <a href="{{ route('admin.cat.edit', $sub->id) }}" class="btn btn-link"><i class="fas fa-edit "></i>Edit</a>
                                                    <a href="{{ route('admin.cat.delete',  $sub->id) }}" class="btn btn-link"> <i class="fas fa-trash "></i> Delete</a>
                                                </td>
                                            </tr> 

                                                @forelse ($category->subcat->where('parent_id','==', $sub->id) as $child)
                                                        
                                                    <tr>
                                                        
                                                        <td class="p-0 text-center">
                                                            <div class="custom-checkbox custom-control">
                                                                <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input"
                                                                    id="checkbox-{{ $child->name }}" name="selected[]">
                                                                <label for="checkbox-{{ $child->name }}" class="custom-control-label">&nbsp;</label>
                                                            </div>
                                                        </td>
                    
                                                        <td>
                                                            
                                                        </td>

                                                        <td>
                                                            <div class="badge bg-light">child</div> {{ $child->name }} 
                                                        </td>

                                                        <td>
                                                            <a href="{{ route('admin.cat.edit', $child->id) }}" class="btn btn-link"><i class="fas fa-edit "></i>Edit</a>
                                                            <a href="{{ route('admin.cat.delete',  $child->id) }}" class="btn btn-link"> <i class="fas fa-trash "></i> Delete</a>
                                                        </td>
                                                    </tr> 

                                                    @empty
                                                        {{--if empty do notting --}}
                                                @endforelse

                                            @empty
                                                {{--if empty do notting --}}
                                        @endforelse
                                        

                                    @empty
                                    <tr>
                                        <td>

                                        </td>

                                        <td>

                                        </td>

                                        <td>
                                            <h6>
                                                No category found
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
                                            <div class="form-group">
                                                {{-- <label for="my-select">Text</label> --}}
                                                <select id="my-select" class="form-control" name="action">
                                                    <option value="delete">Delete Selected</option>
                                                </select>
                                                <button type="submit" class="btn btn link-light">Submit</button>
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
            </div>   
        </div>
    </div>
@endsection
