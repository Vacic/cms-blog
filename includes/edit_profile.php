<?php include "db.php"; ?>
<?php include "helper.php"; ?>
<?php session_start(); ?>
<?php 
if(isset($_POST['edit_user'])) {
	$user_firstname = $_POST['user_firstname'];
	$user_lastname = $_POST['user_lastname'];
	$user_image = $_FILES['image']['name'];
	$user_image_temp = $_FILES['image']['tmp_name'];
	$username = $_POST['username'];
	$user_email = $_POST['user_email'];
	$user_password = $_POST['user_password'];
	$confirm_password = $_POST['confirm_password'];

	$user_firstname = clean_string($user_firstname);
	$user_lastname = clean_string($user_lastname);
	$user_image = clean_string($user_image);
	$username = clean_string($username);
	$user_email = clean_string($user_email);
	$user_password = clean_string($user_password);
	$confirm_password = clean_string($confirm_password);
	move_uploaded_file($user_image_temp, "../images/profile/".$user_image);

	if($user_password==$confirm_password) {
		$query = "UPDATE users SET ";
		$query .= "user_firstname = '{$user_firstname}', ";
		$query .= "user_lastname = '{$user_lastname}', ";
		if(!empty($user_image)) $query .= "user_image = '{$user_image}', ";
		$query .= "username = '{$username}', ";
		if(!$user_password=='') {
			$user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));
			$query .= "user_password = '{$user_password}', ";
		} 
		$query .= "user_email = '{$user_email}' ";
		$query .= "WHERE username = '{$username}' ";
		$edit_user_query = mysqli_query($connection, $query);
		confirmQuery($edit_user_query);
		$_SESSION['message'] = "<p class='bg-success text-center'>You've succesfully updated your profile</p>";
	    redirect('../profile.php');
	} else {
        $_SESSION['message'] = "<p class='bg-danger text-center'>Passwords don't match</p>";
        redirect('../profile.php');
    }
}
?>