<?php include "includes/header.php" ?>
<?php include "includes/navigation.php" ?>
<div class="container">
	<div class="row">
		<div class="col-lg-8">
			<?php 
			if(isset($_GET['search'])) {
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

				$search = $_GET['search'];
				$query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' ";
				$find_count = mysqli_query($connection, $query);
				$count = mysqli_num_rows($find_count);
				$count = ceil($count / $per_page);

				if($count < 1) {
					echo "<h1 class='text-center mt-3'>No posts available</h1>";
				} else {
				$query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'  LIMIT $page_1, $per_page ";
				$search_query = buildArray($query);
			?>
					<h1 class="page-header mt-3 text-center">
						Search results for: <span class="text-success"><?php echo $search;?></span>
					</h1>
				<?php foreach($search_query as $key => $result) { ?>
					<h2 class="pt-3">
						<a href="post.php?p_id=<?php echo $result['post_id']; ?>"><?php echo $result['post_title'] ?></a>
					</h2>
					<p class="lead">
						by <a href="author_posts.php?author=<?php echo $result['post_user'] ?>&p_id=<?php echo $result['post_id'] ?>"><?php echo $result['post_user'] ?></a>
					</p>
					<p><?php echo $result['post_date']; ?></p>
					<hr>
					<a href="post.php?p_id=<?php echo $result['post_id']; ?>"><img class="img-responsive img-post" src="images/<?php echo $result['post_image'];?>" alt=""></a>
					<hr>
					<p><?php echo limit_content($result['post_content'], 250)?></p>
					<a class="btn btn-primary mb-3" href="post.php?p_id=<?php echo $result['post_id']; ?>">Read More</a>
				<?php }}} ?>
		</div>
		<?php include "includes/sidebar.php" ?>
	</div>
	<?php pagination('search', '&search='.$search); ?>
	<?php include "includes/footer.php" ?>
</div>






















