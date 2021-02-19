
<?php 
session_start();
include("../includes/head.php");
include("../includes/nav.php");
 ?>
    <div class="container ath-container">
	<div class="row">
		<div class="col-md-offset-2 col-md-8 col-lg-offset-3 col-lg-6">
    	 <div class="">
            <div class="col-sm-12">
                <div class="col-xs-12 col-sm-8">
                    <h2 ><i class="fa fa-user profile-title" aria-hidden="true">     </i><?php  echo $_SESSION['first_name']." ".$_SESSION['last_name']; ?></h2>
					<hr>
                    <p><strong>Email: </strong> <?php echo $_SESSION['email']?> </p>
                   
                </div>             
             
            </div>            
           
    	 </div>                 
		</div>
	</div>
</div>

</body>

</html>