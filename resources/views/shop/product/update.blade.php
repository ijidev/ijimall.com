@extends('shop.layouts.app')
@section('title')
    Create Product
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Title</h5>
            <div class="card-text">
                <div class="container">
                    <form action="{{ route('vendor.updateproduct', $product->id) }}">
                        
                        <div class="form-group row">
                            <label for="ProductName" class="col-sm-1-12 col-form-label">Product Name</label>
                            <div class="col-sm-1-12">
                                <input type="text" class="form-control" value="{{ $product->name }}" name="name" id="ProductName"
                                    placeholder="">
                            </div>

                            <label for="ProductPrice" class="col-form-label">Product Price</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="number" name="price" value="{{ $product->price }}" class="form-control" aria-label="Amount (to the nearest dollar)">
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>
                        <label for="Description">Description</label>
                        <div class="form-group">
                            <input type="textarea" class="form-control" value="{{ $product->description }}" name="description" row="3">
                        </div>

                        <div class="form-group row">
                            
                            <div class="offset-sm-2 col-sm-10">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
