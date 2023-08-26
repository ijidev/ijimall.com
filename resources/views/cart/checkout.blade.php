@extends('frontend.layouts.app')
@section('content')
    <h2>Checkout Page</h2>

    <form action="{{ route('order.store') }}" method="post">
        <div class="row">
            <div class="col-md-8">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4> Shipping Information</h4>
                    </div>

                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">First Name</label>
                                <input type="text" class="form-control" name="shipping_fname" placeholder="First Name">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputLastname">Last Name</label>
                                <input type="text" class="form-control" name="shipping_lname" placeholder="Last Name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputAddress">Address</label>
                            <input type="text" class="form-control" name="shipping_address" placeholder="1234 Main St">
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputCountry">County</label>
                                <input type="text" class="form-control" name="shipping_country"
                                    placeholder="New Zealand, USA, Canada">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputCountry">Phone</label>
                                <input type="tel" class="form-control" name="shipping_phone" placeholder="+1 1234567">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputCity">City</label>
                                <input type="text" class="form-control" name="shipping_city">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="inputState">State</label>
                                <input type="text" class="form-control" name="shipping_state" id="state">
                                {{-- <select id="inputState" class="form-control">
                                <option selected>Choose...</option>
                                <option>...</option>
                            </select> --}}
                            </div>

                            <div class="form-group col-md-2">
                                <label for="inputZip">Zip</label>
                                <input type="text" class="form-control" name="shipping_zipcode">
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputNote">Note</label>
                            <input type="textarea" class="form-control" name="note">
                        </div>

                        <div class="form-group mb-0">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="checkbox" id="gridCheck">
                                <label class="form-check-label" for="gridCheck">
                                    Ship to a diffrent address
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button class="btn btn-primary">Place Order</button>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Order Details</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text"> <b>Total: </b> {{ $currency->symbol . $total = $total_price * $currency->rate }} </p>

                        <div class="form-group">
                            <div class="control-label">Paymeny Methold</div>
                            <div class="custom-switches-stacked mt-2">
                                <label class="custom-switch">
                                    <input type="radio" name="payment" value="bank" class="custom-switch-input" checked>
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description">Bank Transfer</span>
                                </label>
                                <label class="custom-switch">
                                    <input type="radio" name="payment" value="card" class="custom-switch-input">
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description">Card </span>
                                </label>
                                {{-- <label class="custom-switch">
                                    <input type="radio" name="option" value="3" class="custom-switch-input">
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description">Option 3</span>
                                    </label> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
