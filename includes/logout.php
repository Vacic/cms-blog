<?php include "helper.php"; ?>
<?php session_start(); ?>
<?php 
	$_SESSION['username'] = null;
	$_SESSION['firstname'] = null;
	$_SESSION['lastname'] = null;
	$_SESSION['user_role'] = null;
	$_SESSION['email'] = null;
	$_SESSION['message_mp'] = null;
	$_SESSION['message'] = "You've successfuly logged out";

	redirect("../index.php");
?>