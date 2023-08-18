@extends('shop.layouts.app')
@section('title')
Coupons
@endsection

@section('content')

        <div class="row">
          <div class="col-12">
            <div class="card mb-0">
              <div class="card-body p-2">
                <div class="float-right">
                    <ul class="nav nav-pills">
                      <li class="nav-item">
                        <a class="nav-link" href="{{ route('vendor.coupon') }}">All <span class="badge badge-warning">{{ $all }}</span></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="{{ route('vendor.coupon.expired') }}">Expired<span class="badge badge-danger">{{ $exp }}</span></a>
                      </li>
                    </ul>
                </div>

                <div class="float-left">
                    <div class="card-body p-2">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add New</button>
                      </div>
                    
                </div>

              </div>
            </div>
          </div>
        </div>

        <div class="row mt-4">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>My Coupon</h4>
              </div>

              <form action="{{ route('vendor.coupon.action') }}">
              <div class="card-body">

                

                <div class="clearfix mb-3"></div>
                <div class="table-responsive">
                  <table class="table table-striped">
                    <tr>
                      <th class="pt-2">
                        <div class="custom-checkbox custom-checkbox-table custom-control">
                          <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad"
                            class="custom-control-input" id="checkbox-all">
                          <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                        </div>
                      </th>
                      <th>Coupon Code</th>
                      <th>Value</th>
                      <th>Description</th>
                      <th>Created At</th>
                      <th>Usable</th>
                      <th>Used</th>
                      <th>Status</th>
                    </tr>
                    @foreach ($coupons as $coupon)
                        <tr>

                        <td>
                            <div class="custom-checkbox custom-control">
                            <input type="checkbox" name="action[]" value="{{ $coupon->id }}" data-checkboxes="mygroup" class="custom-control-input"
                                id="checkbox-{{ $coupon->id }}">
                            <label for="checkbox-{{ $coupon->id }}" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>


                        <td>
                            {{ $coupon->code }}
                            <div class="table-links">
                            <a href="{{ route('vendor.coupon.edit', $coupon->id) }}">Edit</a>
                            <div class="bullet"></div>
                            <a href="{{ route('vendor.coupon.delete',$coupon->id) }}" class="text-danger">Trash</a>
                            </div>
                        </td>

                        <td>
                            @if ($coupon->discountType == 'percent')
                               {{ '%'. $coupon->value }}
                            @else
                               {{ $currency->symbol . $coupon->value * $currency->rate}}
                            @endif
                        </td>

                        
                        <td>
                            {{ $coupon->description }}
                        </td>

                        <td>10-02-2019</td>
                        <td>
                            @if ($coupon->usable == null)
                                ~
                            @else
                                {{ $coupon->usable }}
                            @endif
                        </td>
                        
                        <td>
                            @if ($coupon->usable == null)
                                {{ $coupon->used }}
                            @else
                                {{ $coupon->used .'/'. $coupon->usable }}
                            @endif
                        </td>
                        <td>
                            @if ($coupon->expired == true)
                                <div class="badge badge-danger">expired</div>
                            @else
                                <div class="badge badge-warning">Active</div>
                            @endif
                        </td>

                        </tr>  
                    @endforeach
                    </form>
                  </table>
                </div>
                <div class="pt-4">
                  <div class="float-left">
                      <div class="input-group">
                          <select name="selected" class="form-control selectric">
                              <option>Action</option>
                              <option value="expired">Sat as Expired</option>
                              <option value="delete">Delete</option>
                          </select>
                          <div class="input-group-append">
                              <button class="btn btn-primary" type="submit">submit</button>
                          </div>
                      </div>
                  </div>
  
                  <div class="float-right">
                      {{  $coupons->render() }}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

    
@endsection
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="formModal">Create Coupon</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">

        <form action="{{ route('vendor.coupon.store') }}">
            <div class="form-group">
              <label for="">Coupon Code</label>
              <input type="text" class="form-control" name="code" id="" aria-describedby="helpId" placeholder="Summer5%off">
              <small id="helpId" class="form-text text-muted">Help text</small>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                      <label for="">Value</label>
                      <input type="number" class="form-control" name="value" id="" aria-describedby="helpId" placeholder="">
                      <small id="helpId" class="form-text text-muted">Percentage value / Amount in ({{ $currency->symbol }})</small>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="my-select">Type</label>
                        <select id="my-select" class="form-control" name="type">
                            <option value="percent">Percentage</option>
                            <option value="flat">Fiat</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
              <label for="">Usage</label>
              <input type="number" class="form-control" name="usable" id="" aria-describedby="helpId" placeholder="">
              <small id="helpId" class="form-text text-muted">How many times coupon can be used before expires. 
                leave blank for unlimited</small>
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="" rows="3"></textarea>
            </div>

            <button class="btn btn-primary" type="submit">Create</button>
        </form>

        </div>
    </div>
    </div>
</div>