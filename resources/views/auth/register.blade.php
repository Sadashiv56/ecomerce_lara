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
      <header>Signup</header>
      <form action="{{ route('register') }}" method="POST" id="signupForm">
        @csrf
        <div class="form-group">
          <input type="text" class="form-control" name="first_name" placeholder="First name" required>
        </div>
        <div class="form-group">
          <input type="text" class="form-control" name="last_name" placeholder="Last name" required>
        </div>
        <div class="form-group">
          <input type="email" class="form-control" name="email" placeholder="Email" required>
        </div>
        <div class="form-group">
          <input type="password" class="form-control" name="password" placeholder="Password" required>
        </div>
        <div class="form-group">
          <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
        </div>
        <a href="{{ route('password.request') }}">Forgot password?</a>
        <input type="submit" class="button" value="Signup">
      </form>
      <div class="signup">
        <span class="signup">Already have an account?
          <a href="{{ route('login') }}" class="signup-link">Login</a>
        </span>
      </div>
    </div>
  </div>

  <!-- jQuery and jQuery Validation plugin -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
  <script>
    $(document).ready(function() {
      $("#signupForm").validate({
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
          password_confirmation: {
            required: true,
            equalTo: "[name='password']"
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
            email: "Please enter a email address"
          },
          password: {
            required: "Please provide a password",
            minlength: "Your password must be at least 6 characters long"
          },
          password_confirmation: {
            required: "Please confirm your password",
            equalTo: "Passwords do not match"
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
