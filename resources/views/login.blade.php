
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Login - Okanemo</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('css/sweetalert.min.css') }}" rel="stylesheet">
    <link href="{{ url('css/login.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <form class="form-signin">
      <img class="mb-4" src="/docs/4.4/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Okanemo Test</h1>
      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus value="superadmin@okanemo.com">
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" class="form-control" placeholder="Password" required value="okanemo">
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me" id="inputRememberMe"> Remember me
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" id="logInButton" type="button">Login</button>

      <a class="btn btn-lg btn-warning btn-block" href="/register">
        Register
      </a>
      <p class="mt-5 mb-3 text-muted">&copy; 2020</p>
    </form>
  </body>

  <script type="text/javascript" src="{{ url('js/jquery.min.js') }}"></script>
  <script type="text/javascript" src="{{ url('js/sweetalert.min.js') }}"></script>
  <script type="text/javascript" src="{{ url('js/login.js') }}"></script>
</html>
