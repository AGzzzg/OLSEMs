<?php

include('config/session.php');
include('config/db_connect.php');

$errors = array('course_name' => '', 'course_code' => '', 'lecturer_name' => '', 'school_name' => '', 'file' => '');
$course_name = $course_code = $lecturer_name = $school_name = '';
$user_id = '999';
$create = '';

if (isset($_POST['create'])) {

    // check course name
    if (empty($_POST['course_name'])) {
        $errors['course_name'] = 'Course name is required <br/>';
    } else {
        $course_name = $_POST['course_name'];
    }

    // check course location
    if (empty($_POST['course_code'])) {
        $errors['course_code'] = 'Course code is required <br/>';
    } else {
        $course_code = $_POST['course_code'];
    }

    // check map url
    if (empty($_POST['lecturer_name'])) {
        $errors['lecturer_name'] = 'Lecturer name is required <br/>';
    } else {
        $lecturer_name = $_POST['lecturer_name'];
    }

    // check embed url
    if (empty($_POST['school_name'])) {
        $errors['school_name'] = 'School name is required <br/>';
    } else {
        $school_name = $_POST['school_name'];
    }

    // check file
    if (empty($_FILES['file'])) {
        $errors['file'] = 'Image file is required <br/>';
    }

    $user_id = $_POST['userid'];

    if (!array_filter($errors)) {

        $file = $_FILES['file'];
        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png', 'webp');

        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {

                // insert query
                $course_name = mysqli_real_escape_string($conn, $_POST['course_name']);
                $course_code = mysqli_real_escape_string($conn, $_POST['course_code']);
                $lecturer_name = mysqli_real_escape_string($conn, $_POST['lecturer_name']);
                $school_name = mysqli_real_escape_string($conn, $_POST['school_name']);
                $image_ext = mysqli_real_escape_string($conn, $fileActualExt);
                $user_id = mysqli_real_escape_string($conn, $_SESSION['user_id']);

                // create sql
                $sql = "INSERT INTO course(course_name, course_code, lecturer_name, school_name, image_ext, user_id) VALUES('$course_name', '$course_code', '$lecturer_name', '$school_name', '$image_ext', '$user_id')";

                // save to db and check
                if (mysqli_query($conn, $sql)) {
                    // success
                    $create = 'Process succesful!';
                } else {
                    // error
                    $create = 'Process failed!';
                    echo 'query error: ' . mysqli_error($conn);
                }

                // query to get new course id
                $sql = "SELECT id, course_name FROM  course WHERE course_name='$course_name'";
                $result = mysqli_query($conn, $sql);
                $course = mysqli_fetch_assoc($result);
                mysqli_free_result($result);

                $id = $course['id'];

                $fileNameNew = "course" . $id . "." . $fileActualExt;
                $fileDestination = 'img/uploads/' . $fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);

                // save to db and check
                if (mysqli_query($conn, $sql)) {
                    // success
                    $create = 'Process succesful!';
                    mysqli_close($conn);
                    //header("Location: rivers.php");
                } else {
                    // error
                    $create = 'Process failed!';
                    echo 'query error: ' . mysqli_error($conn);
                }
            } else {
                $error['file'] = 'File upload failed!';
            }
        } else {
            $errors['file'] = 'File is not in correct format!';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>About - Mentor Bootstrap Template</title>
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
          <li class="active"><a href="about.php">About</a></li>
          <li><a href="calendar.php">Calendar</a></li>
          <li><a href="courses.php">Courses</a></li>
          <li><a href="template.php">File Manager</a></li>

        </ul>
      </nav><!-- .nav-menu -->

      <a href="login.php" class="get-started-btn">Log In</a>

    </div>
  </header><!-- End Header -->

  <main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" data-aos="fade-in">
      <div class="container">
        <h2>About Us</h2>
        <p>Est dolorum ut non facere possimus quibusdam eligendi voluptatem. Quia id aut similique quia voluptas sit quaerat debitis. Rerum omnis ipsam aperiam consequatur laboriosam nemo harum praesentium. </p>
      </div>
    </div><!-- End Breadcrumbs -->

    <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <input class="form-control" type="text" name="course_name" placeholder="eg: Application Development" value="<?php echo $course_name ?>">
                        <div class="text-danger"><?php echo $errors['course_name'] ?></div>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="course_code" placeholder="eg: SCSJ2222" value="<?php echo $course_code ?>">
                        <div class="text-danger"><?php echo $errors['course_code'] ?></div>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="lecturer_name" placeholder="lecturer name" value="<?php echo $lecturer_name ?>">
                        <div class="text-danger"><?php echo $errors['lecturer_name'] ?></div>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="school_name" placeholder="eg: School of Computing" value="<?php echo $school_name ?>">
                        <div class="text-danger"><?php echo $errors['school_name'] ?></div>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="file" name="file" placeholder="Image">
                        <div class="text-danger"><?php echo $errors['file'] ?></div>
                    </div>
                    <div class="text-center">
                        <input type="submit" name="create" value="Create" class="btn btn-danger">
                        <div class="text-danger"><?php echo $create; ?></div>
                    </div>
                </form>
            </div>
            <div class="col-lg-3"></div>
        </div>    

  </main>


  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>Mentor</h3>
            <p>
              A108 Adam Street <br>
              New York, NY 535022<br>
              United States <br><br>
              <strong>Phone:</strong> +1 5589 55488 55<br>
              <strong>Email:</strong> info@example.com<br>
            </p>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Join Our Newsletter</h4>
            <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>
          </div>

        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">

      <div class="mr-md-auto text-center text-md-left">
        <div class="copyright">
          &copy; Copyright <strong><span>Mentor</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
          <!-- All the links in the footer should remain intact. -->
          <!-- You can delete the links only if you purchased the pro version. -->
          <!-- Licensing information: https://bootstrapmade.com/license/ -->
          <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/mentor-free-education-bootstrap-theme/ -->
          Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
        <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
        <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
        <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="bx bx-up-arrow-alt"></i></a>
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/vendor/counterup/counterup.min.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
