<?php include 'includes/header.php'; ?>
<?php
// create db object
$db=new Connection();
// getting id
$id = $_GET['id'];
// posts query
$query="SELECT * FROM posts WHERE id=$id";
// run query
$posts=$db->select($query);
// category query
$query="SELECT * FROM categories";
// run query
$categories=$db->select($query);
if(isset($_POST['update'])){
    $title=trim(mysqli_real_escape_string($db->conn,$_POST['title']));
    $content=trim(mysqli_real_escape_string($db->conn,$_POST['content']));
    $category=$_POST['category'];
    $author=trim(mysqli_real_escape_string($db->conn,$_POST['author']));
    $tags=trim(mysqli_real_escape_string($db->conn,$_POST['tags']));
    if($title==''||$content==''||$category==''||$author==''||$tags==''){
        $_SESSION['failed']="Please fill in the required fields";
        header("Location:  edit_post.php?id=$id");
        exit();
    }
    else {
        // insert query
        $query = "UPDATE posts 
					SET 
					title = '$title',
					content = '$content',
					category = $category,
					author = '$author',
					tags = '$tags' 
					WHERE id = $id";
        // run query
        $update_row = $db->update($query);
        $_SESSION['done'] = "Post updated successfully";
        header("Location:  index.php");
    }
}
if(isset($_POST['delete'])){
    // delete query
    $query="DELETE FROM posts WHERE id=$id";
    // run query
    $delete_row=$db->delete($query);
    $_SESSION['done']="Post deleted successfully";
    header("Location:  index.php");
}
?>
<?php if($posts->num_rows>0):?>
    <?php while($post=$posts->fetch_assoc()):?>
<form role="form" method="post" action="edit_post.php?id=<?php echo $id;?>">
  <div class="form-group">
    <label>Post Title</label>
    <input name="title" value="<?php echo $post['title'];?>" type="text" class="form-control" placeholder="Enter Title">
  </div>
  <div class="form-group">
    <label>Post Body</label>
    <textarea name="content" class="form-control" placeholder="Enter Post Body"><?php echo $post['content'];?></textarea>
  </div>
  <div class="form-group">
    <label>Category</label>
    <select name="category" class="form-control">
        <?php while($row=$categories->fetch_assoc()):?>
        <?php if($row['id']==$post['category']):?>
		<option value="<?php echo $row['id'];?>" selected><?php echo $row['name'];?></option>
        <?php else:?>
        <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
        <?php endif;?>
        <?php endwhile;?>
	</select>
  </div>
  <div class="form-group">
    <label>Author</label>
    <input name="author" value="<?php echo $post['author'];?>" type="text" class="form-control" placeholder="Enter Author Name">
  </div>
  <div class="form-group">
    <label>Tags</label>
    <input name="tags" value="<?php echo $post['tags'];?>" type="text" class="form-control" placeholder="Enter Tags">
  </div>
  <div>
	<input name="update" type="submit" class="btn btn-default" value="Submit" />
	<a href="index.php" class="btn btn-default">Cancel</a>
	<input name="delete" type="submit" class="btn btn-danger" value="Delete" />
  </div>
  <br>
</form>
    <?php endwhile;?>
<?php else:?>
    <p>No Posts Available</p>
    <?php endif;?>
<?php include 'includes/footer.php'; ?>