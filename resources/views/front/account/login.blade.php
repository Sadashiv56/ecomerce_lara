@extends('front.layouts.app')
@section('content')
<main>
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="#">Home</a></li>
                    <li class="breadcrumb-item">Login</li>
                </ol>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </div>
    </section>

    <section class="section-10">
        <div class="container">
            <div class="login-form">
                <form id="loginForm" action="{{ route('user.login') }}" method="post">
                    @csrf
                    <h4 class="modal-title">Login to Your Account</h4>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                            placeholder="Email">
                        @error('email')
                        <div>{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        @error('password')
                        <div>{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group small">
                        <a href="#" class="forgot-link">Forgot Password?</a>
                    </div>
                    <input type="submit" class="btn btn-dark btn-block btn-lg" value="Login">
                </form>
                <div class="text-center small">
                    Don't have an account? <a href="{{ route('user.register') }}">Sign up</a>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script>
    $(document).ready(function() {
        $("#loginForm").validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 8
                }
            },
            messages: {
                email: {
                    required: "Please enter your email address",
                    email: "Please enter a valid email address"
                },
                password: {
                    required: "Please enter your password",
                    minlength: "Your password must be at least 8 characters long"
                }
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
</script>
@endsection
