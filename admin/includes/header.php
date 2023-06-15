<?php include '../config/config.php';?>
<?php include'../libraries/database.php'; ?>
<?php include '../helpers/format_helper.php';?>
<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Area</title>
    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="../css/custom.css" rel="stylesheet">
  </head>

  <body>

    <div class="blog-masthead">
      <div class="container">
        <nav class="blog-nav">
          <a class="blog-nav-item active" href="index.php">Dashboard</a>
          <a class="blog-nav-item" href="add_post.php">Add Post</a>
		  <a class="blog-nav-item" href="add_category.php">Add Category</a>
		  <a class="blog-nav-item pull-right" href="../index.php">Visit Blog</a>
        </nav>
      </div>
    </div>
    <div class="container">

      <div class="blog-header">
		<h2>Admin Area</h2>
      </div>
      <div class="row">
        <div class="col-sm-12 blog-main">
            <?php if(isset($_SESSION['done'])):?>
            <div class="alert alert-success"><?php echo $_SESSION['done'];
            unset($_SESSION['done']);?></div>
        <?php endif;?>
        <?php if(isset($_SESSION['failed'])):?>
            <div class="alert alert-danger"><?php echo $_SESSION['failed'];
            unset($_SESSION['failed']);?></div>
        <?php endif;?>