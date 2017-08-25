<?php 
if(isset($_GET['p_id'])) {
	$the_post_id = ($_GET['p_id']);
}

$query = "SELECT posts.*, categories.* FROM posts INNER JOIN categories on posts.post_category_id=categories.cat_id WHERE post_id = $the_post_id" ;
$select_posts_by_id = buildArray($query);
confirmQuery($select_posts_by_id);
foreach ($select_posts_by_id as $key => $posts_categories) {
	$post_id = $posts_categories['post_id'];
	$post_user = $posts_categories['post_user'];
	$post_title = $posts_categories['post_title'];
	$post_category_id = $posts_categories['post_category_id'];
	$post_status = $posts_categories['post_status'];
	$post_image = $posts_categories['post_image'];
	$post_content = $posts_categories['post_content'];
	$post_tags = $posts_categories['post_tags'];
	$post_comment_count = $posts_categories['post_comment_count'];
	$post_date = $posts_categories['post_date'];
	$cat_post_id = $posts_categories['cat_id'];
	$cat_post_title = $posts_categories['cat_title'];
}

$query = "SELECT * FROM categories WHERE cat_id != $cat_post_id ";
$select_categories = buildArray($query);
confirmQuery($select_categories);

$query = "SELECT * FROM users WHERE username != '$post_user' ";
$select_user = buildArray($query);
confirmQuery($select_user);

if(isset($_POST['update_post'])) {

	$post_user = $_POST['post_user'];
	$post_title = $_POST['post_title'];
	$post_category_id = $_POST['post_category'];
	$post_status = $_POST['post_status'];
	$post_image = $_FILES['image']['name'];
	$post_image_temp= $_FILES['image']['tmp_name'];
	$post_content = $_POST['post_content'];
	$post_tags = $_POST['post_tags'];

	move_uploaded_file($post_image_temp, "../images/$post_image");

	$query = "UPDATE posts SET ";
	$query .= "post_title = '{$post_title}', ";
	$query .= "post_category_id = '{$post_category_id}', ";
	$query .= "post_date = now(), ";
	$query .= "post_user = '{$post_user}', ";
	$query .= "post_status = '{$post_status}', ";
	$query .= "post_tags = '{$post_tags}', ";
	$query .= "post_content = '{$post_content}', ";
	$query .= "post_image = '{$post_image}' ";
	$query .= "WHERE post_id = {$the_post_id} ";

	$update_post = mysqli_query($connection, $query);

	confirmQuery($update_post);

	echo "<p class='bg-success'>Post Updated. <a href='../post.php?p_id=$the_post_id'>View Post</a> or <a href='posts.php'>View All Posts</a></p>";
}
?>


<form action="" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label for="title">Post Title</label>
		<input value="<?php echo $post_title; ?>" type="text" class="form-control" name="post_title">
	</div>

	<div class="form-group">
		<label for="post_category">Category</label><br>
		<select name="post_category" id="">
			<option value="<?php echo $cat_post_id; ?>"><?php echo $cat_post_title; ?></option>
			<?php foreach ($select_categories as $key => $category) { ?>
			<option value="<?php echo $category['cat_id']; ?>"><?php echo $category['cat_title']?></option>
			<?php } ?>
		</select>
	</div>

	<div class="form-group">
		<label for="post_user">Users</label><br>
		<select name="post_user" id="">
			<option value="<?php echo $post_user; ?>"><?php echo $post_user; ?></option>
			<?php foreach ($select_user as $key => $user) { ?>
			<option value="<?php echo $user['username']; ?>"><?php echo $user['username'] ?></option>
			<?php } ?>
		</select>
	</div>

	<div class="form-group">
		<select name="post_status" id="">
			<option value="<?php echo $post_status; ?>"><?php echo $post_status; ?></option>
			<?php if($post_status == 'published') { ?>
				<option value='draft'>draft</option>
			<?php } else { ?>
				<option value='published'>published</option>
			<?php }	?>
		</select>
	</div>

	<div class="form-group">
		<img width="100" src="../images/<?php echo $post_image; ?>">
		<input type="file" name="image" style="padding-top: 4px">
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
	</div>