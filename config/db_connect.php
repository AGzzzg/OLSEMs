<?php

// connect to database
$conn =  mysqli_connect('localhost', 'root', '', 'olsem');

// check connection
if (!$conn) {
    echo 'Connection error: ' . mysqli_connect_error();
}

else{
	echo 'Succesfully connect to OLSEM Database';
}
?>
