<?php include "db.php"; ?>
<?php include "helper.php"; ?>
<?php session_start(); ?>
<?php 
if(isset($_GET['del'])&&($_SESSION['username']==$_GET['user']||$_SESSION['user_role']=='admin')) {
	$post_id = $_GET['del'];

    $query = "SELECT post_image FROM posts WHERE post_id = $post_id ";
    $img = buildArray($query);
    $post_image = $img[0]['post_image'];
    $query = "SELECT post_image FROM posts WHERE post_image = '{$post_image}'";
    $result = mysqli_query($connection, $query);
    if(mysqli_num_rows($result)==1) {
        unlink('../images/'.$post_image);
    }

    $query = "DELETE FROM comments WHERE comment_post_id = $post_id ";
    mysqli_query($connection, $query);

	$query = "DELETE FROM posts WHERE post_id = {$post_id} ";
	mysqli_query($connection, $query);

	redirect("../my_posts.php");
}
?>