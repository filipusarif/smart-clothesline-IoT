<?php
include './db.php';



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    if ($conn->query($query)) {
        header("Location: login.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex align-items-center justify-content-center vh-100">
    <div class="card p-4" style="width: 300px;">
        <h3 class="text-center">Register</h3>
        <form method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Register</button>
        </form>
        <p class="text-center mt-3">Already have an account? <a href="login.php">Login</a></p>
    </div>
</body>
</html> -->

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>smart clothesline</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../bootstrap/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../bootstrap/assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../bootstrap/assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../bootstrap/assets/images/favicon.ico" />
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
              <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
                
                <h4>New here?</h4>
                <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
                <form class="pt-3" method="POST">
                  <div class="form-group">
                    <input type="text" name="username" class="form-control form-control-lg" id="exampleInputUsername1" placeholder="Username">
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
                  </div>
                  <div class="mt-3">
                    <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">SIGN UP</button>
                  </div>
                  <div class="text-center mt-4 font-weight-light"> Already have an account? <a href="login.php" class="text-primary">Login</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../bootstrap/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../bootstrap/assets/js/off-canvas.js"></script>
    <script src="../bootstrap/assets/js/hoverable-collapse.js"></script>
    <script src="../bootstrap/assets/js/misc.js"></script>
    <!-- endinject -->
  </body>
</html>
