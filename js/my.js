$(document).ready(function(){
    $(".delete_link").on('click', function(){
        var id = $(this).attr("rel");
        var user = $(this).attr("user")
        var delete_url = "includes/delete_post.php?del="+ id +"&user="+ user +" ";
        $(".modal_delete_link").attr("href", delete_url);
        $("#myModal").modal('show');
    });
});