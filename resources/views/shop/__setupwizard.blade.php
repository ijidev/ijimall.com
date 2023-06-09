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
                        <h4 class="text-center" >Seller Setup Wizard</h4>
                    </div>
                    <div class="card-body">

                        <form action="{{ route('vendor.update',$shop->id) }}" id="wizard_with_validation">
                            <h3>Account Information</h3>
                            <fieldset>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Username*</label>
                                        <input type="text" class="form-control" value="{{ Auth::user()->name }}" name="username" required>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Password*</label>
                                        <input type="password" class="form-control" name="password" id="password" required>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Confirm Password*</label>
                                        <input type="password" class="form-control" name="confirm" required>
                                    </div>
                                </div>
                            </fieldset>

                            <h3>Profile Information</h3>
                            <fieldset>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">First Name*</label>
                                        <input type="text" name="name" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Last Name*</label>
                                        <input type="text" name="surname" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Email*</label>
                                        <input type="email" name="email" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Address*</label>
                                        <textarea name="address" cols="30" rows="3" class="form-control no-resize" required></textarea>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Age*</label>
                                        <input min="18" type="number" name="age" class="form-control" required>
                                    </div>
                                    <div class="help-info">The warning step will show up if age is less than 18</div>
                                </div>
                            </fieldset>

                            <h3>Terms &amp; Conditions - Finish</h3>
                            <fieldset>
                                <input id="acceptTerms-2" name="acceptTerms" type="checkbox" required>
                                <label for="acceptTerms-2">I agree with the Terms and Conditions.</label>
                            </fieldset>
                        </form>
                        <a href="{{ route('vendor.index') }}" class="btn btn-link">Skip</a>
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
