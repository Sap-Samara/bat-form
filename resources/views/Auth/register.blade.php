<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/nifty.min.css') }}" rel="stylesheet">
</head>
<body>
    <div id="container" class="cls-container">
        <!-- BACKGROUND IMAGE -->
        <div id="bg-overlay"></div>

        <!-- REGISTRATION FORM -->
        <div class="cls-content">
            <div class="cls-content-lg panel">
                <div class="panel-body">
                    <div class="mar-ver pad-btm">
                        <h1 class="h3">Create a New Account</h1>
                        <p>Come join our community! Let's set up your account.</p>
                    </div>

                    <!-- Registration Form -->
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Full name" name="name" value="{{ old('name') }}" required autofocus>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="E-mail" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Username" name="username" value="{{ old('username') }}" required>
                                    @error('username')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Password" name="password" required>
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" required>
                                </div>
                            </div>
                        </div>

                        <div class="checkbox pad-btm text-left">
                            <input id="terms" class="magic-checkbox" type="checkbox" name="terms" required>
                            <label for="terms">I agree with the <a href="#" class="btn-link text-bold">Terms and Conditions</a></label>
                        </div>

                        <button class="btn btn-primary btn-lg btn-block" type="submit">Register</button>
                    </form>
                </div>

                <div class="pad-all">
                    Already have an account? <a href="{{ route('login') }}" class="btn-link mar-rgt text-bold">Sign In</a>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/nifty.min.js') }}"></script>
</body>
</html>
