<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login & Registration Form</title>
    <link rel="stylesheet" href="style.css">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <input type="checkbox" id="check">
        <div class="login form">
            <header>Login</header>
            <form action="{{ route('login') }}" method="POST" id="login">
                @csrf
                <div class="form-group">
                    <input type="email" value="{{ old('email') }}" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                    @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                    @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <a href="{{ route('password.request') }}">Forgot password?</a>
                <input type="submit" class="button" value="Login">
            </form>
            <div class="signup">
                <span class="signup">Don't have an account?
                    <a href="{{ route('register') }}" class="signup-link">Signup</a></br>
                    <a href="{{ route('auth.google') }}" class="google btn">
                        <img src="{{ asset('images/google.jpg') }}" alt="Google Login" style="width: 20px; height: 20px; margin-right: 8px;">
                        Login with Google
                    </a></br>
                    <a class="ml-1 btn btn-primary" href="{{ url('auth/facebook') }}" style="width: 30px; height: 40px; margin-right: 8px;" id="btn-fblogin">
                        <img src="{{ asset('images/facebookimg.jpg') }}" alt="Facebook Login" style="width: 20px; height: 20px; margin-right: 8px;">
                        Login with Facebook
                    </a>
                </span>
            </div>
        </div>
    </div>
    <!-- jQuery and jQuery Validation plugin -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
    <script>
        $(document).ready(function() {
            $("#login").validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 6
                    }
                },
                messages: {
                    email: {
                        required: "Please enter your email",
                        email: "Please enter a valid email address"
                    },
                    password: {
                        required: "Please enter your password",
                        minlength: "Your password must be at least 6 characters long"
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
</body>
</html>
