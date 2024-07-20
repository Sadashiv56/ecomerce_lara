@extends('layouts.app')

@section('content')
<div class="row comman_table edit_us">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit New User</h2>
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

<div class="comman_table">
    <form  action="{{ route('users.update', $user->id) }}" method="POST" id="edit-user">
        @csrf
        @method('PATCH')
        <div class="row edit_table_fm">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>First Name:</strong>
                    <input type="text" name="first_name" placeholder="First Name" class="form-control" value="{{ $user->first_name }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Last Name:</strong>
                    <input type="text" name="last_name" placeholder="Last Name" class="form-control" value="{{ $user->last_name }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email:</strong>
                    <input type="email" name="email" placeholder="Email" class="form-control" value="{{ $user->email }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Phone Number:</strong>
                    <input type="text" name="mobile" placeholder="Phone Number" class="form-control" value="{{ $user->mobile }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Password:</strong>
                    <input type="password" name="password" placeholder="Password" class="form-control" value="{{ $user->password }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Confirm Password:</strong>
                    <input type="password" name="confirm-password" placeholder="Confirm Password" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>

<p class="text-center text-primary"><small></small></p>
@endsection

@section('customjs')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script>
    console.log('sss')
    $(document).ready(function() {
        
        console.log('dd');
        $('#edit-user').validate({
            rules: {
                first_name: {
                    required: true,
                    minlength: 3
                },
                last_name: {
                    required: true,
                    minlength: 3
                },
                email: {
                    required: true,
                    email: true
                },
                mobile: {
                    required: true,
                    digits: true,
                    minlength: 10
                },
                password: {
                    minlength: 6
                },
                'confirm-password': {
                    equalTo: '[name="password"]'
                }
            },
            messages: {
                first_name: {
                    required: "Please enter your first name",
                    minlength: "First name must be at least 3 characters"
                },
                last_name: {
                    required: "Please enter your last name",
                    minlength: "Last name must be at least 3 characters"
                },
                email: {
                    required: "Please enter your email address",
                    email: "Please enter a valid email address"
                },
                mobile: {
                    required: "Please enter your mobile number",
                    digits: "Please enter a valid mobile number",
                    minlength: "Mobile number must be at least 10 digits"
                },
                password: {
                    minlength: "Password must be at least 6 characters"
                },
                'confirm-password': {
                    equalTo: "Passwords do not match"
                }
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
@endsection
