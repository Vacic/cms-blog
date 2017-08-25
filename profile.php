<?php include "includes/header.php" ?>
<?php include "includes/navigation.php" ?>
<?php 
if(isset($_SESSION['username'])) {
	$username = $_SESSION['username'];
	$query = "SELECT * FROM users WHERE username = '{$username}' ";
	$user = buildArray($query);
	foreach ($user as $key => $user) {
		$user_id = $user['user_id'];
		$username = $user['username'];
		$user_password = $user['user_password'];
		$user_firstname = $user['user_firstname'];
		$user_lastname = $user['user_lastname'];
		$user_email = $user['user_email'];
		$user_image = $user['user_image'];
		$user_role = $user['user_role'];
	}
}
?>
<div class="container">
<?php if(isset($_SESSION['message'])) echo $_SESSION['message'].$_SESSION['message'] = NULL;?>
	<div class="row justify-content-center">
		<div class="col-lg-9 col-12 col-sm-11 col-md-10 col-xl-8">
			<h1 class="page-header text-center m-3">
				Your Profile <small>(<?php echo $_SESSION['username']; ?>)</small>
			</h1>
			<form action="includes/edit_profile.php" method="post" enctype="multipart/form-data">
			
				<div class="form-group text-center">
					<img class="img-profile" src="images/profile/<?php echo $user_image; ?>">
				</div>

				<div class="form-group">
					<label for="user_firstname">Firstname</label>
					<input type="text" value="<?php echo $user_firstname; ?>" class="form-control" name="user_firstname">
				</div>

				<div class="form-group">
					<label for="user_lastname">Lastname</label>
					<input type="text" value="<?php echo $user_lastname; ?>" class="form-control" name="user_lastname">
				</div>
   
				<div class="form-group">
					<label for="post_image">Choose Picture</label><br>
					<input type="file" name="image">
				</div>

				<div class="form-group">
					<label for="username">Username</label>
					<input type="text" value="<?php echo $username; ?>" class="form-control" name="username">
				</div>

				<div class="form-group">
					<label for="user_email">Email</label>
					<input type="email" value="<?php echo $user_email; ?>" class="form-control" name="user_email">
				</div>

				<div class="form-group">
					<label for="user_password">Password</label>
					<input type="password" class="form-control" name="user_password">
				</div>

				<div class="form-group">
					<label for="user_password">Confirm Password</label>
					<input type="password" class="form-control" name="confirm_password">
				</div>

				<div class="form-group">
					<input class="btn btn-primary" type="submit" name="edit_user" value="Update">
				</div>
			</form>
		</div>
	</div>
	<?php include "includes/footer.php" ?>
</div>