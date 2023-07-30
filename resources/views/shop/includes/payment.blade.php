@extends('shop.layouts.app')
@section('title')
    Set-up Payment
@endsection
@section('content')

<div class="row justify-content-center m-t-40 ">
    <div class="col-lg-8 col-md-8 col-sm-10 col-xs-11 flex">
        <div class="card">
            <div class="card-header justify-content-center">
                <h4 class="text-center" >Seller Setup Wizard - Withdrawal Details </h4>
            </div>
            <div class="card-body">
                <form action="{{ route('wizard.finish') }}">
            
                    
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="AccountName" class="form-label">Bank Account Name</label>
                                <input type="text" required
                                class="form-control" name="Name" id="" aria-describedby="helpId" placeholder="">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="">
                                <label for="accountNumber" class="form-label">Account Number</label>
                                <input type="number" required
                                class="form-control" name="accountNumber" max="9999999999" id="" aria-describedby="name" placeholder="">
                            </div>
                        </div>
                        {{-- <small id="name" class="form-text ml-3 text-muted">This could be yourself or a member of your team who will manage your store</small> --}}
                    </div>

                    <div class="mb-4">
                    <label for="BankName" class="form-label">Bank Name</label>
                    <input type="text"
                        class="form-control" required name="bankName" id="" aria-describedby="helpId" placeholder="">
                        {{-- <small id="helpId" class="form-text text-muted">This will be the email we will use primarily to contact you for all communication</small> --}}
                    </div>
                    <button class="btn btn-success" type="submit">Finish</button>
                    <a href="{{ route('vendor.index') }}" class="btn btn-danger text-white">Skip</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection