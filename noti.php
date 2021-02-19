<?php

include('config/session.php');
include('config/db_connect.php');
include("./connection/DB.php");
// close connection
mysqli_close($conn);


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Course Details - Mentor Bootstrap Template</title>
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
  <script src="./assets/js/jquery.min.js"></script>
  <script src="./assets/js/bootstrap.min.js"></script>

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Mentor - v2.1.0
  * Template URL: https://bootstrapmade.com/mentor-free-education-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <style>
      body {
           margin:0 !important;
           padding:0 !important;
           box-sizing: border-box;
           font-family: 'Roboto', sans-serif;
      }
      .round{
        width:20px;
        height:20px;
        border-radius:50%;
        position:relative;
        background:red;
        display:inline-block;
        padding:0.3rem 0.2rem !important;
        margin:0.3rem 0.2rem !important;
        left:-18px;
        top:10px;
        z-index: 99 !important;
      }
      .round > span {
        color:white;
        display:block;
        text-align:center;
        font-size:1rem !important;
        padding:0 !important;
      }

      #list{

        display: none;
        top: 33px;
        position: absolute;
        right: 2%;
        background:#ffffff;
        z-index:100 !important;
        width: 25vw;
        margin-left: -37px;

        padding:0 !important;
        margin:0 auto !important;
      }

      .message > span {
         width:100%;
         display:block;
         color:red;
         text-align:justify;
         margin:0.2rem 0.3rem !important;
         padding:0.3rem !important;
         line-height:1rem !important;
         font-weight:bold;
         border-bottom:1px solid white;
         font-size:1.8rem !important;
       }

      .message{
        /* background:#ff7f50;
        margin:0.3rem 0.2rem !important;
        padding:0.2rem 0 !important;
        width:100%;
        display:block; */

      }
      .message > .msg {
         width:90%;
         margin:0.2rem 0.3rem !important;
         padding:0.2rem 0.2rem !important;
         text-align:justify;
         font-weight:bold;
         display:block;
         word-wrap: break-word;


      }

  </style>
</head>

<body>
  <?php
    $find_notifications = "Select * from inf where active = 1";
    $result = mysqli_query($connection,$find_notifications);
    $count_active = '';
    $notifications_data = array();
    $deactive_notifications_dump = array();
     while($rows = mysqli_fetch_assoc($result)){
             $count_active = mysqli_num_rows($result);
             $notifications_data[] = array(
                         "n_id" => $rows['n_id'],
                         "notifications_name"=>$rows['notifications_name'],
                         "message"=>$rows['message']
             );
     }
     //only five specific posts
     $deactive_notifications = "Select * from inf where active = 0 ORDER BY n_id DESC LIMIT 0,5";
     $result = mysqli_query($connection,$deactive_notifications);
     while($rows = mysqli_fetch_assoc($result)){
       $deactive_notifications_dump[] = array(
                   "n_id" => $rows['n_id'],
                   "notifications_name"=>$rows['notifications_name'],
                   "message"=>$rows['message']
       );
     }

  ?>
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo mr-auto"><a href="index.php">OLSEM</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo mr-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li><a href="index.php">Home</a></li>  
          <li><a href ="Home/profile.php"><?php echo $_SESSION['first_name']?></a></li>
          <li><a href="about.php">About</a></li>
          <li><a href="calendar.php">Calendar</a></li>
          <li><a href="courses.php">Courses</a></li>
        <?php if ($_SESSION['user']=true) : ?>
          <li><a href="template.php">File Manager</a></li>
        <?php endif; ?>
        <li class="active"><a href="noti.php">Notification</a></li>



                    <li><i class="fa fa-bell"   id="over" data-value ="<?php echo $count_active;?>" style="z-index:-99 !important;font-size:23px;color:black;margin:0.5rem 0.4rem !important;"></i></li>
                    <?php if(!empty($count_active)){?>
                    <div class="round" id="bell-count" data-value ="<?php echo $count_active;?>"><span><?php echo $count_active; ?></span></div>
                    <?php }?>

                    <?php if(!empty($count_active)){?>
                      <div id="list">
                       <?php
                          foreach($notifications_data as $list_rows){?>
                            <li id="message_items">
                            <div class="message alert alert-warning" data-id=<?php echo $list_rows['n_id'];?>>
                              <span><?php echo $list_rows['notifications_name'];?></span>
                              <div class="msg">
                                <p><?php
                                  echo $list_rows['message'];
                                ?></p>
                              </div>
                            </div>
                            </li>
                         <?php }
                       ?>
                       </div>
                     <?php }else{?>
                        <!--old Messages-->
                        <div id="list">
                        <?php
                          foreach($deactive_notifications_dump as $list_rows){?>
                            <li id="message_items">
                            <div class="message alert alert-danger" data-id=<?php echo $list_rows['n_id'];?>>
                              <span><?php echo $list_rows['notifications_name'];?></span>
                              <div class="msg">
                                <p><?php
                                  echo $list_rows['message'];
                                ?></p>
                              </div>
                            </div>
                            </li>
                         <?php }
                       ?>
                        <!--old Messages-->

                     <?php } ?>

                     
              




        </ul>
      </nav><!-- .nav-menu -->

      <?php if ($_SESSION['login'] = false) : ?>
        <a href="Home/login.php" class="get-started-btn">Log In</a>
        <?php else : ?>
          <a href="Home/logout.php" class="get-started-btn">Log Out</a>
      <?php endif; ?>

       </div>
  </header><!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" >
      <div class="container">
        <h2>Notification</h2>
        <p>Notify User </p>
      </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Start Your Code Here ======= -->
             <div class="container">
                    <h3>Notifications</h3>

                    <form class="form-horizontal" id="frm_data">
                        <div class="form-group row">
                           <label class="control-label col-md-4" for="notification">Event</label>
                           <div class="col-md-6">
                             <input type="text" name="notifications_name" id="notifications_name" class="form-control" placeholder="Event name" required/>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="control-label col-md-4" for="notification">Message</label>
                           <div class="col-md-6">
                             <textarea style="resize:none !important;"name="message" id="message" rows="4" cols="10" class='form-control'></textarea>
                           </div>
                        </div>
                        <div class="form-group row">
                           <div class="col-md-10 col-offset-2" style="text-align:center;">
                           <input type="submit" id="notify" name="submit" class="btn btn-danger" value="NOTIFY"/>
                           </div>
                        </div>
                    </form>
             </div>


 </body>
 <script>
 $(document).ready(function(){
   var ids = new Array();
   $('#over').on('click',function(){
          $('#list').toggle();
      });

  //Message with Ellipsis
  $('div.msg').each(function(){
      var len =$(this).text().trim(" ").split(" ");
     if(len.length > 12){
        var add_elip =  $(this).text().trim().substring(0, 65) + "…";
        $(this).text(add_elip);
     }

 });


  $("#bell-count").on('click',function(e){
       e.preventDefault();

       let belvalue = $('#bell-count').attr('data-value');

       if(belvalue == ''){

         console.log("inactive");
       }else{
         $(".round").css('display','none');
         $("#list").css('display','block');

         // $('.message').each(function(){
         // var i = $(this).attr("data-id");
         // ids.push(i);

         // });
         //Ajax
         $('.message').click(function(e){
           e.preventDefault();
             $.ajax({
               url:'./connection/deactive.php',
               type:'POST',
               data:{"id":$(this).attr('data-id')},
               success:function(data){

                   console.log(data);
                   location.reload();
               }
           });
       });
    }
  });

  $('#notify').on('click',function(e){
       e.preventDefault();
       var name = $('#notifications_name').val();
       var ins_msg = $('#message').val();
       if($.trim(name).length > 0 && $.trim(ins_msg).length > 0){
         var form_data = $('#frm_data').serialize();
       $.ajax({
         url:'./connection/insert.php',
               type:'POST',
               data:form_data,
               success:function(data){
                   location.reload();
               }
       });
       }else{
         alert("Please Fill All the fields");
       }


  });
 });
 </script>

</html>
