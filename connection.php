<?php

	$host	= "localhost";
    $user	= "root";
    $pass	= "";
    $db     = "ersas";
    $conn 	= mysqli_connect($host,$user,$pass,$db);

    if ($conn-> connect_error) {
    	
    	die("connection failed" .$conn-> connect_error);
    }

?>