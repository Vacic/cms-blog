<?php 
	$query = "SELECT comments.*, posts.* FROM comments INNER JOIN posts on comments.comment_post_id=posts.post_id ";
	$comments = buildArray($query);

/*	deBug($comments, true); vraca podatke iz baze, provera*/
	if(isset($_GET['approve'])) {

		$the_comment_id = $_GET['approve'];

		$query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $the_comment_id ";
		$approve_comment_query = mysqli_query($connection, $query);
		redirect("comments.php");
	}

	if(isset($_GET['unapprove'])) {

		$the_comment_id = $_GET['unapprove'];

		$query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $the_comment_id ";
		$unapprove_comment_query = mysqli_query($connection, $query);
		redirect("comments.php");
	}

	if(isset($_GET['delete'])) {

		$the_comment_id = $_GET['delete'];

		$query = "DELETE FROM comments WHERE comment_id = $the_comment_id ";
		$delete_query = mysqli_query($connection, $query);

		$query = "UPDATE posts SET post_comment_count = post_comment_count - 1 ";
		$query .= "WHERE post_id = $comment_post_id ";
		$decrease_comment_count = mysqli_query($connection, $query);

		redirect("comments.php");
	}
?>
<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>Id</th>
			<th>Author</th>
			<th>Comment</th>
			<th>Email</th>
			<th>Status</th>
			<th>In Response to</th>
			<th>Date</th>
			<th>Approve</th>
			<th>Unapprove</th>
			<th>Delete</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($comments as $key => $comment) { ?>
			<tr>
				<td><?php echo $comment["comment_id"]; ?></td>
				<td><?php echo $comment["comment_author"]; ?></td>
				<td><?php echo $comment["comment_content"]; ?></td>
				<td><?php echo $comment["comment_email"]; ?></td>
				<td><?php echo $comment["comment_status"]; ?></td>
				<td><a href="../post.php?p_id=<?php echo $comment["post_id"]; ?>"><?php echo $comment["post_title"]; ?></a></td>
				<td><?php echo $comment["comment_date"]; ?></td>
				<td><a href="comments.php?approve=<?php echo $comment["comment_id"]; ?>">Approve</a></td>
				<td><a href="comments.php?unapprove=<?php echo $comment["comment_id"]; ?>">Unapprove</a></td>
				<td><a href="comments.php?delete=<?php echo $comment["comment_id"]; ?>">Delete</a></td>
			</tr>
		<?php } ?>
	</tbody>
</table>