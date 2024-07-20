<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel 10 multi authentication by WebJourney</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<style>
  @import url('https://fonts.googleapis.com/css?family=Abel|Abril+Fatface|Alegreya|Arima+Madurai|Dancing+Script|Dosis|Merriweather|Oleo+Script|Overlock|PT+Serif|Pacifico|Playball|Playfair+Display|Share|Unica+One|Vibur');
  * {
      padding: 0;
      margin: 0;
      box-sizing: border-box;
  }
  body {
      background-image: linear-gradient(-225deg, #E3FDF5 0%, #FFE6FA 100%);
  background-image: linear-gradient(to top, #a8edea 0%, #fed6e3 100%);
  background-attachment: fixed;
    background-repeat: no-repeat;

      font-family: 'Vibur', cursive;
      font-family: 'Abel', sans-serif;
  opacity: .95;

  }
  form {
      width: 450px;
      min-height: 500px;
      height: auto;
      border-radius: 5px;
      margin: 2% auto;
      box-shadow: 0 9px 50px hsla(20, 67%, 75%, 0.31);
      padding: 2%;
      background-image: linear-gradient(-225deg, #E3FDF5 50%, #FFE6FA 50%);
  }
  form .con {
      display: -webkit-flex;
      display: flex;
    
      -webkit-justify-content: space-around;
      justify-content: space-around;
    
      -webkit-flex-wrap: wrap;
      flex-wrap: wrap;
    
        margin: 0 auto;
  }
  header {
      margin: 2% auto 10% auto;
      text-align: center;
  }
  header h2 {
      font-size: 250%;
      font-family: 'Playfair Display', serif;
      color: #3e403f;
  }
  header p {letter-spacing: 0.05em;}
  .input-item {
      background: #fff;
      color: #333;
      padding: 14.5px 0px 15px 9px;
      border-radius: 5px 0px 0px 5px;
  }
  #eye {
      background: #fff;
      color: #333;
    
      margin: 5.9px 0 0 0;
      margin-left: -20px;
      padding: 15px 9px 19px 0px;
      border-radius: 0px 5px 5px 0px;
    
      float: right;
      position: relative;
      right: 1%;
      top: -.2%;
      z-index: 5;
      
      cursor: pointer;
  }
  input[class="form-input"]{
      width: 240px;
      height: 50px;
    
      margin-top: 2%;
      padding: 15px;
      
      font-size: 16px;
      font-family: 'Abel', sans-serif;
      color: #5E6472;
    
      outline: none;
      border: none;
    
      border-radius: 0px 5px 5px 0px;
      transition: 0.2s linear;
      
  }
  input[id="txt-input"] {width: 250px;}
  input:focus {
      transform: translateX(-2px);
      border-radius: 5px;
  }
  button {
      display: inline-block;
      color: #252537;
    
      width: 280px;
      height: 50px;
    
      padding: 0 20px;
      background: #fff;
      border-radius: 5px;
      
      outline: none;
      border: none;
    
      cursor: pointer;
      text-align: center;
      transition: all 0.2s linear;
      
      margin: 7% auto;
      letter-spacing: 0.05em;
  }
  .submits {
      width: 48%;
      display: inline-block;
      float: left;
      margin-left: 2%;
  }
  .frgt-pass {background: transparent;}
  .sign-up {background: #B8F2E6;}

  button:hover {
      transform: translatey(3px);
      box-shadow: none;
  }
  button:hover {
      animation: ani9 0.4s ease-in-out infinite alternate;
  }
  @keyframes ani9 {
      0% {
          transform: translateY(3px);
      }
      100% {
          transform: translateY(5px);
      }
  }
  .login-form .m-input {
      width: 300px !important; 
  }
</style>
</head>
<body>

   <div class="overlay">
     @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(Session::has('error-message'))
                    <p class="alert alert-info">{{ Session::get('error-message') }}</p>
                @endif
<!-- LOGN IN FORM by Omar Dsoky -->
  <form action="{{ route('login.functionality') }}" method="post" class="login-form">
                    @csrf
   <!--   con = Container  for items in the form-->
   <div class="con">
   <!--     Start  header Content  -->
   <header class="head-form">
      <h2 class="py-5">Admin Login Form</h2>
      <!--     A welcome message or an explanation of the login form -->
   </header>
   <!--     End  header Content  -->
   <br>
   <div class="field-set">
     
      <!--   user name -->
         
        <!--   user name Input-->
         <input type="email" class="form-control m-input" name="email" placeholder="Enter Email">
     
      <br>
     
           <!--   Password -->
     
      
      <!--   Password Input-->
      <input type="password" class="form-control m-input" name="password" placeholder="Enter Password">
     
<!--      Show/hide password  -->
    
     
     
      <br>
<!--        buttons -->
<!--      button LogIn -->
   </div>
  
<!--   other buttons -->
   <div class="other">
<!--      Forgot Password button-->
      <button type="submit" class="btn submits sign-up">Admin Login
      <button class="btn submits frgt-pass" href="{{ route('password.request') }}">Forgot Password</button>
<!--     Sign Up button -->
<!--         Sign Up font icon -->
      
      </button>
<!--      End Other the Division -->
   </div>
     
<!--   End Conrainer  -->
  </div>
  
  <!-- End Form -->
</form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
function show() {
    var p = document.getElementById('pwd');
    p.setAttribute('type', 'text');
}

function hide() {
    var p = document.getElementById('pwd');
    p.setAttribute('type', 'password');
}

var pwShown = 0;

document.getElementById("eye").addEventListener("click", function () {
    if (pwShown == 0) {
        pwShown = 1;
        show();
    } else {
        pwShown = 0;
        hide();
    }
}, false);


</script>
</body>
</html>