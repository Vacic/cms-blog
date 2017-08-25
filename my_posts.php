<?php include "includes/header.php" ?>
<?php include "includes/navigation.php" ?>
<?php include "includes/delete_modal.php" ?>
<?php $mp = true ?>
<?php
	if(isset($_SESSION['username'])) {
		$user = $_SESSION['username'];
	} else {
		redirect('index.php');
		$_SESSION['message_mp'] = "You are not logged in";
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

		$post_query_count = "SELECT * FROM posts WHERE post_user = '$user'";
		$find_count = mysqli_query($connection, $post_query_count);
		$count = mysqli_num_rows($find_count);
		$count = ceil($count / $per_page);
?>
<div class="container">
<?php if(isset($_SESSION['message'])) echo $_SESSION['message'].$_SESSION['message'] = NULL;?>
	<div class="row <?php if(isset($_GET['s'])) echo 'justify-content-center'; ?>">
		<div class="<?php echo !isset($_GET['s'])?'col-xl-8':'col-12 col-sm-11 col-md-10 col-xl-9'; ?>">
			<?php 

			if(isset($_GET['s'])){
				$source = $_GET['s'];
			} else {
				$source = "";
			}
			switch($source) {
				case 'add_post';
				include "includes/add_post.php";
				break;

				case 'edit_post';
				include "includes/edit_my_post.php";
				break;
				
				default:
				include "includes/view_my_posts.php";

				break;
			}
			?>
		</div>
		<?php if(!isset($_GET['s'])) include "includes/sidebar.php" ?>
	</div>
	<?php if(!isset($_GET['s'])) pagination('my_posts'); ?>
	<?php include "includes/footer.php"; ?>
</div>