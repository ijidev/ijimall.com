@extends('admin/layout.tmpl')
@section('content')

<div class="row col-12 card">
   <div class="card-body">
      <form action="{{ route('admin.createproduct') }}">
      <div class="form-group">
        <label for="productName">Product Name</label>
        <input type="text" class="form-control" name="name" id="" aria-describedby="helpId" placeholder="">
        <small id="productName" class="form-text text-muted">Help text</small>
      </div>

      <div class="form-group">
        <label for="productPrice">Product price</label>
        <input type="number" class="form-control" name="price" id="" aria-describedby="helpId" placeholder="">
        <small id="productPrice" class="form-text text-muted">Help text</small>
      </div>

      <div class="form-group">
        <label for="productPrice">Product Description</label>
         <textarea class="form-control" name="description" placeholder=""></textarea>
        {{-- <small id="productPrice" class="form-text text-muted">Help text</small> --}}
      </div>

      <div class="form-group">
         <label for="my-select">category</label>
         <select id="my-select" class="form-control form-control-sm" name="category[]" multiple>
           @foreach ($categories->where('parent_id', null) as $category)
                  <option value="{{$category->id}}" class="font-bold bg-gray text-uppercase">{{ $category->name }}</option>
               @forelse ($category->subcat->where('parent_id', $category->id) as $subcat)
                  <option value="{{$subcat->id }}" class="text-gray text-capitalize">{{"- ". $subcat->name }}</option>
               @empty
                  
               @endforelse
           @endforeach

         </select>
      </div>

      <button type="submit" class="btn btn-light">create product</button>
   </form>
   </div>
   
</div>

@endsection