<?php

include('config/session.php');
include('config/db_connect.php');

if (!empty($_SESSION['name'])) {
    header('Location: index.php');
}

$login_username = $login_password = '';
$username = $fullname = $email = $password = $usertype = '';

$errors = array('login_username' => '', 'login_password' => '', 'username' => '', 'fullname' => '', 'email' => '', 'password' => '');
$login = $register = '';

if (isset($_POST['login'])) {
    unset($_POST['register']);

    // write query for all pizzas
    $sql = 'SELECT username, fullname, userpassword, id, usertype FROM  user';

    // make query & get result
    $result = mysqli_query($conn, $sql);

    // fetch the resulting rows as an array
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // free result from memory
    mysqli_free_result($result);

    // close connection
    mysqli_close($conn);

    foreach ($users as $user) {
        // validate user
        if ($_POST['login_username'] == $user['username'] && $_POST['login_password'] == $user['userpassword']) {
            session_start();
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['fullname'] = $user['fullname'];
            $_SESSION['usertype'] = $user['usertype'];
            header('Location: index.php');
        } else {
            $login_username = $_POST['login_username'];
            $login_password = $_POST['login_password'];
        }
    }
    $login = 'Login failed!';
}

if (isset($_POST['register'])) {
    unset($_POST['login']);

    // check username
    if (empty($_POST['username'])) {
        $errors['username'] = 'A username is required <br/>';
    } else {
        $username = $_POST['username'];
        if (strlen($username) < 4) {
            $errors['username'] = 'Username must be at least 4 characters <br/>';
        }
    }

    // check name
    if (empty($_POST['fullname'])) {
        $errors['fullname'] = 'A name is required <br/>';
    } else {
        $fullname = $_POST['fullname'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $fullname)) {
            $errors['fullname'] = 'Name must be letters and spaces only <br/>';
        }
    }

    // check email
    if (empty($_POST['email'])) {
        $errors['email'] = 'An email is required <br/>';
    } else {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email must be a valid email address <br/>';
        }
    }

    // check password
    if (empty($_POST['password'])) {
        $errors['password'] = 'A password is required <br/>';
    } else {
        $password = $_POST['password'];
        if (strlen($password) < 8) {
            $errors['password'] = 'Password must be at least 8 characters <br/>';
        }
    }

    if (empty($_POST['usertype'])) {
        $errors['usertype'] = 'Your role is required <br/>';
    }

    if (!array_filter($errors)) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $usertype = mysqli_real_escape_string($conn, $_POST['usertype']);

        // create sql
        $sql = "INSERT INTO user(username, fullname, email, userpassword, usertype) VALUES('$username', '$fullname', '$email', '$password', '$usertype')";

        // save to db and check
        if (mysqli_query($conn, $sql)) {
            // success
            $username = $fullname = $email = $password = '';
            $login = 'Registration succesful!';
        } else {
            // error
            $login = 'Registration failed!';
            echo 'query error: ' . mysqli_error($conn);
        }
    }
}

$name = 'Guest';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Courses - Mentor Bootstrap Template</title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Mentor - v2.1.0
  * Template URL: https://bootstrapmade.com/mentor-free-education-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo mr-auto"><a href="index.php">OLSEM</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo mr-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="about.php">About</a></li>
          <li><a href="contact.php">Contact</a></li>

        </ul>
      </nav><!-- .nav-menu -->

      <a href="login.php" class="get-started-btn">Log In</a>

    </div>
</header><!-- End Header -->


<section id="intro">
    <div class="intro-container wow fadeIn">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 border-right">
                    <h2 class="text-white">Login</h2>
                    <div class="container" style="padding: 40px 80px;">
                        <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                            <div style="height: 60px;"></div>
                            <div class="form-group">
                                <input class="form-control" type="text" name="login_username" placeholder="Username" value="<?php echo htmlspecialchars($login_username); ?>">
                                <div class="text-warning"><?php echo $errors['login_username']; ?></div>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="password" name="login_password" placeholder="Password">
                                <div class="text-warning"><?php echo $errors['login_password']; ?></div>
                            </div>
                            <input type="submit" name="login" value="Login" class="about-btn">
                            <div class="text-warning"><?php echo $login; ?></div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 border-left">
                    <h2 class="text-white">Register new user</h2>
                    <div class="container" style="padding: 40px 80px;">
                        <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                            <div class="form-group">
                                <input class="form-control" type="text" name="username" placeholder="Username" value="<?php echo htmlspecialchars($username); ?>">
                                <div class="text-warning"><?php echo $errors['username']; ?></div>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" name="fullname" placeholder="Name" value="<?php echo htmlspecialchars($fullname); ?>">
                                <div class="text-warning"><?php echo $errors['fullname']; ?></div>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" name="email" placeholder="E-mail" value="<?php echo htmlspecialchars($email); ?>">
                                <div class="text-warning"><?php echo $errors['email']; ?></div>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="password" name="password" placeholder="Password">
                                <div class="text-warning"><?php echo $errors['password']; ?></div>
                            </div>
                            <div class="form-group">
                            <input type="radio" id="Student" name="usertype" value="0">
                                <label for="0">Student</label><br>
                            <input type="radio" id="Lecturer" name="usertype" value="1">
                                <label for="1">Lecturer</label><br>
                            </div>
                            <input type="submit" name="register" value="Register" class="about-btn">
                            <div class="text-warning"><?php echo $register; ?></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



 </body>

 </html>
