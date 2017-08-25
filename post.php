<?php include "includes/header.php" ?>
<?php include "includes/navigation.php" ?>
<?php include "includes/delete_modal.php" ?>
	<div class="container">
<?php echo $_SESSION['message']; ?>
<?php $_SESSION['message'] = NULL; ?>
		<div class="row">
			<div class="col-lg-8">
				<?php
					if(isset($_GET['p_id'])) {
						$the_post_id = $_GET['p_id'];

						$view_query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = $the_post_id ";
						$send_query = mysqli_query($connection, $view_query);

						$query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
						$select_post = buildArray($query);
				?>
				<?php foreach($select_post as $key => $post) { ?>
				<h2 class="mt-3">
					<a href=""><?php echo $post['post_title']; ?></a>
					<?php if($_SESSION['user_role'] == 'admin'&&$_SESSION['username']!=$post['post_user']) { ?>
							<a href="admin/posts.php?source=edit_post&p_id=<?php echo $post['post_id']; ?>"><div class='btn btn-primary f-r'>Edit Post (admin)</div></a><br>
							<a rel="<?php echo $post['post_id']; ?>" href="javascript:void(0)" class="delete_link"><div class='btn btn-danger f-r mt-3' style="margin-left: 500px">Delete (admin)</div></a>
					<?php } elseif($_SESSION['user_role'] == 'admin'&&$_SESSION['username']==$post['post_user']) { ?>
							<a href="admin/posts.php?source=edit_post&p_id=<?php echo $post['post_id']; ?>"><div class='btn btn-primary f-r mr-4'>Edit Post (admin)</div></a><div style="height:3px"></div>
					<?php } ?>
					<?php if($_SESSION['username']==$post['post_user']) { ?>
							<a user="<?php echo $post['post_user']; ?>" rel="<?php echo $post['post_id']; ?>" href="javascript:void(0)" class="delete_link"><div class='btn btn-danger f-r mt-3'>Delete</div></a>
            				<a href="my_posts.php?s=edit_post&p_id=<?php echo $post['post_id']; ?>"><div class='btn btn-primary f-r mr-4 mt-3'>Edit Post</div></a>
					<?php } ?>
				</h2>
								<p class="lead">
					by <a href="#"><?php echo $post['post_user']; ?></a>
				</p>
				<p><?php echo $post['post_date']; ?></p>
				<hr>
				<img class="img-responsive img-post" src="images/<?php echo $post['post_image'];?>" alt="">
				<hr>
				<p><?php echo $post['post_content'] ?></p>
				<hr>
				<?php }} else {redirect("index.php");} ?>
				<!-- Comments -->
				<div class="well">
					<h4>Leave a Comment:</h4>
					<form action="includes/create_comment.php" method="post" role="form">
						
						<div class="form-group">
							<textarea name="comment_content" class="form-control" rows="3"></textarea>
						</div>

						<input type="hidden" name="post_id" value="<?php echo $the_post_id ?>">

						<button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
					</form>
				</div>
				<!-- Posted Comments -->
				<?php 
					$query = "SELECT * FROM comments WHERE comment_post_id = $the_post_id ";
					$query .= "AND comment_status = 'approved' ";
					$query .= "ORDER BY comment_id DESC ";
					$select_comments = buildArray($query);
				?>
				<?php if (!empty($select_comments)) echo '<hr>'; ?>
				<?php foreach($select_comments as $key => $comment) { ?>
					<div class="mb-5">
						<div class="">
						<a class="" href="#">
							<img class="comment-img pull-left mr-3" src="images/profile/<?php echo comment_img($comment['comment_author']); ?>" alt="">
						</a>
							<h4 class=""><?php echo $comment['comment_author']; ?>
								<small><?php echo $comment['comment_date']; ?></small>
							</h4>
							<div class="comment-content"><?php echo $comment['comment_content']; ?></div>
						</div>
					</div>
				<?php } ?>
			</div>
			<?php include "includes/sidebar.php" ?>
		<hr>
	</div>
	<?php include "includes/footer.php" ?>