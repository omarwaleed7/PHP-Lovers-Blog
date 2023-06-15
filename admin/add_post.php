<?php include 'includes/header.php'; ?>
<?php
// create db object
$db=new Connection();
if(isset($_POST['submit'])){
    $title=trim(mysqli_real_escape_string($db->conn,$_POST['title']));
    $content=trim(mysqli_real_escape_string($db->conn,$_POST['content']));
    $category=$_POST['category'];
    $author=trim(mysqli_real_escape_string($db->conn,$_POST['author']));
    $tags=trim(mysqli_real_escape_string($db->conn,$_POST['tags']));
    if($title==''||$content==''||$category==''||$author==''||$tags==''){
        $_SESSION['failed']="Please fill in the required fields";
        header("Location:  add_post.php");
    }
    else {
        // insert query
        $query = "INSERT INTO posts(title,content,category,author,tags) VALUES('$title','$content','$category','$author','$tags')";
        // run query
        $insert_row = $db->insert($query);
        $_SESSION['done'] = "Post added successfully";
        header("Location:  index.php");
    }
}
// category query
$query="SELECT * FROM categories";
// run query
$categories=$db->select($query);
?>
<form role="form" method="post" action="add_post.php">
  <div class="form-group">
    <label>Post Title</label>
    <input name="title" type="text" class="form-control" placeholder="Enter Title">
  </div>
  <div class="form-group">
    <label>Post Body</label>
    <textarea name="content" class="form-control" placeholder="Enter Post Body"></textarea>
  </div>
  <div class="form-group">
    <label>Category</label>
    <select name="category" class="form-control">
		<?php while($row=$categories->fetch_assoc()):?>
		<option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
        <?php endwhile;?>
    </select>
  </div>
  <div class="form-group">
    <label>Author</label>
    <input name="author" type="text" class="form-control" placeholder="Enter Author Name">
  </div>
  <div class="form-group">
    <label>Tags</label>
    <input name="tags" type="text" class="form-control" placeholder="Enter Tags">
  </div>
  <div>
	<input name="submit" type="submit" class="btn btn-default" value="Submit" />
	<a href="index.php" class="btn btn-default">Cancel</a>
  </div>
  <br>
</form>

<?php include 'includes/footer.php'; ?>