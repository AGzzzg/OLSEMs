<?php
session_start();
include("../includes/inc.php");
$errors = array();
$message = "";
$userName = "";$firstName="";$lastName="";$userEmail="";
$userEmail = "";

if (isset($_POST['register'])) { //check if form was submitted

    $dbConnection = new dbQuery($config['dbHost'], $config['dbUserName'], $config['dbPassword'], $config['dbName']);
    if ($dbConnection) {
        //die('connected');
    }
    $firstName = isset($_POST['first_name']) ? $dbConnection->saveSQLInjection($_POST['first_name']) : "";
    $lastName = isset($_POST['last_name']) ? $dbConnection->saveSQLInjection($_POST['last_name']) : "";
    $userEmail = isset($_POST['user_email']) ? $dbConnection->saveSQLInjection($_POST['user_email']) : "";
    $userPassword = isset($_POST['user_password']) ? $dbConnection->saveSQLInjection($_POST['user_password']) : "";
    $userPasswordR = isset($_POST['user_password_r']) ? $dbConnection->saveSQLInjection($_POST['user_password_r']) : "";

    if ($userPassword != $userPasswordR) {
        array_push($errors, "The two passwords do not match");
    }

    if ($dbConnection->existsAlready('email', 'users', "email ='$userEmail'")) {
        array_push($errors, "Email exists already");
    }
	

    if (count($errors) == 0) {
        $userPassword = password_hash($userPassword, PASSWORD_DEFAULT);
        $hash = md5(rand(0, 1000));
        $userData =     array('first_name' => $firstName, 'last_name' => $lastName, 'email' => $userEmail, 'password' => $userPassword);
        $userId = $dbConnection->saveData($userData, 'users');
            //usertype
    $conn =  mysqli_connect('sql10.freemysqlhosting.net', 'sql10393918', 'KlnmzegqUF', 'sql10393918');
    $usertype = mysqli_real_escape_string($conn, $_POST['usertype']);
	$sql = "UPDATE users SET usertype='$usertype' WHERE email='$userEmail'";
    mysqli_query($conn, $sql);
    // end usertype
		
		if ($userId) {
            $message = "Registered Successfully.";
        }
    }
}

include("../includes/head.php");
include("../includes/nav.php") 
		?> 

		<title>Register</title>
  
</head>

<body >
    <div class="container">
        <main>
            <div class="ath-container">
                <div class="text-center">
                    <h1>REGISTER</h1>
                </div>
                <div class="ath-body">
                    <h5 class="text-center">Create New
                            Account</small></h5>
                    <form action="" method="post">
                        <?php if (count($errors) > 0) { ?>
                            <div class="alert alert-danger alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
                                <?php foreach ($errors as $error) { ?>
                                    <li>
                                        <?php echo $error; ?>
                                    </li>
                                <?php } ?>
                            </div>
                        <?php }
                        if (!empty($message)) { ?>
                            <div class="alert alert-success alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
                                <?php echo $message ?>
                            </div>
                        <?php } ?>

                        <div class="form-group">
						<div class="row">
						<label class="col-md-3">First Name</label>
                            <div class="col-md-9">
                                <input type="text" name="first_name" class="form-control" value="<?php htmlspecialchars($firstName) ?>"  placeholder="Your First Name" required>
                            </div>
							</div>
                        </div>
						
						<div class="form-group">
						<div class="row">
						<label class="col-md-3">Last Name</label>
                            <div class="col-md-9">
                                <input type="text" name="last_name" class="form-control" value="<?php htmlspecialchars($lastName) ?>"  placeholder="Your Last Name" required>
                            </div>
							</div>
                        </div>
						
						<div class="form-group">
						<div class="row">
						<label class="col-md-3">Email</label>
                            <div class="col-md-9">
                                <input type="email" name="user_email" class="form-control" value="<?php htmlspecialchars($userEmail) ?>"  placeholder="User Email" required>
                            </div>
							</div>
                        </div>
                        
                        <div class="form-group">
						<div class="row">
						<label class="col-md-3">Password</label>
                            <div class="col-md-9">
                                <input type="password" name="user_password" required class="form-control" placeholder="Password">
                            </div>
							</div>
                        </div>
						<div class="form-group">
						<div class="row">
						<label class="col-md-3">Password</label>
                            <div class="col-md-9">
                                <input type="password" name="user_password_r" required class="form-control" placeholder="Re-type Password">
                            </div>
							</div>
                        </div>
                        <div class="form-group" style="text-align: center">
                            <p>
                            <input type="radio" id="Student" name="usertype" value="0">
                                <label for="0">Student</label>
                            <input type="radio" id="Lecturer" name="usertype" value="1">
                                <label for="1">Lecturer</label><br>
                            </p>
                        </div>
                              

					<div class="text-center">                       
                        <button class="btn btn-primary " type="submit" name="register">Sign Up</button>
                    </div>
					</form>
                    
                </div>
                <div class="ath-note text-center tc-light"> Already have an account? <a href="login.php">
                        <strong>Sign in here</strong></a>
                </div>
            </div>
        </main>
    </div>
    <div class="preloader"><span class="spinner spinner-round"></span></div>
    <!-- JavaScript -->
    <script src="../assets/js/jquery.bundle.js?ver=190"></script>
    <script src="../assets/js/scripts.js?ver=190"></script>

</body>

</html>
