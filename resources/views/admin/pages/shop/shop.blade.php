@extends('admin.layout.tmpl')
@section('title')
    {{'update '. $shop->name }}
@endsection
@section('content')
    @if ($shop->is_active == true)
        <div class="badge bg-orange">Active</div>                            
    @elseif ($shop->is_active == false)
        <div class="badge bg-danger text-white">Inactive</div>
    @endif
<form action="{{ route('admin.shop.update', $shop->id) }}">
    <div class="form-group">
        <label for="my-select">Status</label>
        <select id="my-select" class="form-control" name="status">
            <option value=1>Activate</option>
            <option value=0>Deactivate</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>

@endsection