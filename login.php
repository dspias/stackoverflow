<?php include 'controller/UsersController.php'; ?>

<?php
    $user = new UsersController();

    $errors = array(); 

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

      $errors = $user->userLogin($_REQUEST);
    }
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="includes/bootstrap/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="includes/bootstrap/css/bootstrap-grid.min.css" type="text/css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">

    <link rel="stylesheet" href="includes/css/login.css" type="text/css">

    <title>login in stackoverflow</title>
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h4 class="card-title text-center">stackoverflow</h4>
            <h5 class="card-title text-center">Sign In</h5>
            <form class="form-signin" action="" method="POST">

            <?php include('templates/partials/errors.php'); ?>
            
              <div class="form-label-group">
                <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Email address" required autofocus>
                <label for="inputEmail">Email address</label>
              </div>

              <div class="form-label-group">
                <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
                <label for="inputPassword">Password</label>
              </div>

              <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox" class="custom-control-input" id="customCheck1">
                <label class="custom-control-label" for="customCheck1">Remember password</label>
              </div>
              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Sign in</button>
              <span class="text-center mt-2 small">Create an account : <a  href="register.php">Register</a></span>
              
              <hr class="my-4">
              <button class="btn btn-lg btn-google btn-block text-uppercase" type="submit"><i class="fab fa-google mr-2"></i> Sign in with Google</button>
              <button class="btn btn-lg btn-facebook btn-block text-uppercase" type="submit"><i class="fab fa-facebook-f mr-2"></i> Sign in with Facebook</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="includes/bootstrap/js/jquery.min.js"></script>
    <script src="includes/bootstrap/js/popper.min.js"></script>
    <script src="includes/bootstrap/js/bootstrap.min.js"></script>
    <script src="includes/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="includes/js/app.js"></script>
</body>

</html>