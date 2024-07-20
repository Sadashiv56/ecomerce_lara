@extends('front.layouts.app')
@section('content')
<main>
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="#">Home</a></li>
                    <li class="breadcrumb-item">Register</li>

                </ol>
            </div>
        </div>
    </section>

    <section class=" section-10">
        <div class="container">
            <div class="login-form">
                <form action="{{ route('user.register') }}" method="post" name="registrationForm" id="registrationForm">
                    @csrf
                    <h4 class="modal-title">Register Now</h4>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="form-group">
                        <input type="text" class="form-control" value="{{ old('name') }}" placeholder="Name" id="name"
                            name="name">
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email" value="{{ old('email') }}"
                            id="email" name="email">
                        @error('email')
                        <div>{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Phone" value="{{ old('mobile') }}"
                            id="mobile" name="mobile">
                        @error('mobile')
                        <div>{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" id="password"
                            name="password">
                        @error('password')
                        <div>{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Confirm Password"
                            id="password_confirmation" name="password_confirmation">
                    </div>
                    <div class="form-group small">
                        <a href="#" class="forgot-link">Forgot Password?</a>
                    </div>
                    <button type="submit" class="btn btn-dark btn-block btn-lg">Register</button>
                </form>
                <div class="text-center small">Already have an account? <a href="{{ route('user.login') }}">Login Now</a>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js">
</script>
<script>
    $(document).ready(function() {
            $("#registrationForm").validate({
                rules: {
                        name: {
                        required: true,
                    },

                    email: {
                        required: true,
                    },

                    mobile: {
                        required: true,
                    },
                    password: {
                        required: true,
                    },
                    password_confirmation:{
                        required: true,
                    }
                },
                messages: {
                    name: {
                        required: "Please enter  name",
                    },
                    email: {
                        required: "Please enter  email",
                    },
                    mobile: {
                        required: "Please enter mobile",
                    },
                    password: {
                        required: "Please enter password",
                    },
                     password_confirmation: {
                        required: "Please enter Confirm password",
                    },
                       
                },
            });
        });
</script>
@endsection