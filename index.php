<?php include "includes/header.php"; ?>
<?php include "includes/navigation.php"; ?>
<div class="container mt-4">
	<?php if(isset($_SESSION['message'])||isset($_SESSION['message_mp'])) { ?>
		<p class="text-center message <?php echo strchr($_SESSION['message'], 'in') === false?'bg-danger':'bg-success'?:'bg-danger'; ?>">
			<?php
				echo $_SESSION['message'];
				echo $_SESSION['message_mp'];
				$_SESSION['message'] = NULL;
				$_SESSION['message_mp'] = NULL;
			?>
		</p>
	<?php } ?>
	<div class="row">
		<div class="col-lg-8">
			<?php
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

				$post_query_count = "SELECT * FROM posts WHERE post_status = 'published'";
				$find_count = mysqli_query($connection, $post_query_count);
				$count = mysqli_num_rows($find_count);
				$count = ceil($count / $per_page);

				if($count < 1) {
					echo "<h1 class='text-center'>No posts available</h1>";
				} else {
				$query = "SELECT * FROM posts WHERE post_status = 'published' LIMIT $page_1, $per_page ";
				$select_all_posts = buildArray($query);
			?>
					<?php foreach($select_all_posts as $key => $post) { ?>
					<h2 class="pt-3">
						<a href="post.php?p_id=<?php echo $post['post_id']; ?>"><?php echo $post['post_title'] ?></a>
					</h2>
					<p class="lead">
						by <a href="author_posts.php?author=<?php echo $post['post_user'] ?>"><?php echo $post['post_user'] ?></a>
					</p>
					<p><?php echo $post['post_date'] ?></p>
					<hr>
					<a href="post.php?p_id=<?php echo $post['post_id']; ?>"><img class="img-responsive img-post" src="images/<?php echo $post['post_image'];?>" alt=""></a>
					<hr>
					<p><?php echo limit_content($post['post_content'], 250)?></p>
					<a class="btn btn-primary mb-3" href="post.php?p_id=<?php echo $post['post_id']; ?>">Read More</a>
			<?php }}?>
		</div>
		<?php include "includes/sidebar.php" ?>
	</div>
	<?php pagination('index'); ?>
	<?php include "includes/footer.php" ?>
</div>