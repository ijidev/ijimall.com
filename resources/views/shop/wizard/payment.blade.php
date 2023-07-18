<!DOCTYPE html>
<html lang="en">


<!-- index.html  21 Nov 2019 03:44:50 GMT -->

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title> @yield('title') - Vendor Panel</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('dashboard_asset/assets/css/app.min.css') }}">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard_asset/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard_asset/assets/css/components.css') }}">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard_asset/assets/css/custom.css') }}">
    <link rel='shortcut icon' type='image/x-icon' href="{{ asset('dashboard_asset/assets/img/favicon.ico') }}" />
</head>

<body>
    <div class="">
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
    </div>

    
    


    <script src="{{ asset('dashboard_asset/assets/js/app.min.js') }}"></script>
    <script src="{{ asset('dashboard_asset/assets/bundles/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <!-- JS Libraies -->
    <script src="{{ asset('dashboard_asset/assets/bundles/apexcharts/apexcharts.min.js') }}"></script>
    <!-- Page Specific JS File -->
    <script src="{{ asset('dashboard_asset/assets/js/page/index.js') }}"></script>
    <script src="{{ asset('dashboard_asset/assets/bundles/jquery-steps/jquery.steps.min.js') }}"></script>
    <!-- Page Specific JS File -->
    <script src="{{ asset('dashboard_asset/assets/js/page/form-wizard.js') }}"></script>
    <script src="{{ asset('dashboard_asset/assets/js/scripts.js') }}"></script>
    <!-- Custom JS File -->
    <script src="{{ asset('dashboard_asset/assets/js/custom.js') }}"></script>
</body>


<!-- index.html  21 Nov 2019 03:47:04 GMT -->

</html>
