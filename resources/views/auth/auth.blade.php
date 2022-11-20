<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="{{url('assets/adminlte/plugins/fontawesome-free/css/all.min.css')}}">

    <link rel="stylesheet" href="{{url('assets/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{url('assets/adminlte/dist/css/adminlte.min.css?v=3.2.0') }}">
</head>

<body class="hold-transition login-page">
    <div class="login-box">

        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="" class="h1"><b>Hotel</b>App</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <form action="" method="post">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>

                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>

                    </div>
                </form>
                <div class="social-auth-links text-center mt-2 mb-3">
                    <a href="{{ route('google') }}" class="btn btn-block btn-primary">
                        <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                    </a>
                    <!-- <a href="{{ route('google') }}" onclick="return googlebtn();"  class="btn btn-block btn-danger"> -->
                    <a  onclick="return googlebtn();"  class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                    </a>
                </div>

                <p class="mb-1">
                    <a href="forgot-password.html">I forgot my password</a>
                </p>
                <p class="mb-0">
                    <a href="register.html" class="text-center">Register a new membership</a>
                </p>
            </div>

        </div>

    </div>


    <script src="{{  url('plugins/jquery/jquery.min.js') }}"></script>

    <script src="{{  url('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{  url('dist/js/adminlte.min.js?v=3.2.0') }}"></script>

    <script>
        function googlebtn()
        {
            window.location.href = "{{ route('google') }}"
        }
    </script>

</body>

</html>