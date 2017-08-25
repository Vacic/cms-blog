<?php 
if(isset($_SESSION['username'])) {
	if(isset($_GET['p_id'])) {
		$the_post_id = ($_GET['p_id']);
	}
	$query = "SELECT * FROM posts WHERE post_id = $the_post_id" ;
	$select_posts_by_id = buildArray($query);
	confirmQuery($select_posts_by_id);
	foreach ($select_posts_by_id as $key => $posts) {
		$post_user = $posts['post_user'];
		$post_title = $posts['post_title'];
		$post_image = $posts['post_image'];
		$post_content = $posts['post_content'];
		$post_tags = $posts['post_tags'];
	}

	if(isset($_POST['update_post'])&&$_SESSION['username']==$post_user) {

			$post_title = $_POST['post_title'];
			$post_image = $_FILES['image']['name'];
			$post_image_temp = $_FILES['image']['tmp_name'];
			$post_content = $_POST['post_content'];
			$post_tags = $_POST['post_tags'];

			$post_title = clean_string($post_title);
			$post_image = clean_string($post_image);
			$post_content = clean_string($post_content);
			$post_tags = clean_string($post_tags);

			move_uploaded_file($post_image_temp, "images/".$post_image);
			$query = "UPDATE posts SET ";
			$query .= "post_title = '{$post_title}', ";
			$query .= "post_tags = '{$post_tags}', ";
			if(!empty($post_image)) $query .= "post_image = '{$post_image}', ";
			$query .= "post_content = '{$post_content}' ";
			$query .= "WHERE post_id = {$the_post_id} ";

			$update_post = mysqli_query($connection, $query);

			$_SESSION['message'] = "<p class='bg-success text-center'>Post Updated. <a href='post.php?p_id=$the_post_id'>View Post</a> or <a href='my_posts.php'>View All Your Posts</a></p>";
			confirmQuery($update_post);
			redirect('my_posts.php');
		}

}	

?>
<form class="pt-3" action="" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label for="title">Post Title</label>
		<input value="<?php echo $post_title; ?>" type="text" class="form-control" name="post_title">
	</div>

	<div class="form-group">
	<label for="current_picture">Current Image: <?php echo $post_image; ?></label><br>
	<img width="150" name="current_picture" class="img-flex" src="images/<?php echo $post_image; ?>"><br>
		<input type="file" name="image" class="pt-3">
	</div>

	<div class="form-group">
		<label for="post_tags">Post Tags</label>
		<input value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags">
	</div>

	<div class="form-group">
		<label for="post_content">Post Content</label>
		<textarea class="form-control" name="post_content" id="" cols="30" rows="10"><?php echo $post_content; ?></textarea>
	</div>

	<div class="form-group">
		<input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
	</div>
</form>