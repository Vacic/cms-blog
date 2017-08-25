<?php include "includes/header.php" ?>
<!-- Navigation -->
<?php include "includes/navigation.php" ?>
<!-- Page Content -->
<div class="container">
	<div class="row">
		<!-- Blog Entries Column -->
		<div class="col-md-8">
			<?php
				if(isset($_GET['category'])) {
					$post_category_id = $_GET['category'];
				
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
					$post_query_count = "SELECT * FROM posts WHERE post_category_id = {$post_category_id} AND post_status = 'published' ";
					$find_count = mysqli_query($connection, $post_query_count);
					$count = mysqli_num_rows($find_count);
					$count = ceil($count / $per_page);
					if($count < 1) {
						echo "<h1 class='text-center'>No posts available</h1>";
					} else {
					$query = "SELECT * FROM posts WHERE post_category_id = {$post_category_id} AND post_status = 'published' LIMIT $page_1, $per_page ";
					$select_posts_by_cateogry = buildArray($query);
					$query = "SELECT cat_title FROM categories WHERE cat_id = {$post_category_id} ";
					$cat = mysqli_query($connection, $query);
					$cat = mysqli_fetch_row($cat);
					$cat = $cat[0];
			?>
					<h1 class="page-header mt-3 text-center">
						<span class="text-success"><?php echo $cat;?> courses</span>
					</h1>
					<?php foreach($select_posts_by_cateogry as $key => $post) { ?>
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
					<?php }}} ?>
			</div>
			<!-- Blog Sidebar Widgets Column -->
			<?php include "includes/sidebar.php" ?>
		</div>
	</div>
	<!-- /.row -->
	<hr>
	<?php pagination('category', '&category='.$post_category_id); ?>
	<?php include "includes/footer.php" ?>
</div>