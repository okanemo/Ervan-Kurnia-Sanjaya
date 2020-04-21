
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Register - Okanemo</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('css/sweetalert.min.css') }}" rel="stylesheet">
    <link href="{{ url('css/login.css') }}" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <form class="form-signin">
      <h1 class="h3 mb-3 font-weight-normal">Okanemo Test</h1>
      <p>Register Your Account</p>
      
      <label for="inputEmail" class="sr-only">Name</label>
      <input type="email" id="inputName" class="form-control" placeholder="Name" required autofocus>

      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required>

      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>

      <label for="inputPasswordConfirmation" class="sr-only">Password Confirmation</label>
      <input type="password" id="inputPasswordConfirmation" class="form-control mb-3" placeholder="Password Confirmation" required>

      <button class="btn btn-lg btn-warning btn-block" id="registerButton" type="button">Register</button>

      <a class="btn btn-lg btn-primary btn-block" href="/">Login</a>
      <p class="mt-5 mb-3 text-muted">&copy; 2020</p>
    </form>
  </body>

  <script type="text/javascript" src="{{ url('js/jquery.min.js') }}"></script>
  <script type="text/javascript" src="{{ url('js/sweetalert.min.js') }}"></script>
  <script type="text/javascript" src="{{ url('js/login.js') }}"></script>
</html>
