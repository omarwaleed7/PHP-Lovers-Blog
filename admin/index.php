<?php include 'includes/header.php'; ?>
<?php
// create db object
$db=new Connection();
// posts query
$query="SELECT posts.*, categories.name FROM posts JOIN categories ON posts.category=categories.id ORDER BY id DESC";
// run query
$posts=$db->select($query);
// categories query
$query="SELECT * FROM categories ORDER BY id DESC";
// run query
$categories=$db->select($query);
?>
<?php if($posts->num_rows>0):?>
<table class="table table-striped">
	<tr>
		<th>Post ID#</th>
		<th>Post Title</th>
		<th>Category</th>
		<th>Author</th>
		<th>Date</th>
	</tr>
    <?php while($row=$posts->fetch_assoc()):?>
	<tr>
		<td><?php echo $row['id'];?></td>
        <td><a href="edit_post.php?id=<?php echo $row['id'];?>"><?php echo $row['title'];?></a></td>
        <td><?php echo $row['name'];?></td>
        <td><?php echo $row['author'];?></td>
        <td><?php echo date_formatting($row['created_at']);?></td>
	</tr>
    <?php endwhile;?>
</table>
<?php else:?>
<p>No Posts Available</p>
<?php endif;?>
<?php if ($categories->num_rows > 0): ?>?>
<table class="table table-striped">
	<tr>
		<th>Category ID#</th>
		<th>Category Name</th>
	</tr>
    <?php while($row=$categories->fetch_assoc()):?>
	<tr>
		<td><?php echo $row['id'];?></td>
        <td><a href="edit_category.php?id=<?php echo $row['id'];?>"><?php echo $row['name'];?></a></td>
	</tr>
    <?php endwhile;?>
</table>
<?php else:?>
<p>No Categories Available</p>
<?php endif;?>
<?php include 'includes/footer.php'; ?>	
	     