<?php include 'includes/header.php'; ?>
<?php
// create db object
$db=new Connection();
// getting id
$id = $_GET['id'];
// category query
$query="SELECT * FROM categories WHERE id=$id";
// run query
$categories=$db->select($query);
    if(isset($_POST['update'])){
    $category=trim(mysqli_real_escape_string($db->conn,$_POST['category']));
    if($category==''){
    $_SESSION['failed']="Please fill in the required fields";
    header("Location:  edit_category.php?id=$id");
    exit();
    }
    else {
    // insert query
    $query = "UPDATE categories
    SET name = '$category'
    WHERE id = $id";
    // run query
    $update_row = $db->update($query);
    $_SESSION['done'] = "Category updated successfully";
    header("Location:  index.php");
    }
    }
    if(isset($_POST['delete'])){
    // delete query
    $query="DELETE FROM categories WHERE id=$id";
    // run query
    $delete_row=$db->delete($query);
    $_SESSION['done']="Category deleted successfully";
    header("Location:  index.php");
    }
    ?>
<?php if($categories->num_rows>0):?>
<?php while($row=$categories->fetch_assoc()):?>
<form role="form" method="post" action="edit_category.php?id=<?php echo $row['id'];?>">
  <div class="form-group">
    <label>Category Name</label>
    <input name="category" value="<?php echo $row['name'];?>" type="text" class="form-control" placeholder="Enter Category">
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
<p>No Categories Available</p>
<?php endif;?>
<?php include 'includes/footer.php'; ?>