<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Forgot Password</title>

    <!--STYLESHEET-->
    <!--=================================================-->

    <!--Open Sans Font [ OPTIONAL ]-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>

    <!--Bootstrap Stylesheet [ REQUIRED ]-->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!--Nifty Stylesheet [ REQUIRED ]-->
    <link href="{{ asset('css/nifty.min.css') }}" rel="stylesheet">

    <!--Nifty Premium Icon [ DEMONSTRATION ]-->
    <link href="{{ asset('css/demo/nifty-demo-icons.min.css') }}" rel="stylesheet">

    <!--Pace - Page Load Progress Bar [OPTIONAL]-->
    <link href="{{ asset('plugins/pace/pace.min.css') }}" rel="stylesheet">
    <script src="{{ asset('plugins/pace/pace.min.js') }}"></script>

    <!--Demo [ DEMONSTRATION ]-->
    <link href="{{ asset('css/demo/nifty-demo.min.css') }}" rel="stylesheet">

</head>

<body>
    <div id="container" class="cls-container">

        <!-- BACKGROUND IMAGE -->
        <!--===================================================-->
        <div id="bg-overlay"></div>

        <!-- PASSWORD RESETTING FORM -->
        <!--===================================================-->
        <div class="cls-content">
            <div class="cls-content-sm panel">
                <div class="panel-body">
                    <h1 class="h3">Forgot password</h1>
                    <p class="pad-btm">Enter your email address to recover your password.</p>
                    <form action="{{ route('password.email') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="Email" required>
                        </div>
                        <div class="form-group text-right">
                            <button class="btn btn-danger btn-lg btn-block" type="submit">Reset Password</button>
                        </div>
                    </form>
                    <div class="pad-top">
                        <a href="{{ route('login') }}" class="btn-link text-bold text-main">Back to Login</a>
                    </div>
                </div>
            </div>
        </div>
        <!--===================================================-->
    </div>

    <!--JAVASCRIPT-->
    <!--=================================================-->

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
