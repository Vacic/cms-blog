<?php 
	include("delete_modal.php");

	$query = "SELECT posts.*, categories.* FROM posts INNER JOIN categories ON posts.post_category_id = categories.cat_id ORDER BY post_id DESC";
	$posts_categories = buildArray($query);


	if(isset($_POST['checkBoxArray'])) {
		foreach($_POST['checkBoxArray'] as $checkBoxValue) /*postID line 88*/ {
			$bulk_options = $_POST['bulk_options'];

			switch($bulk_options) {
				case'published':
				$query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$checkBoxValue} ";
				$update_to_published_status = mysqli_query($connection, $query);
				redirect("posts.php");
				break;

				case'draft':
				$query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$checkBoxValue} ";
				$update_to_published_status = mysqli_query($connection, $query);
				redirect("posts.php");
				break;

				case'delete':
				$query = "DELETE FROM posts WHERE post_id = {$checkBoxValue} ";
				$update_to_delete_status = mysqli_query($connection, $query);
				redirect("posts.php");
				break;

				case'clone':
				$query = "SELECT * FROM posts WHERE post_id = {$checkBoxValue}";
				$select_post_query = buildArray($query);
				foreach ($select_post_query as $key => $post) {
					$post_title = $post['post_title'];
					$post_category_id = $post['post_category_id'];
					$post_date = $post['post_date'];
					$post_user = $post['post_user'];
					$post_status = $post['post_status'];
					$post_image = $post['post_image'];
					$post_tags = $post['post_tags'];
					$post_content = $post['post_content'];
				}
				$query = "INSERT INTO posts(post_category_id, post_title, post_user, post_date, post_image, post_content, post_tags, post_status) ";
				$query .= "VALUES ({$post_category_id}, '{$post_title}', '{$post_user}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}') ";
				$copy_query = mysqli_query($connection, $query);
				if (!$copy_query) {
					die("QUERY FAILED" . mysyqli_error($connection));
				}
				redirect("posts.php");
				break;
			}
		}
	}

	if(isset($_GET['delete'])) {

		$the_post_id = $_GET['delete'];

		$query = "DELETE FROM posts WHERE post_id = {$the_post_id} ";
		$delete_query = mysqli_query($connection, $query);

		redirect("posts.php");
	}

	if(isset($_GET['reset'])) {

		$the_post_id = $_GET['reset'];

		$query = "UPDATE posts SET post_views_count = 0 WHERE post_id =" . mysqli_real_escape_string($connection, $_GET['reset']) . " ";
		$reset_query = mysqli_query($connection, $query);

		redirect("posts.php");
	}
?>
<form action="" method="post">
	<table class="table table-bordered table-hover">
		<div id="bulkOptionsContainer" class="col-xs-4 p-b">
			<select class="form-control" name="bulk_options" id="">
				<option value="">Select Options</option>
				<option value="published">Publish</option>
				<option value="draft">Draft</option>
				<option value="delete">Delete</option>
				<option value="clone">Clone</option>
			</select>
		</div>
		<div class="col-xs-4">
			<input type="submit" name="submit" class="btn btn-success" value="Apply">
			<a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
		</div>
		<thead>
			<tr>
				<th><input id="selectAllBoxes" type="checkbox"></th>
				<th>Id</th>
				<th>User</th>
				<th>Title</th>
				<th>Category</th>
				<th>Status</th>
				<th>Image</th>
				<th>Tags</th>
				<th>Comments</th>
				<th>Views</th>
				<th>Date</th>
				<th></th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($posts_categories as $key => $post_cat) { $post_id = $post_cat['post_id'] ?>
				<tr>
					<td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_cat['post_id']; ?>'></td>
					<td><?php echo $post_cat['post_id'];?></td>
					<?php if(!empty($post_cat['post_user'])) { ?>
					<td><?php echo $post_cat['post_user'];?></td>
					<?php } elseif(!empty($post_cat['post_user'])) { ?>
					<td><?php echo $post_cat['post_user']; ?></td>
					<?php } ?>
					<td><a href="../post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_cat['post_title'];?></a></td>
					<td><?php echo $post_cat['cat_title'];?></td>
					<td><?php echo $post_cat['post_status'];?></td>
					<td><img width="100" src="../images/<?php echo $post_cat['post_image'];?>" alt="image"></td>
					<td><?php echo $post_cat['post_tags'];?></td>
					<?php 
						$query = "SELECT * FROM comments WHERE comment_post_id = $post_id ";
						$send_comment_query = mysqli_query($connection, $query);
						$count_comments = mysqli_num_rows($send_comment_query);
					 ?>
					<td><a href="post_comments.php?id=<?php echo $post_id; ?>"><?php echo $count_comments;?></a></td>
					<td><?php echo $post_cat['post_views_count'];?></td>
					<td><?php echo $post_cat['post_date'];?></td>
					<td><a href="?source=edit_post&p_id=<?php echo $post_cat['post_id'];?>">Edit</a></td>
					<td><a rel="<?php echo $post_cat['post_id']; ?>" href="javascript:void(0)" class="delete_link">Delete</a></td>
					<td><a onClick="javascript: return confirm('Are you sure you want to reset the views of this post?');" href="?reset=<?php echo $post_cat['post_id'] ?>;">Reset Views</a></td>
				</tr>
			<?php }?>
		</tbody>
	</table>
</form>

<?php 
if(isset($_GET['delete'])) {

	$the_post_id = $_GET['delete'];

	$query = "DELETE FROM posts WHERE post_id = {$the_post_id} ";
	$delete_query = mysqli_query($connection, $query);

	redirect("posts.php");
}
?>

<script>
	$(document).ready(function(){
		$(".delete_link").on('click', function(){
			var id = $(this).attr("rel");
			var delete_url = "?delete="+ id +" ";
			$(".modal_delete_link").attr("href", delete_url);
			$("#myModal").modal('show');
		});
	});
</script>