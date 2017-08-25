<?php include "db.php"; ?>
<?php include "helper.php"; ?>
<?php session_start(); ?>
<?php 
    global $connection;
    if(isset($_POST['create_comment'])) {
        $post_id = $_POST['post_id'];
        $comment_author = $_SESSION['username'];
        $comment_email = $_SESSION['email'];
        $comment_content = $_POST['comment_content'];

        $comment_content = clean_string($comment_content);

        if(!empty($comment_content)&&!empty($comment_author)&&!empty($comment_email)) {
            $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
            $query .= "VALUES ($post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'approved', now())";

            $create_comment_query = mysqli_query($connection, $query);

			$query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
            $query .= "WHERE post_id = $post_id ";
            $update_comment_count = mysqli_query($connection, $query);
            redirect('../post.php?p_id='.$post_id);
        } else {
            $_SESSION['message'] = "<p class='bg-danger text-center message'>Login in order to comment</p>";
            redirect('../post.php?p_id='.$post_id);
        }
    }
?>