<?php

include 'config.php';

if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    if (isset($_POST['gender'])) {$gender = $_POST['gender'];}
    if (isset($_POST['games'])) {$games = $_POST['games'];
        $game = implode(", ", $games);}
    $country = $_POST['country'];
    $password = md5($_POST['password']);
    $cpassword = md5($_POST['cpassword']);

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

    if (count($error) == 0) {
        $email_check = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
        $email_count = mysqli_num_rows($email_check);

        if ($email_count == 0) {
            $username_check = mysqli_query($conn, "SELECT * FROM users WHERE username = '{$username}'");
            $username_count = mysqli_num_rows($username_check);
            if ($username_count == 0) {
                if (strlen($username) > 6) {
                    if (strlen($password) > 8) {
                        if ($password == $cpassword) {
                            $sql = "INSERT INTO users (fname, username, email, address, gender, games, country, password) VALUES ('{$fname}', '{$username}', '{$email}', '{$address}', '{$gender}', '{$game}', '{$country}', '{$password}')";
                            $result = mysqli_query($conn, $sql) or die("Query Failed");
                            if ($result) {
                                header("Location: login.php");
                            } else {
                                $register_msg = "<div class='alert alert-danger'>Registration Failed</div>";
                            }
                        } else {
                            $error['cpassword'] = "<p style='color:red;'>Password does not match</p>";
                        }
                    } else {
                        $error['password'] = "<p style='color:red;'>Password is too short</p>";
                    }
                } else {
                    $error['username'] = "<p style='color:red;'>Username is too short</p>";
                }
            } else {
                $username_match = "<p style='color:red;'>Username already exists</p>";
            }
        } else {
            $email_match = "<p style='color:red;'>Email already exists</p>";
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
  <title>Register Login | PHP</title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <div class="container mt-10">
    <div class="row">
      <div class="col-xxl-5 mx-auto">
      <h2 class="p-3 mb-3 bg-primary text-white text-center">Registration Form</h2>
      <?php if (isset($register_msg)) {echo $register_msg;}?>
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
          </span>
                    <span>
            <?php if (isset($username_match)) {
    echo $username_match;
}?>
          </span>
        </div>
        <div class="mb-3">
          <label>Email</label>
          <input type="email" name="email" class="form-control" value="<?php if (isset($email)) {echo $email;}?>">
          <span>
            <?php if (isset($error['email'])) {
    echo $error['email'];
}?>
          </span>
          <span>
            <?php if (isset($email_match)) {
    echo $email_match;
}?>
          </span>
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
          </span>
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
          </span>
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
          </span>
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
          </span>
        </div>
        <div class="mb-3">
          <label>Confirm Password</label>
          <input type="password" name="cpassword" class="form-control" value="<?php if (isset($cpassword)) {echo $cpassword;}?>">
          <span>
            <?php if (isset($error['cpassword'])) {
    echo $error['cpassword'];
}?>
          </span>
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