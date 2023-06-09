@extends('admin.layout.tmpl')
@section('content')
    <div class="section-body">
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Add New category</h4>
                    </div>
                    <form action="{{ route('update.category', $category->id) }}" >
                        <div class="card-body">
                            <div class="form-group">
                                <label>Category name</label>
                                <input type="text" name="name" value="{{ $category->name }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Parent Category</label>
                                <select class="form-control"  name="parent">
                                    <option value=""> Select Parent </option>
                                    @foreach ($categories as $cat)

                                        @if ($category->parent_id == $cat->id)
                                            <option selected value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @else
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endif
                                    @endforeach
                                    
                                </select>
                            </div>
    
                            <label for="Category_image">Category Image</label>
                            <div class="form-group">
                                <input type="file" value="image" class="fom-control">
                            </div>
                            <button class="btn btn-light">Update Category</button>
                        </div>
                    </form>
                </div>
            </div>
@endsection