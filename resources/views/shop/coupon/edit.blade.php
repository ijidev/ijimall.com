@extends('shop.layouts.app')
@section('title')
Edit Coupon
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h6>Edit Coupon</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('vendor.coupon.update',$coupon->id) }}">
            <div class="form-group">
              <label for="">Coupon Code</label>
              <input type="text" class="form-control" name="code" id="" aria-describedby="helpId" value="{{ $coupon->code }}">
              <small id="helpId" class="form-text text-muted">Help text</small>
            </div>
        
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                      <label for="">Value</label>
                      <input type="number" class="form-control" name="value" value="{{ $coupon->value }}" id="" aria-describedby="helpId" placeholder="">
                      <small id="helpId" class="form-text text-muted">Percentage value / Amount in ({{ $currency->name }})</small>
                    </div>
                </div>
                
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="my-select">Type</label>
                        <select id="my-select" class="form-control" name="type">
                            @if ($coupon->discountType == 'percent')
                            <option selected value="percent">Percentage</option>
                            <option value="flat">Fiat</option>
                            @else
                            <option value="percent">Percentage</option>
                            <option selected value="fixed">Fiat</option>
                            @endif
                        </select>
                        <small id="helpId" class="form-text text-muted">Coupon Type</small>
                    </div>
                </div>
            </div>
        
            <div class="row">
                <div class="col-sm-6">
                    <div class="form group mb-3">
                        <label for="" class="form-label">Status</label>
                        <select class="form-select form-select-lg form-control" name="expired" id="">
                            @if ($coupon->expired == true)
                                <option value="0">Active</option>
                                <option selected value="1">Expired</option>
                            @else
                                <option selected value="0">Active</option>
                                <option value="1">Expired</option>
                            @endif
                        </select>
                    </div>
                </div>
        
                <div class="col-sm-6">
                    <div class="form-group">
                      <label for="">Usage</label>
                      <input type="number" class="form-control" name="usable" id="" aria-describedby="helpId" value="{{ $coupon->usable }}">
                      <small id="helpId" class="form-text text-muted">How many times coupon can be used before expires. 
                        leave blank for unlimited</small>
                    </div>
                </div>
            </div>
        
        
            <div class="mb-3">
                <label for="" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="" rows="3">{{ $coupon->description }}</textarea>
            </div>
        
            <button class="btn btn-primary" type="submit">Update</button>
        </form>
    </div>
</div>
@endsection