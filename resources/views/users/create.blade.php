@extends('layouts.app')
@section('content')
<div class="row comman_table edit_us">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Create New User</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
        </div>
    </div>
</div>
@if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif
<div class="container">
    <form method="POST" action="{{ route('users.store') }}" id="userform" autocomplete="off">
        @csrf
        <div class="row edit_table_fm">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" name="first_name" id="first_name" placeholder="First Name" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" name="last_name" id="last_name" placeholder="Last Name" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" name="email" id="email" placeholder="Email" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" placeholder="Password" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="confirm-password">Confirm Password:</label>
                    <input type="password" name="confirm-password" id="confirm-password" placeholder="Confirm Password" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="mobile">Phone:</label>
                    <input type="text" name="mobile" id="mobile" placeholder="Phone Number" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>
@endsection

@section('customejs')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script>
    $(document).ready(function() {
        $("#userform").validate({
            rules: {
                first_name: {
                    required: true,
                    minlength: 2
                },
                last_name: {
                    required: true,
                    minlength: 2
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 6
                },
                'confirm-password': {
                    required: true,
                    equalTo: "#password"
                },
                mobile: {
                    required: true,
                    digits: true,
                    minlength: 10,
                    maxlength: 15
                }
            },
            messages: {
                first_name: {
                    required: "Please enter your first name",
                    minlength: "Your first name must consist of at least 2 characters"
                },
                last_name: {
                    required: "Please enter your last name",
                    minlength: "Your last name must consist of at least 2 characters"
                },
                email: {
                    required: "Please enter your email",
                    email: "Please enter a valid email address"
                },
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 6 characters long"
                },
                'confirm-password': {
                    required: "Please confirm your password",
                    equalTo: "Passwords do not match"
                },
                mobile: {
                    required: "Please enter your phone number",
                    digits: "Please enter a valid phone number",
                    minlength: "Phone number must be at least 10 digits",
                    maxlength: "Phone number must not exceed 15 digits"
                }
            },
        });
    });
</script>
@endsection


