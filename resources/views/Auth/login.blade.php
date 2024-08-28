<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Login Page</title>

    <!--Open Sans Font [ OPTIONAL ]-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>

    <!--Bootstrap Stylesheet [ REQUIRED ]-->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!--Nifty Stylesheet [ REQUIRED ]-->
    <link href="{{ asset('css/nifty.min.css') }}" rel="stylesheet">

    <!--Nifty Premium Icon [ DEMONSTRATION ]-->
    <link href="{{ asset('css/demo/nifty-demo-icons.min.css') }}" rel="stylesheet">

    <!--Pace - Page Load Progress Par [OPTIONAL]-->
    <link href="{{ asset('plugins/pace/pace.min.css') }}" rel="stylesheet">
    <script src="{{ asset('plugins/pace/pace.min.js') }}"></script>

    <!--Demo [ DEMONSTRATION ]-->
    <link href="{{ asset('css/demo/nifty-demo.min.css') }}" rel="stylesheet">
</head>

<body>
    <div id="container" class="cls-container">

        <!-- BACKGROUND IMAGE -->
        <div id="bg-overlay"></div>

        <!-- LOGIN FORM -->
        <div class="cls-content">
            <div class="cls-content-sm panel">
                <div class="panel-body">
                    <div class="mar-ver pad-btm">
                        <h1 class="h3">Account Login</h1>
                        <p>Sign In to your account</p>
                    </div>
                    <!-- Use Laravel route for form submission -->
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" name="username" placeholder="Username" autofocus>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                        <div class="checkbox pad-btm text-left">
                            <input id="demo-form-checkbox" class="magic-checkbox" type="checkbox" name="remember">
                            <label for="demo-form-checkbox">Remember me</label>
                        </div>
                        <button class="btn btn-primary btn-lg btn-block" type="submit">Sign In</button>
                    </form>
                </div>

                <div class="pad-all">
                    <a href="{{ route('password.request') }}" class="btn-link mar-rgt">Forgot password?</a>
                    <a href="{{ route('register') }}" class="btn-link mar-lft">Create a new account</a>

                    <div class="media pad-top bord-top">
                        <div class="pull-right">
                            <a href="#" class="pad-rgt"><i class="demo-psi-facebook icon-lg text-primary"></i></a>
                            <a href="#" class="pad-rgt"><i class="demo-psi-twitter icon-lg text-info"></i></a>
                            <a href="#" class="pad-rgt"><i class="demo-psi-google-plus icon-lg text-danger"></i></a>
                        </div>
                        <div class="media-body text-left text-bold text-main">
                            Login with
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- DEMO PURPOSE ONLY -->
        <div class="demo-bg">
            <div id="demo-bg-list">
                <div class="demo-loading"><i class="psi-repeat-2"></i></div>
                <img class="demo-chg-bg bg-trans active" src="{{ asset('img/bg-img/thumbs/bg-trns.jpg') }}" alt="Background Image">
                <img class="demo-chg-bg" src="{{ asset('img/bg-img/thumbs/bg-img-1.jpg') }}" alt="Background Image">
                <img class="demo-chg-bg" src="{{ asset('img/bg-img/thumbs/bg-img-2.jpg') }}" alt="Background Image">
                <img class="demo-chg-bg" src="{{ asset('img/bg-img/thumbs/bg-img-3.jpg') }}" alt="Background Image">
                <img class="demo-chg-bg" src="{{ asset('img/bg-img/thumbs/bg-img-4.jpg') }}" alt="Background Image">
                <img class="demo-chg-bg" src="{{ asset('img/bg-img/thumbs/bg-img-5.jpg') }}" alt="Background Image">
                <img class="demo-chg-bg" src="{{ asset('img/bg-img/thumbs/bg-img-6.jpg') }}" alt="Background Image">
                <img class="demo-chg-bg" src="{{ asset('img/bg-img/thumbs/bg-img-7.jpg') }}" alt="Background Image">
            </div>
        </div>

    </div>

    <!--JAVASCRIPT-->
    <!--jQuery [ REQUIRED ]-->
    <script src="{{ asset('js/jquery.min.js') }}"></script>

    <!--BootstrapJS [ RECOMMENDED ]-->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    <!--NiftyJS [ RECOMMENDED ]-->
    <script src="{{ asset('js/nifty.min.js') }}"></script>

    <!--Background Image [ DEMONSTRATION ]-->
    <script src="{{ asset('js/demo/bg-images.js') }}"></script>
</body>
</html>
