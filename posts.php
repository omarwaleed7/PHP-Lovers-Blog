<?php
include 'includes/header.php';
// create db object
$db= new Connection();
if(isset($_GET['category'])){
    // getting id
    $id=$_GET['category'];
    // posts query
    $query="SELECT posts.*, categories.id
FROM posts
JOIN categories ON posts.id = categories.id
WHERE posts.id = $id
ORDER BY posts.id DESC;
";
    // run query
    $posts=$db->select($query);
}
else {
// posts query
    $query = "SELECT * FROM posts ORDER BY id DESC";
// run query
    $posts = $db->select($query);
}
// categories query
$query="SELECT * FROM categories";
// run query
$categories=$db->select($query);
?>
<?php if($posts->num_rows > 0):?>
    <?php while($row=$posts->fetch_assoc()):?>
        <div class="blog-post">
            <h2 class="blog-post-title"><?php echo $row['title'];?></h2>
            <p class="blog-post-meta"> <?php echo date_formatting($row['created_at'])?> by <a href="#"><?php echo $row['author'];?></a></p>
            <p><?php echo shorten_text($row['content']);?></p>
            <a class="readmore" href="post.php?id=<?php echo $row['id'];?>">Read More</a>
        </div><!-- /.blog-post -->
    <?php endwhile;?>
<?php else:?>
    <p>No Posts Available</p>
<?php endif;?>
<?php include 'includes/footer.php';
