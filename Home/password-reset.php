<?php
include("../includes/inc.php");
session_start();
$errors = array();
$message = "";
$userName = "";
$reset = false;
 $dbConnection = new dbQuery($config['dbHost'],$config['dbUserName'],$config['dbPassword'],$config['dbName']);
    
	if(isset($_POST['submit1'])){
	$email = isset($_POST['user_email'])?$dbConnection->saveSQLInjection($_POST['user_email']):"";
	if (!$dbConnection->existsAlready('email', 'users', "email ='$email'")) {
        array_push($errors, "Account don't exist");
    }	
	$userPassword = isset($_POST['user_password'])?$dbConnection->saveSQLInjection($_POST['user_password']):"";
    $userPasswordR = isset($_POST['user_password_r'])?$dbConnection->saveSQLInjection($_POST['user_password_r']):"";

    if($userPassword != $userPasswordR)
	{
		array_push($errors,"The two passwords do not match");
	}
	if(count($errors)==0){
		$userPassword = password_hash($userPassword,PASSWORD_DEFAULT);	
		$updateData = $dbConnection ->updateData($table= 'users',$data=array("password"=>$userPassword),$where =" email='$email' ");
   if($updateData)
   {
	   
	   $message="Password has been reset successfully";
	}
	else{
		array_push($errors,"Password did not reset. Please try again.");
	}
}
	}
 ?>
<?php include("../includes/head.php");
		include("../includes/nav.php") ?>
			<title>Password Reset</title>

    </head>

    <body>
        <div class="container">
            <main>
			
                <div class="ath-container">
				<h1 class="text-center mb-6"> Password Reset </h1>
                    <div class="ath-header text-center">
                      
                    </div>
                    <div class="ath-body">
                       
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
						<div class="alert alert-success alert-dismissible">
						<a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
						<?php echo $message ?>
						</div>
						<?php }  ?>
                            
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
                                <input type="password" name="user_password" required class="form-control" placeholder=" New Password">
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
						<div class="text-center row">
						   <div class="col-md-3"></div>
						   <div class="col-md-9">
							  <button type ="submit" name="submit1" class="btn btn-primary btn-block btn-md">Reset Password</button>
							</div>				
							</div>
						
						
						</form>
                    </div>
					<div class="text-center row">
						   <div class="col-md-3"></div>
						   <div class="col-md-9">
							 <p>Remembered your password? <a href="login.php">
                            <strong>Sign in
                                here</strong></a></p>
							</div>				
							</div>
                    <div class="ath-note text-center tc-light"> 
                    </div>
                </div>
            </main>
        </div>
    
       
    </body>

</html>