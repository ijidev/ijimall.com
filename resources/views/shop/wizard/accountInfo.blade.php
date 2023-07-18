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
                        <h4 class="text-center" >Seller Setup Wizard - Account information </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('wizard.payment') }}">
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="firstName" class="form-label">Store Manager first Name</label>
                                        <input type="text" required
                                        class="form-control" name="firstName" id="" aria-describedby="helpId" placeholder="">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="">
                                        <label for="lastName" class="form-label">Store Manager last Name</label>
                                        <input type="text" required
                                        class="form-control" name="lastName" id="" aria-describedby="name" placeholder="">
                                    </div>
                                </div>
                                <small id="name" class="form-text ml-3 text-muted">This could be yourself or a member of your team who will manage your store</small>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="Phone" class="form-label">Store Manager Phone</label>
                                        <input type="tel" required
                                        class="form-control" name="phone" id="" aria-describedby="helpId" placeholder="">
                                        <small id="name" class="form-text ml- text-muted">This should be the contact number of the person involved in the day to day store managment</small>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="">
                                        <label for="addPhone" required class="form-label">Additional Phone</label>
                                        <input type="tel"
                                        class="form-control" name="add_phone" id="" aria-describedby="name" placeholder="">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                            <label for="ManagerPhone" class="form-label">E-mail Address</label>
                            <input type="email"
                                class="form-control" required name="email" id="" aria-describedby="helpId" placeholder="">
                            <small id="helpId" class="form-text text-muted">This will be the email we will use primarily to contact you for all communication</small>
                            </div>
                                
                            <button type="submit" class="btn btn-success">Save & continue</button>
                            <a href="{{ route('wizard.info.skip') }}" class="btn btn-danger text-white">Skip To Next</a>
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
