<?php
session_start();
include 'config.php';

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $error = [];
    if (empty($email)) {
        $error['email'] = "<p style='color:red'>Email is required</p>";
    }
    if (empty($password)) {
        $error['password'] = "<p style='color:red'>Password is required</p>";
    }
    if (count($error) == 0) {
        $login_info = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
        if (mysqli_num_rows($login_info) > 0) {
            $row = mysqli_fetch_assoc($login_info);
            if ($row['password'] == md5($password)) {
                $_SESSION['email'] = $email;
                $_SESSION['fname'] = $row['fname'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['address'] = $row['address'];
                $_SESSION['gender'] = $row['gender'];
                $_SESSION['country'] = $row['country'];
                header("Location: index.php");
            } else {
                $error_pass = "<p style='color:red'>Password is incorrect</p>";
            }
        } else {
            $error_email = "<p style='color:red'>Email is incorrect</p>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | PHP</title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-xxl-5 mx-auto">
        <h2 class="p-3 mb-3 bg-primary text-white text-center">Login Form</h2>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST"
">
          <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="<?php if (isset($email)) {echo $email;}?>">
                      <span>
            <?php if (isset($error['email'])) {
    echo $error['email'];
}?>
          </span>
          <span>
            <?php if (isset($error_email)) {
    echo $error_email;
}?>
          </span>
          </div>
          <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" value="<?php if (isset($password)) {echo $password;}?>">
                      <span>
            <?php if (isset($error['password'])) {
    echo $error['password'];
}?>
          </span>
          <span>
            <?php if (isset($error_pass)) {
    echo $error_pass;
}?>
          </span>

          </div>
          <div class="mb-3">
            <input type="submit" name="login" class="btn btn-primary" value="Login">
          </div>
        </form>

  </div>
</div>
  </div>


</body>
</html>
