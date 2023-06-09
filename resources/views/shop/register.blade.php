    
<!DOCTYPE html>
<html>
  <head> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> @yield( 'title' || laravel) </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{ asset('vendor_asset/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="{{ asset('vendor_asset/vendor/font-awesome/css/font-awesome.min.css') }}">
    <!-- Custom Font Icons CSS-->
    <link rel="stylesheet" href="{{ asset('vendor_asset/css/font.css') }}">
    <!-- Google fonts - Muli-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{ asset('vendor_asset/css/style.default.css') }}" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{ asset('vendor_asset/css/custom.css') }}">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{ asset('vendor_asset/img/favicon.ico') }}">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
    <div class="login-page">
        <div class="container d-flex align-items-center">
          <div class="form-holder has-shadow">
            <div class="row">
              <!-- Logo & Information Panel-->
              <div class="col-lg-6">
                <div class="info d-flex align-items-center">
                  <div class="content">
                    <div class="logo">
                      <h1>Dashboard</h1>
                    </div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                  </div>
                </div>
              </div>
              <!-- Form Panel    -->
              <div class="col-lg-6 bg-white">
                <div class="form d-flex align-items-center">
                  <div class="content">
                    <form action="{{ route('vendor.create') }}" class="text-left form-validate">
                      <div class="form-group-material">
                        <input id="shop-name" type="text" name="name" required data-msg="Please enter your Shop name" class="input-material">
                        <label for="Shop-name" class="label-material">Shop Name</label>
                      </div>
                      <div class="form-group-material">
                        <input id="shop-description" type="textarea" name="description" required data-msg="Please enter your shop Description" class="input-material">
                        <label for="shop-description" class="label-material">Shop description     </label>
                      </div>
                      {{-- <div class="form-group-material">
                        <input id="register-password" type="password" name="registerPassword" required data-msg="Please enter your password" class="input-material">
                        <label for="register-password" class="label-material">Password        </label>
                      </div>
                      <div class="form-group terms-conditions text-center">
                        <input id="register-agree" name="registerAgree" type="checkbox" required value="1" data-msg="Your agreement is required" class="checkbox-template">
                        <label for="register-agree">I agree with the terms and policy</label>
                      </div>--}}
                      <div class="form-group text-center">
                        <input id="register" type="submit" value="Register" class="btn btn-primary">
                      </div> 
                    </form><small>Already have an account? </small><a href="login.html" class="signup">Login</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="copyrights text-center">
           <p >2018 &copy; Your company. Download From <a target="_blank" href="https://templateshub.net">Templates Hub</a></p>
        </div>
    </div>
</footer>
</div>
</div>
<!-- JavaScript files-->
<script src="{{ asset('vendor_asset/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor_asset/vendor/popper.js/umd/popper.min.js') }}"> </script>
<script src="{{ asset('vendor_asset/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('vendor_asset/vendor/jquery.cookie/jquery.cookie.js') }}"> </script>
<script src="{{ asset('vendor_asset/vendor/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('vendor_asset/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('vendor_asset/js/charts-home.js') }}"></script>
<script src="{{ asset('vendor_asset/js/front.js') }}"></script>
</body>
</html>