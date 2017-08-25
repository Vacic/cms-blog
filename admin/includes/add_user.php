<?php 

if(isset($_POST['create_user'])) {

	$first_name = $_POST['user_firstname'];
	$last_name = $_POST['user_lastname'];
	$user_role = $_POST['user_role'];
	$username = $_POST['username'];
	$email = $_POST['user_email'];
	$password = $_POST['user_password'];


	if(!empty($last_name) && !empty($first_name) && !empty($user_role) && !empty($username) && !empty($email) && !empty($password)) {

		$first_name = mysqli_real_escape_string($connection, $first_name);
		$last_name = mysqli_real_escape_string($connection, $last_name);
		$user_role = mysqli_real_escape_string($connection, $user_role);
		$username = mysqli_real_escape_string($connection, $username);
		$email = mysqli_real_escape_string($connection, $email);
		$password = mysqli_real_escape_string($connection, $password);

		$password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

/*		$query = "SELECT randSalt FROM users";
		$select_randsalt_query = mysqli_query($connection, $query);
		if(!$select_randsalt_query) {
			die("Query Failed" . mysqli_error($connection));
		}
		$row = mysqli_fetch_array($select_randsalt_query);
		$salt = $row['randSalt'];
		$password = crypt($password, $salt);*/
		$query = "INSERT INTO users (username, user_password, user_lastname, user_firstname, user_email, user_image, user_role) ";
		$query .= "VALUES ('{$username}', '{$password}', '{$last_name}', '{$first_name}', '{$email}', 'images/user_image_placeholder.png', '{$user_role}') ";
		$register_user_query = mysqli_query($connection, $query);
		if(!$register_user_query) {
			die("Query Failed" . mysqli_error($connection));
		}
		echo "User Created: <a class='bg-success' href='users.php'>View Users</a>";
	}
}


 ?>
<form action="" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label for="user_firstname">Firstname</label>
		<input type="text" class="form-control" name="user_firstname">
	</div>

	<div class="form-group">
		<label for="user_lastname">Lastname</label>
		<input type="text" class="form-control" name="user_lastname">
	</div>

	<div class="form-group">
	<select name="user_role" id="">
		
		<option value="subscriber">Select Role</option>		
		<option value="admin">Admin</option>
		<option value="subscriber">Subscriber</option>

	</select>
	</div>
<!-- 	
<div class="form-group">
	<label for="post_image">Post Image</label>
	<input type="file" name="image">
</div>
 -->
	<div class="form-group">
		<label for="username">Username</label>
		<input type="text" class="form-control" name="username">
	</div>

	<div class="form-group">
		<label for="user_email">Email</label>
		<input type="email" class="form-control" name="user_email">
	</div>

	<div class="form-group">
		<label for="user_password">Password</label>
		<input type="password" class="form-control" name="user_password">
	</div>

	<div class="form-group">
		<input class="btn btn-primary" type="submit" name="create_user" value="Add User">
	</div>
</form>