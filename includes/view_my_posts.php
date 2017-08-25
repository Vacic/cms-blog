<?php 
    if($count < 1) {
        echo "<h1 class='text-center'>No posts available</h1>";
    } else {
    $query = "SELECT * FROM posts WHERE post_user = '$user' ORDER BY post_id DESC LIMIT $page_1, $per_page ";
    $select_user_posts = buildArray($query);
?>
<h1 class="pt-3 text-center">
    <strong>Your Posts</strong> <small>(<?php echo $_SESSION['username'] ?>)</small>
</h1>
<!-- First Blog Post -->
<?php $count_post=0 ?>
<?php foreach ($select_user_posts as $key => $posts) { ?>
<?php $count_post++ ?>
<h2 class="pt-3">
    <a href="post.php?p_id=<?php echo $posts['post_id']; ?>"><?php echo $posts['post_title']; ?></a>
    <span class="<?php echo $posts['post_status']=='draft'?'draft':'published' ?>"><?php echo $posts['post_status']=='draft'?'(In Draft)':'(Published)' ?></span>
    <?php if ($user == $posts['post_user']): ?>
            <a user="<?php echo $posts['post_user']; ?>" rel="<?php echo $posts['post_id']; ?>" href="javascript:void(0)" class="delete_link"><div class='btn btn-danger f-r'>Delete</div></a>
            <a href='my_posts.php?s=edit_post&p_id=<?php echo $posts['post_id'] ?>'><div class='btn btn-primary f-r mr-3'>Edit Post</div></a>
    <?php endif; ?>
</h2>
<p><?php echo $posts['post_date']; ?></p>
<hr>
<a href="post.php?p_id=<?php echo $posts['post_id']; ?>"><img class="img-responsive img-post" src="images/<?php echo $posts['post_image'];?>" alt=""></a>
<hr>
<p><?php echo limit_content($posts['post_content'], 250); ?></p>
<?php if($count_post != 5) echo '<hr>'; ?>
<?php }} ?>