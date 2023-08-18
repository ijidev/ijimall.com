@extends('shop.layouts.app')
@section('title') Setup Store @endsection
@section('content')

<div class="col-12">
    <div class="card bg-light">
      {{-- <div class="card-body"> --}}
        <div class="row">

          <div class="col-4 col-sm-3 p-2">
            <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="home-tab4" data-toggle="tab" href="#shop4" role="tab"
                  aria-controls="home" aria-selected="true">Shop</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="profile-tab4" data-toggle="tab" href="#profile4" role="tab"
                  aria-controls="profile" aria-selected="false">Profile</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="contact-tab4" data-toggle="tab" href="#contact4" role="tab"
                  aria-controls="contact" aria-selected="false">Contact</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="payment-tab4" data-toggle="tab" href="#payment4" role="tab"
                  aria-controls="contact" aria-selected="false">payment</a>
              </li>
            </ul>
          </div>

          <div class="col-8 col-sm-9 bg-white p-3 m-0">
            <div class="tab-content no-padding" id="myTab2Content">
               
                {{-- Shop info --}}
              <div class="tab-pane fade show active" id="shop4" role="tabpanel" aria-labelledby="home-tab4">
                <div class="card-header text-dark">
                  <h5>Shop Info</h5>
                </div>
                
                <div class="input-group mb-3">
                  <span class="input-group-text bg-light">Cover Image</span>
                  <input type="file" name="cover" id="cover" class="form-control">
                </div>

                <div class="input-group mb-3">
                  <span class="input-group-text bg-light">Logo</span>
                  <input type="file" name="logo" id="name" class="form-control">
                </div>
                
                <div class="input-group mb-3">
                  <span class="input-group-text bg-light">Name</span>
                  <input type="text" class="form-control" name="shopName" id=""  value="{{ $store->name }}" placeholder="Store name">
                </div>

                <div class="input-group mb-3">
                  <span class="input-group-text bg-light">Address</span>
                  <input type="text" class="form-control" name="address" id="address"  value="{{ $store->address }}" placeholder="Store Address">
                </div>

                <div class="row">
                  
                  <div class="input-group mb-3 col-sm-6">
                    <span class="input-group-text bg-light">city</span>
                    <input type="text" name="city" id="city" class="form-control" placeholder="city">
                  </div>
                  
                  <div class="input-group mb-3 col-sm-6">
                    <span class="input-group-text bg-light">zip</span>
                    <input type="text" name="zip" id="zipcode" class="form-control" placeholder="eg. 511101">
                  </div>

                </div>
                
                <div class="row">
                  
                  <div class="input-group mb-3 col-sm-6">
                    <span class="input-group-text bg-light">county</span>
                    <input type="text" name="country" id="county" class="form-control" placeholder="city">
                  </div>
                  
                  <div class="input-group mb-3 col-sm-6">
                    <span class="input-group-text bg-light">Phone</span>
                    <input type="tel" name="phone" id="phone" class="form-control" placeholder="Office Phone">
                  </div>

                </div>
                
                <div class="mb-3">
                  <label for="" class="form-label">About Shop</label>
                  <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                  <small id="helpId" class="form-text text-muted">Help text</small>
                </div>



              </div>

              <div class="tab-pane fade" id="profile4" role="tabpanel" aria-labelledby="profile-tab4">
                Sed sed metus vel .
              </div>

              <div class="tab-pane fade" id="contact4" role="tabpanel" aria-labelledby="contact-tab4">
                Vestibulum ut luctus.
              </div>

              {{-- payment tab --}}
              <div class="tab-pane fade text-dark" id="payment4" role="tabpanel" aria-labelledby="payment-tab4">
                  <div class="card-header">
                    <h5>Withdrawal Info</h5>
                  </div>
                <form action="{{ route('wizard.finish') }}">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="AccountName" class="form-label">Account Name</label>
                                <input type="text" required
                                class="form-control" name="Name" id="" aria-describedby="helpId" placeholder="">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="">
                                <label for="accountNumber" class="form-label">Account Number</label>
                                <input type="account" required
                                class="form-control" name="accountNumber" maxlength="10" min="0000000000" max="09999999999" id="" aria-describedby="name" placeholder="">
                            </div>
                        </div>
                        {{-- <small id="name" class="form-text ml-3 text-muted">This could be yourself or a member of your team who will manage your store</small> --}}
                    </div>

                    <div class="mb-4">
                    <label for="BankName" class="form-label">Bank</label>
                    <input type="text"
                        class="form-control" required name="bank" id="" aria-describedby="helpId" placeholder="">
                        {{-- <small id="helpId" class="form-text text-muted">This will be the email we will use primarily to contact you for all communication</small> --}}
                    </div>
                    <button class="btn btn-success" type="submit">Update</button>
                </form>      
              </div>

            </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>

@endsection