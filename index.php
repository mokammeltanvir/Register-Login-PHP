<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <div class="container mt-5">
    <div class="row">
      <div class="col-xxl-6 mx-auto">
        <table class="table table-border">
          <tr>
            <th>Full Name</th>
            <td><?php echo $_SESSION['fname'] ?></td>
          </tr>
          <tr>
            <th>Username</th>
            <td><?php echo $_SESSION['username'] ?></td>
          </tr>
          <tr>
            <th>Email</th>
            <td><?php echo $_SESSION['email'] ?></td>
          </tr>
          <tr>
            <th>Address</th>
            <td><?php echo $_SESSION['address'] ?></td>
          </tr>
          <tr>
            <th>Country</th>
            <td><?php echo $_SESSION['country'] ?></td>
          </tr>
          <tr>
            <th>Gender</th>
            <td><?php echo $_SESSION['gender']; ?></td>
          </tr>
          <tr>
            <td><a href="logout.php" class="btn btn-primary">Logout</a></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</body>
</html>