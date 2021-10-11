<?php

session_start();

if(!isset($_SESSION['email']) || empty($_SESSION['email'])){

	echo "<script>window.location = 'index'</script>";

	exit;

}

?>