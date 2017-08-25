<?php 
	if(isset($_POST['create_post'])) {
		$post_user = $_SESSION['username'];
		$post_title = $_POST['post_title'];
		$post_category_id = $_POST['post_category'];
		$post_image = $_FILES['image']['name'];
		$post_image_temp = $_FILES['image']['tmp_name'];
		$post_tags = $_POST['post_tags'];
		$post_content = $_POST['post_content'];

		$post_title = clean_string($post_title);
		$post_category_id = clean_string($post_category_id);
		$post_image = clean_string($post_image);
		$post_image_temp = clean_string($post_image_temp);
		$post_tags = clean_string($post_tags);
		$post_content = clean_string($post_content);

		move_uploaded_file($post_image_temp, "images/$post_image");

		$query = "INSERT INTO posts(post_category_id, post_title, post_user, post_date, post_image, post_content, post_tags, post_status) ";
		$query .= "VALUES({$post_category_id}, '{$post_title}', '{$post_user}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', 'draft') ";
		$create_post_query = mysqli_query($connection, $query);
		confirmQuery($create_post_query);
		$the_post_id = mysqli_insert_id($connection);

		$_SESSION['message'] = "<p class='bg-success text-center'></p>";
		redirect('my_posts.php');
	}
?>
<form class="pt-3" action="" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label for="title">Post Title</label>
		<input type="text" class="form-control" name="post_title">
	</div>

	<div class="form-group">
		<label for="post_category">Category</label><br>
		<select name="post_category" id="">
			<?php 

			$query = "SELECT * FROM categories";
			$select_categories = mysqli_query($connection, $query);

			confirmQuery($select_categories);

			while($row = mysqli_fetch_assoc($select_categories)) {
				$cat_id = $row['cat_id'];
				$cat_title = $row['cat_title'];

				echo "<option value='$cat_id'>{$cat_title}</option>";
			}
			?>
		</select>
	</div>

	<div class="form-group">
		<label for="post_image">Post Image</label><br>
		<input type="file" name="image">
	</div>

	<div class="form-group">
		<label for="post_tags">Post Tags</label>
		<input type="text" class="form-control" name="post_tags">
	</div>

	<div class="form-group">
		<label for="post_content">Post Content</label>
		<textarea class="form-control" name="post_content" id="" cols="30" rows="10"></textarea>
	</div>

	<div class="form-group">
		<input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
	</div>
</form>