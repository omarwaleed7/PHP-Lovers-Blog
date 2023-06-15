<?php include 'includes/header.php'; ?>
<?php
// create db object
$db=new Connection();
if(isset($_POST['submit'])){
    $category=trim(mysqli_real_escape_string($db->conn,$_POST['name']));
    if($category==''){
        $_SESSION['failed']="Please fill in the required fields";
        header("Location:  add_category.php");
    }
    else {
        // insert query
        $query = "INSERT INTO categories(name) VALUES('$category')";
        // run query
        $insert_row = $db->insert($query);
        $_SESSION['done'] = "Category added successfully";
        header("Location:  index.php");
    }
}
?>
<form role="form" method="post" action="add_category.php">
  <div class="form-group">
    <label>Category Name</label>
    <input name="name" type="text" class="form-control" placeholder="Enter Category">
  </div>
  <div>
  <input name="submit" type="submit" class="btn btn-default" value="Submit" />
  <a href="index.php" class="btn btn-default">Cancel</a>
  </div>
  <br>
</form>
<?php include 'includes/footer.php'; ?>