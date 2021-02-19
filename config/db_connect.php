<?php

// connect to database
$conn =  mysqli_connect('sql10.freemysqlhosting.net', 'sql10393918', 'KlnmzegqUF', 'sql10393918');

// check connection
if (!$conn) {
    echo 'Connection error: ' . mysqli_connect_error();
}

else{
	echo 'Succesfully connect to OLSEM Database';
}
?>
