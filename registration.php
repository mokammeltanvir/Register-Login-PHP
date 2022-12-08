<?php
if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    if (isset($_POST['gender'])) {$gender = $_POST['gender'];}
    if (isset($_POST['games'])) {$games = $_POST['games'];}
    $country = $_POST['country'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    $error = [];
    if (empty($fname)) {
        $error['fname'] = "<p style='color:red;'>Full Name is required</p>";
    }
    if (empty($username)) {
        $error['username'] = "<p style='color:red;'>Username is required</p>";
    }
    if (empty($email)) {
        $error['email'] = "<p style='color:red;'>Email is required</p>";
    }
    if (empty($address)) {
        $error['address'] = "<p style='color:red;'>Address is required</p>";
    }
    if (empty($gender)) {
        $gender = "<p style='color:red;'>Select your Gender</p>";
    }
    if (empty($games)) {
        $games = "<p style='color:red;'>Select your Games</p>";
    }
    if (empty($country)) {
        $error['country'] = "<p style='color:red;'>Select your Country</p>";
    }
    if (empty($password)) {
        $error['password'] = "<p style='color:red;'>Password is required</p>";
    }
    if (empty($cpassword)) {
        $error['cpassword'] = "<p style='color:red;'>Confirm Password is required</p>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register Login | PHP</title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <div class="container mt-10">
    <div class="row">
      <div class="col-xxl-5 mx-auto">
      <h2 class="p-3 mb-3 bg-primary text-white text-center">Registration Form</h2>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
        <div class="mb-3">
          <label>Full Name</label>
          <input type="text" name="fname" class="form-control" value="<?php if (isset($fname)) {echo $fname;}?>">
          <span>
            <?php if (isset($error['fname'])) {
    echo $error['fname'];
}?>
</span>
        </div>
        <div class="mb-3">
          <label>Username</label>
          <input type="text" name="username" class="form-control" value="<?php if (isset($username)) {echo $username;}?>">
          <span>
            <?php if (isset($error['username'])) {
    echo $error['username'];
}?>
        </div>
        <div class="mb-3">
          <label>Email</label>
          <input type="email" name="email" class="form-control" value="<?php if (isset($email)) {echo $email;}?>">
          <span>
            <?php if (isset($error['email'])) {
    echo $error['email'];
}?>
        </div>
        <div class="mb-3">
          <label>Address</label>
          <textarea name="address" class="form-control">
            <?php if (isset($address)) {echo $address;}?>
        </textarea>
          <span>
            <?php if (isset($error['address'])) {
    echo $error['address'];
}?>
        </div>
        <div class="mb-3">
          <label>Gender</label> <br/>
          <input type="radio" name="gender" value="Male"<?php if (isset($gender) && $gender == 'Male') {echo 'checked';}?> >Male
          <input type="radio" name="gender" value="Female" <?php if (isset($gender) && $gender == 'Female') {echo 'checked';}
?> >Female
          <input type="radio" name="gender" value="Other" <?php if (isset($gender) && $gender == 'Other') {echo 'checked';}
?>>Other
          <span>
            <?php if (isset($gender)) {
    echo $gender;
}?>
        </div>
        <div class="mb-3">
          <label>Favorite Games</label><br/>
          <input type="checkbox" name="games[]" value="Cricket" <?php if (isset($games)) {if (in_array('Cricket', $games)) {echo 'checked';}}
?>>  Cricket
          <input type="checkbox" name="games[]" value="Football" <?php if (isset($games)) {if (in_array('Football', $games)) {echo 'checked';}}
?>>  Football
          <input type="checkbox" name="games[]" value="Hockey" <?php if (isset($games)) {if (in_array('Hockey', $games)) {echo 'checked';}}
?>>  Hockey
          <input type="checkbox" name="games[]" value="Badminton" <?php if (isset($games)) {if (in_array('Badminton', $games)) {echo 'checked';}}
?>>  Badminton
          <input type="checkbox" name="games[]" value="Tennis" <?php if (isset($games)) {if (in_array('Tennis', $games)) {echo 'checked';}}
?>>  Tennis
          <span>
            <?php if (isset($games)) {
    echo $games;
}?>
        </div>
        <div class="mb-3">
          <label>Country</label>
          <select name="country" class="form-control">
            <option value="">Select Country</option>
            <option value="Bangladesh" <?php if (isset($country) && $country == 'Bangladesh') {echo 'selected';}
?> >Bangladesh</option>
            <option value="India" <?php if (isset($country) && $country == 'India') {echo 'selected';}
?> >India</option>
            <option value="USA" <?php if (isset($country) && $country == 'USA') {echo 'selected';}
?> >USA</option>
            <option value="UK" <?php if (isset($country) && $country == 'UK') {echo 'selected';}
?> >UK</option>
            <option value="Canada" <?php if (isset($country) && $country == 'Canada') {echo 'selected';}
?> >Canada</option>
          </select>
          <span>
            <?php if (isset($error['country'])) {
    echo $error['country'];
}?>
        </div>
        <div class="mb-3">
          <label>Password</label>
          <input type="password" name="password" class="form-control" value="<?php if (isset($password)) {echo $password;}?>">
          <span>
            <?php if (isset($error['password'])) {
    echo $error['password'];
}?>
        </div>
        <div class="mb-3">
          <label>Confirm Password</label>
          <input type="password" name="cpassword" class="form-control" value="<?php if (isset($cpassword)) {echo $cpassword;}?>">
          <span>
            <?php if (isset($error['cpassword'])) {
    echo $error['cpassword'];
}?>
        </div>
        <div class="mb-3">
          <input type="submit" name="submit" value="Register" class="btn btn-primary">
        </div>
      </form>
      </div>
    </div>
  </div>
</body>
</html>