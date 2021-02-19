<?php

include('config/session.php');
include('config/db_connect.php');

// close connection
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>File Manager - Mentor Bootstrap Template</title>
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
  <link href="assets/css/style3.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"> </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="css/bootstrap.min.css" rel="stylesheet" />
  <script src="js/jquery-1.10.2.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.form.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
  #progress-wrp {
    border: 1px solid #0099CC;
    padding: 1px;
    position: relative;
    border-radius: 3px;
    margin: 10px;
    text-align: left;
    background: #fff;
    box-shadow: inset 1px 3px 6px rgba(0, 0, 0, 0.12);
}
#progress-wrp .progress-bar{
	height: 20px;
    border-radius: 3px;
    background-color: #79f763;
    width: 0;
    box-shadow: inset 1px 1px 10px rgba(0, 0, 0, 0.11);
}
#progress-wrp .status{
	top:3px;
	left:50%;
	position:absolute;
	display:inline-block;
	color: #000000;
}
  </style>

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
          <li><a href ="Home/profile.php"><?php echo $_SESSION['first_name']?></a></li>
          <li><a href="about.php">About</a></li>
          <li><a href="calendar.php">Calendar</a></li>
          <li><a href="courses.php">Courses</a></li>
          <li class="active"><a href="template.php">File Manager</a></li>
          <li><a href="noti.php">Notification</a><li>

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

        <h2>File Manager</h2>
        <p></p>
      </div>
    </div><!-- End Breadcrumbs -->

    <!-- Start your code here-->
    <div class="container">
       <h2 align="center">File Manager System OLSEM</a></h2>
       <br />
       <div align="right">
        <button type="button" name="create_folder" id="create_folder" class="btn btn-success">Create New Folder</button>
       </div>
       <br />
       <div class="table-responsive" id="folder_table">

       </div>
      </div>

 </body>

 </html>

<!--Folder--->
 <div id="folderModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
   <div class="modal-content">
    <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
     <h4 class="modal-title"><span id="change_title">Create Folder</span></h4>
    </div>
    <div class="modal-body">
     <p>Enter Folder Name
     <input type="text" name="folder_name" id="folder_name" class="form-control" /></p>
     <br />
     <input type="hidden" name="action" id="action" />
     <input type="hidden" name="old_name" id="old_name" />
     <input type="button" name="folder_button" id="folder_button" class="btn btn-info" value="Create" />
    </div>

<!--Upload File--->
    <div class="modal-footer">
     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
   </div>
  </div>
 </div>
 <div id="uploadModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
   <div class="modal-content">
    <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
     <h4 class="modal-title">Upload File</h4>
    </div>
    <div class="modal-body">
     <form method="post" id="upload_form" enctype='multipart/form-data'>
      <p>Select File
      <input type="file" name="upload_file" /></p>
      <br />
      <input type="hidden" name="hidden_folder_name" id="hidden_folder_name" />
      <input type="submit" name="upload_button" class="btn btn-info" value="Upload" />
      <input type="cancel" name="cancel_button" class="btn btn-danger" value="Cancel" />
      <div id="progress-wrp">
      <div class="progress-bar"></div >
      <div class="status">0%</div>
      <div id="targetLayer" style="display:none;"></div>
      </div>
     </form>
    </div>
    <div class="modal-footer">
     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
   </div>
  </div>
 </div>

<!--View File--->
 <div id="filelistModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
   <div class="modal-content">
    <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
     <h4 class="modal-title">File List</h4>
    </div>
    <div class="modal-body" id="file_list">

    </div>
    <div class="modal-footer">
     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
   </div>
  </div>
 </div>

 <script>

 $(document).ready(function(){

  load_folder_list();

  function load_folder_list()
  {
   var action = "fetch";
   $.ajax({
    url:"action.php",
    method:"POST",
    data:{action:action},
    success:function(data)
    {
     $('#folder_table').html(data);
    }
   });
  }

  $(document).on('click', '#create_folder', function(){
   $('#action').val("create");
   $('#folder_name').val('');
   $('#folder_button').val('Create');
   $('#folderModal').modal('show');
   $('#old_name').val('');
   $('#change_title').text("Create Folder");
  });

  $(document).on('click', '#folder_button', function(){
   var folder_name = $('#folder_name').val();
   var old_name = $('#old_name').val();
   var action = $('#action').val();
   if(folder_name != '')
   {
    $.ajax({
     url:"action.php",
     method:"POST",
     data:{folder_name:folder_name, old_name:old_name, action:action},
     success:function(data)
     {
      $('#folderModal').modal('hide');
      load_folder_list();
      alert(data);
     }
    });
   }
   else
   {
    alert("Enter Folder Name");
   }
  });

  $(document).on("click", ".update", function(){
   var folder_name = $(this).data("name");
   $('#old_name').val(folder_name);
   $('#folder_name').val(folder_name);
   $('#action').val("change");
   $('#folderModal').modal("show");
   $('#folder_button').val('Rename');
   $('#change_title').text("Change Folder Name");
  });

  $(document).on("click", ".delete", function(){
   var folder_name = $(this).data("name");
   var action = "delete";
   if(confirm("Are you sure you want to remove it?"))
   {
    $.ajax({
     url:"action.php",
     method:"POST",
     data:{folder_name:folder_name, action:action},
     success:function(data)
     {
      load_folder_list();
      alert(data);
     }
    });
   }
  });

  $(document).on('click', '.upload', function(){
   var folder_name = $(this).data("name");
   $('#hidden_folder_name').val(folder_name);
   $('#uploadModal').modal('show');
  });

  $('#upload_form').on('submit', function(){
   $.ajax({
    url:"upload.php",
    method:"POST",
    data: new FormData(this),
    contentType: false,
    cache: false,
    processData:false,
    success: function(data)
    {
     load_folder_list();
     alert(data);
    }
   });
  });

  $('#cancel_form').on('cancel', function(){
   $.ajax({
    url:"upload.php",
    method:"POST",
    data: new FormData(this),
    contentType: false,
    cache: false,
    processData:false,
    success: function(data)
    {
     load_folder_list();
     alert(data);
    }
   });
  });

  $(document).on('click',"#submit_button", function(e) {
  e.preventDefault();
  var formData = new FormData($("#form_id")[0]);
  $.ajax({
  url: "do-upload.php",
  type: 'POST',
  data: formData,
  cache: false,
  contentType: false,
  processData: false,
  enctype: 'multipart/form-data',

  xhr: function(){
  //upload Progress
  var xhr = $.ajaxSettings.xhr();
  if (xhr.upload) {
  xhr.upload.addEventListener('progress', function(event) {
  var percent = 0;
  var position = event.loaded || event.position;
  var total = event.total;
  if (event.lengthComputable)
  {
  percent = Math.ceil(position / total * 100);
  }
  //update progressbar
  $(".progress-bar").css("width", + percent +"%");
  $(".status").text(percent +"%");
  }, true);
  }
  return xhr;
  },
  success: function (mdata) {
  if(mdata == 0 ){
  alert("Done");
  }

  },
  });
  });

  $(document).on('click', '.view_files', function(){
   var folder_name = $(this).data("name");
   var action = "fetch_files";
   $.ajax({
    url:"action.php",
    method:"POST",
    data:{action:action, folder_name:folder_name},
    success:function(data)
    {
     $('#file_list').html(data);
     $('#filelistModal').modal('show');
    }
   });
  });

  $(document).on('click', '.remove_file', function(){
   var path = $(this).attr("id");
   var action = "remove_file";
   if(confirm("Are you sure you want to remove this file?"))
   {
    $.ajax({
     url:"action.php",
     method:"POST",
     data:{path:path, action:action},
     success:function(data)
     {
      alert(data);
      $('#filelistModal').modal('hide');
      load_folder_list();
     }
    });
   }
  });

 $(document).on('blur', '.change_file_name', function(){
   var folder_name = $(this).data("folder_name");
   var old_file_name = $(this).data("file_name");
   var new_file_name = $(this).text();
   var action = "change_file_name";
   $.ajax({
    url:"action.php",
    method:"POST",
    data:{folder_name:folder_name, old_file_name:old_file_name, new_file_name:new_file_name, action:action},
    success:function(data)
    {
     alert(data);
    }
   });
  });

 });
 </script>
