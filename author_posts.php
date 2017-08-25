<?php include "includes/header.php" ?>
<?php
	if(isset($_GET['author'])&&!empty($_GET['author'])) {
		$the_post_user = $_GET['author'];
	} else {
		redirect('index.php');
	}
	$per_page = 5;
	if (isset($_GET['page'])) {
		$page = $_GET['page'];
	} else {
		$page = "";
	}
	if ($page == "" || $page == 1) {
		$page_1 = 0;
	} else {
		$page_1 = ($page * $per_page) - $per_page;
	}

	$post_query_count = "SELECT * FROM posts WHERE post_user = '$the_post_user'";
	$find_count = mysqli_query($connection, $post_query_count);
	$count = mysqli_num_rows($find_count);
	$count = ceil($count / $per_page);

	if($count < 1) {
		echo "<h1 class='text-center'>No posts available</h1>";
	} else {
	$query = "SELECT * FROM posts WHERE post_user = '{$the_post_user}' LIMIT $page_1, $per_page ";
	$select_user_posts = buildArray($query);
	foreach ($select_user_posts as $key => $aposts) {
		$post_user = $aposts['post_user'];
	}
?>
<?php include "includes/navigation.php" ?>
<div class="container">
	<div class="row">
		<div class="col-lg-8">
			<h1 class="page-header mt-3 text-center">
				All posts by: <span class="text-success"><?php echo $post_user;?></span>
			</h1>
			<?php foreach ($select_user_posts as $key => $post) { ?>
				<h2 class="pt-3">
					<a href="post.php?p_id=<?php echo $post['post_id']; ?>"><?php echo $post['post_title'] ?></a>
				</h2>
				<p></span><?php echo $post['post_date'] ?></p>
				<hr>
				<a href="post.php?p_id=<?php echo $post['post_id']; ?>"><img class="img-responsive img-post" src="images/<?php echo $post['post_image'];?>" alt=""></a>
				<hr>
				<p><?php echo limit_content($post['post_content'], 250)?></p>
				<a class="btn btn-primary mb-3" href="post.php?p_id=<?php echo $post['post_id']; ?>">Read More</a>
			<?php } ?>
		</div>
		<?php include "includes/sidebar.php" ?>
	</div>
	<?php pagination('author_posts'); ?>
	<?php } include "includes/footer.php" ?>
</div>
