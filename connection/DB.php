<?php
   define('HOST','sql10.freemysqlhosting.net');
   define('PWD','KlnmzegqUF');
   define('USERNAME','sql10393918');
   define('DB','sql10393918');
   
   $connection = mysqli_connect(HOST,USERNAME,PWD,DB);
   if($connection){
       return $connection;
   }else{
       echo "Connect problem".mysqli_connect_error();
   }

?>
