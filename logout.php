<?php 
	session_start();
	unset($_SESSION['name_customer']);
	unset($_SESSION['id_customer']);
	header('location:index.php');
 ?>