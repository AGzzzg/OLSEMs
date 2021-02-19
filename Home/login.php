<?php
session_start();
include("../includes/inc.php");
$errors = array();
$message = "";
$userName = "";

if(isset($_POST['submit'])){ //check if form was submitted
	$isAuthenticated = false;
    $dbConnection = new dbQuery($config['dbHost'],$config['dbUserName'],$config['dbPassword'],$config['dbName']);
    $userEmail = isset($_POST['user_email'])?$dbConnection->saveSQLInjection($_POST['user_email']):"";
	$userPassword = isset($_POST['password'])?$dbConnection->saveSQLInjection($_POST['password']):"";
	$getUser = $dbConnection->getData($table= 'users',$cols=array('id','first_name','last_name','email', 'usertype','password'),$where ="email='$userEmail'");
	// if user with the email exists

	if(!empty($getUser))
    {
    while ($row = mysqli_fetch_assoc($getUser)) 
    {
    $is_active = $row['is_active'];
	
		
	// if no error.
	if(count($errors) == 0)
	{ 
	  
		if(password_verify($userPassword,$row['password']) && $userEmail == $row['email']){
		$isAuthenticated = true;
	    $_SESSION['first_name'] = $row['first_name'];
		$_SESSION['last_name'] = $row['last_name'];
		$_SESSION['email'] = $row['email'];
		$_SESSION['login'] = true;
		$_SESSION['user_id'] = $row['id'];
		//usertype session
		$email = $_SESSION['email'];
		$conn =  mysqli_connect('localhost', 'root', '', 'olsem');
		$sql = "SELECT usertype FROM users WHERE email = '$email'";
		$result = mysqli_query($conn, $sql);
		$users = mysqli_fetch_assoc($result);
		$_SESSION['usertype'] = $users['usertype'];
		mysqli_close($conn);

	    header("Location:../index.php");
		}
	else{
		array_push($errors,"User Name or password don't match..");
	}
	}
	}
	}
	else{
			array_push($errors,"This account don't exist");
		}
}
?>
<?php include("../includes/head.php");?>
			<title>Login</title>
  
</head>

<body >
        <div class="container">
            <main>
                <div class="ath-container">
                    <div class="text-center">
                       <h1> LOGIN </h1>
                    </div>
                    <div class="ath-body">
                        <h5 class="text-center"><small class="tc-default">Log into your account</small>
                        </h5>
                        <form action="" method="post">
						<?php if (count($errors) > 0){ ?>
						<div class="alert alert-danger alert-dismissible">
						<a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
						<?php  foreach ($errors as $error){ ?>
							<li>
								<?php echo $error; ?>
							</li>
						<?php }?>
						</div>
						<?php } if(!empty($message)){?>
						<div class="alert alert-danger alert-dismissible">
						<a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
						<?php echo $message ?>
						</div>
						<?php } ?>
						<div class="form-group">
						<div class="row">
						<label class="col-md-3">Email</label>
                            <div class="col-md-9">
                                <input type="email" name="user_email" class="form-control" placeholder="Your Email" required>
                            </div>
							</div>
                        </div>  
						  
						  <div class="form-group">
						<div class="row">
						<label class="col-md-3">Password</label>
                            <div class="col-md-9">
                                <input type="password" name="password" required class="form-control" placeholder="Password">
                            </div>
							</div>
                        </div>
                            
                           <div class="text-center row">
						   <div class="col-md-3"></div>
						   <div class="col-md-9">
							 <button type="submit" name="submit" class="btn btn-primary  btn-md btn-block">Sign In</button><br>
							  <p>
							  <a href="password-reset.php" class="secondary-link">Forgot password?</a>
							  </p>
							  <p>
							  Don’t have an account? <a href="register.php">
                            <strong>Sign up here</strong></a>
							  </p>
							</div>				
							</div>							
                        </form>
                       
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
