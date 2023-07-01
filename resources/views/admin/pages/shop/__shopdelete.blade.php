@extends('admin.layout.tmpl')
@section('content')
    <form action="{{ route('vendor.del', $shopId) }}">
        <div class="mb-3">
            <label for="" class="form-label">Asign products to another vendor</label>
            <select class="form-select form-select-lg" name="vendor" id="">
                <option selected>Select Vendor</option>
                @foreach ($vendors as $vendor)
                @if ($shopId == $vendor->id)
                    
                @else
                    <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                @endif
                @endforeach
            </select>
        </div>
        <div class="row">
            <button type="submit" name="action" value="asign" class="btn btn-light m-2">Asign Product</button>
            <button type="submit" name="action" value="delete" class="btn btn-danger m-2">Move products to draft</button>
            <a href="{{ route('admin.shopIndex') }}" class="btn btn-orange">Cancel</a>
        </div>
    </form>
@endsection