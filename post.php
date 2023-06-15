<?php include 'includes/header.php';?>
<?php
// create db object
$db=new Connection();
// getting id
$id=$_GET['id'];
// posts query
$query="SELECT * FROM posts WHERE id=$id";
// run query
$posts=$db->select($query);
// categories query
$query="SELECT * FROM categories";
// run query
$categories=$db->select($query);
?>
<?php if($posts->num_rows > 0):?>
    <?php while($row=$posts->fetch_assoc()):?>
        <div class="blog-post">
            <h2 class="blog-post-title"><?php echo $row['title'];?></h2>
            <p class="blog-post-meta"> <?php echo $row['created_at'];?> by <a href="#"><?php echo $row['author'];?></a></p>
            <p><?php echo $row['content'];?></p>
        </div><!-- /.blog-post -->
    <?php endwhile;?>
<?php else:?>
    <p>Post not available</p>
<?php endif;?>
<?php include 'includes/footer.php'; ?>