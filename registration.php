<?php include "includes/header.php"; ?>
<?php 
	if(isset($_POST['submit']))	{
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = $_POST['password'];

		if(!empty($last_name) && !empty($first_name) && !empty($username) && !empty($email) && !empty($password)) {

			$first_name = clean_string($first_name);
			$last_name = clean_string($last_name);
			$username = clean_string($username);
			$email = clean_string($email);
			$password = clean_string($password);

			$password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

/*			$query = "SELECT randSalt FROM users";
			$select_randsalt_query = mysqli_query($connection, $query);
			if(!$select_randsalt_query) {
				die("Query Failed" . mysqli_error($connection));
			}
			$row = mysqli_fetch_array($select_randsalt_query);
			$salt = $row['randSalt'];
			$password = crypt($password, $salt);*/

			$query = "INSERT INTO users (username, user_password, user_lastname, user_firstname, user_email, user_image, user_role) ";
			$query .= "VALUES ('{$username}', '{$password}', '{$last_name}', '{$first_name}', '{$email}', 'images/user_image_placeholder.png', 'subscriber') ";
			$register_user_query = mysqli_query($connection, $query);
			if(!$register_user_query) {
				die("Query Failed" . mysqli_error($connection));
			}

			$message = "<p class='bg-success'>Your Registration has been submited<p>";
		} else {
			$message = "<p class='bg-danger'>Fields cannot be empty<p>";
		}
	} else {
		$message = "";
	}
?>
	<!-- Navigation -->
<?php include "includes/navigation.php"; ?>
	<!-- Page Content -->
<div class="containter">
	<section id="login">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-11 col-sm-9 col-md-7 col-xl-5">
					<div class="form-warp">
						<h1 class="p-2 text-center">Register</h1>
						<form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
							<h6 class="text-center"><?php echo $message; ?></h6>
							<div class="form-group row">
								<label for="first_name" class="sr-only">First Name</label>
								<input type="text" name="first_name" id="first_name" class="form-control" placeholder="Enter First Name">
							</div>
							<div class="form-group row">
								<label for="last_name" class="sr-only">Last Name</label>
								<input type="text" name="last_name" id="last_name" class="form-control" placeholder="Enter Last Name">
							</div>
							<div class="form-group row">
								<label for="username" class="sr-only">Username</label>
								<input type="text" name="username" id="username" class="form-control" placeholder="Enter Username">
							</div>
							<div class="form-group row">
								<label for="email" class="sr-only">Email</label>
								<input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
							</div>
							<div class="form-group row">
								<label for="password" class="sr-only">Password</label>
								<input type="password" name="password" id="key" class="form-control" placeholder="Password">
							</div>
							<div class="form-group row justify-content-center">
								<input type="submit" name="submit" id="btn-login" class="btn btn-outline-primary btn-lg" value="Register">
							</div>
						</form>
					</div>
				</div> <!-- /.col-11 -->
			</div> <!-- /.row -->
		</div> <!-- /.container -->
	</section>
	<hr>
<?php include "includes/footer.php"; ?>
</div>