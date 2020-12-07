BlG WEBSITE

<?php 
	session_start();
	// connect to database
	$conn = mysqli_connect("localhost", "root", "", "complete-blog-php");

	if (!$conn) {
		die("Error connecting to database: " . mysqli_connect_error());
	}
    // define global constants
	define ('ROOT_PATH', realpath(dirname(__FILE__)));
	define('BASE_URL', 'http://localhost/complete-blog-php/');
?>
<!-- The first include should be config.php -->
<?php require_once('config.php') ?>
<?php require_once( ROOT_PATH . '/includes/public_functions.php') ?>
<?php require_once( ROOT_PATH . '/includes/registration_login.php') ?>

<!-- Retrieve all posts from database  -->
<?php $posts = getPublishedPosts(); ?>

<?php require_once( ROOT_PATH . '/includes/head_section.php') ?>
	<title>Te Blog | Home </title>
</head>
<body>
	<!-- container - wraps whole page -->
	<div class="container">
		<!-- navbar -->
		<?php include( ROOT_PATH . '/includes/navbar.php') ?>
		<!-- // navbar -->

		<!-- banner -->
		<?php include( ROOT_PATH . '/includes/banner.php') ?>
		<!-- // banner -->

		<!-- Page content -->
		<div class="content">
			<h2 class="content-title">Recent Articles</h2>
			<hr>
			<hr>
			<!-- more content still to come here ... -->

			<?php foreach ($posts as $post): ?>
				<div class="post" style="margin-left: 0px;">
					<img src="<?php echo BASE_URL . '/static/images/' . $post['image']; ?>" class="post_image" alt="">
			        <!-- Added this if statement... -->
					<?php if (isset($post['topic']['name'])): ?>
						<a
							href="<?php echo BASE_URL . 'filtered_posts.php?topic=' . $post['topic']['id'] ?>"
							class="btn category">
							<?php echo $post['topic']['name'] ?>
						</a>
					<?php endif ?>

					<a href="single_post.php?post-slug=<?php echo $post['slug']; ?>">
						<div class="post_info">
							<h3><?php echo $post['title'] ?></h3>
							<div class="info">
								<span><?php echo date("F j, Y ", strtotime($post["created_at"])); ?></span>
								<span class="read_more">Read more...</span>
							</div>
						</div>
					</a>
				</div>
			<?php endforeach ?>

		</div>
		<!-- // Page content -->

		<!-- footer -->
		<?php include( ROOT_PATH . '/includes/footer.php') ?>
		<!-- // footer -->
<?php  include('config.php'); ?>
<?php  include('includes/registration_login.php'); ?>
<?php  include('includes/head_section.php'); ?>
	<title>LifeBlog | Sign in </title>
</head>
<body>
<div class="container">
	<!-- Navbar -->
	<?php include( ROOT_PATH . '/includes/navbar.php'); ?>
	<!-- // Navbar -->

	<div style="width: 40%; margin: 20px auto;">
		<form method="post" action="login.php" >
			<h2>Login</h2>
			<?php include(ROOT_PATH . '/includes/errors.php') ?>
			<input type="text" name="username" value="<?php echo $username; ?>" value="" placeholder="Username">
			<input type="password" name="password" placeholder="Password">
			<button type="submit" class="btn" name="login_btn">Login</button>
			<p>
				Not yet a member? <a href="register.php">Sign up</a>
			</p>
		</form>
	</div>
</div>
<!-- // container -->

<!-- Footer -->
	<?php include( ROOT_PATH . '/includes/footer.php'); ?>
<!-- // Footer -->
<?php include('config.php'); ?>
<?php include('includes/public_functions.php'); ?>
<?php include('includes/head_section.php'); ?>
<?php 
	// Get posts under a particular topic
	if (isset($_GET['topic'])) {
		$topic_id = $_GET['topic'];
		$posts = getPublishedPostsByTopic($topic_id);
	}
?>
	<title>LifeBlog | Home </title>
</head>
<body>
<div class="container">
<!-- Navbar -->
	<?php include( ROOT_PATH . '/includes/navbar.php'); ?>
<!-- // Navbar -->
<!-- content -->
<div class="content">
	<h2 class="content-title">
		Articles on <u><?php echo getTopicNameById($topic_id); ?></u>
	</h2>
	<hr>
	<?php foreach ($posts as $post): ?>
		<div class="post" style="margin-left: 0px;">
			<img src="<?php echo BASE_URL . '/static/images/' . $post['image']; ?>" class="post_image" alt="">
			<a href="single_post.php?post-slug=<?php echo $post['slug']; ?>">
				<div class="post_info">
					<h3><?php echo $post['title'] ?></h3>
					<div class="info">
						<span><?php echo date("F j, Y ", strtotime($post["created_at"])); ?></span>
						<span class="read_more">Read more...</span>
					</div>
				</div>
			</a>
		</div>
	<?php endforeach ?>
</div>
<!-- // content -->
</div>
<!-- // container -->

<!-- Footer -->
	<?php include( ROOT_PATH . '/includes/footer.php'); ?>
<!-- // Footer -->
<?php 
	session_start();
	session_unset($_SESSION['user']);
	session_destroy();
	header('location: index.php');
?>
<?php
session_start();
      $code = mt_rand(000000,999999);
      $_SESSION['code'] = $code;
      $username = $_SESSION['username'] = $_POST['username'];
      $_SESSION['email'] = $_POST['email'];
      $_SESSION['password_1'] = $_POST['password_1'];
      $_SESSION['password_2'] = $_POST['password_2'];
      $to_id = $_POST['email'];
      $message = "Hey ".$username.",\nYour Verification Code is : ".$code;
      $subject = "User Verification Code At Blogger";
		  $headers = 'From: flutterdev0@gmail.com' . "\r\n" ;
		    if(mail($to_id,$subject,$message,$headers))
		    {
            echo $_SESSION['code'];
			       echo "Mail Sent";
             echo "<form action='includes/registration_login_by_user.php' method='post' >";
             echo "<input type='number' name='verify'/>";
             echo "<input type='submit' value='submit' />";
             echo "</form>";
		    }
		    else
		    {
			       echo "Mail Send failed";
             echo "<script type='text/javascript'> window.location.replace(\"index.php\") </script>";
		    }
	?>
</script>
<?php  include('config.php'); ?>
<!-- Source code for handling registration and login -->
<?php  include('includes/registration_login.php'); ?>

<?php include('includes/head_section.php'); ?>

<title>LifeBlog | Sign up </title>
</head>
<body>
<div class="container">
	<!-- Navbar -->
		<?php include( ROOT_PATH . '/includes/navbar.php'); ?>
	<!-- // Navbar -->

	<div style="width: 40%; margin: 20px auto;">
		<form method="post" action="register.php" >
			<h2>Register on LifeBlog</h2>
			<?php include(ROOT_PATH . '/includes/errors.php') ?>
			<input  type="text" name="username" value="<?php echo $username; ?>"  placeholder="Username">
			<input type="email" name="email" value="<?php echo $email ?>" placeholder="Email">
			<input type="password" name="password_1" placeholder="Password">
			<input type="password" name="password_2" placeholder="Password confirmation">
			<button type="submit" class="btn" name="reg_user">Register</button>
			<p>
				Already a member? <a href="login.php">Sign in</a>
			</p>
		</form>
	</div>
</div>
<!-- // container -->
<!-- Footer -->
	<?php include( ROOT_PATH . '/includes/footer.php'); ?>
<!-- // Footer -->
<?php  include('config.php'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php  include('includes/public_functions.php'); ?>
<?php
	if (isset($_GET['post-slug'])) {
		$post = getPost($_GET['post-slug']);
	}
	$topics = getAllTopics();
?>
<?php include('includes/head_section.php'); ?>
<title> <?php echo $post['title'] ?> | LifeBlog</title>
</head>
<body>
<div class="container">
	<!-- Navbar -->
		<?php include( ROOT_PATH . '/includes/navbar.php'); ?>
	<!-- // Navbar -->

	<div class="content" >
		<!-- Page wrapper -->
		<div class="post-wrapper">
			<!-- full post div -->
			<div class="full-post-div">
			<?php if ($post['published'] == false): ?>
				<h2 class="post-title">Sorry... This post has not been published</h2>
			<?php else: ?>
				<h2 class="post-title"><?php echo $post['title']; ?></h2>
				<div class="post-body-div">
					<?php
								echo html_entity_decode($post['body']);
								$conn=mysql_connect('localhost', 'root', '');
  							mysql_select_db('complete-blog-php', $conn);
								$bd = $post['body'];
								$vw = ++$post['views'];
								$sql = "UPDATE posts SET views = $vw where body='$bd'";
								$res = mysql_query($sql);
					 ?>
					 <button class="btn btn-primary" onclick="alert('You Liked The Post')" style="float:right;margin-top:215px"><i onclick="<?php
 								echo html_entity_decode($post['body']);
 								$conn=mysql_connect('localhost', 'root', '');
   							mysql_select_db('complete-blog-php', $conn);
 								$bd = $post['body'];
 								$vw = ++$post['likes'];
 								$sql = "UPDATE posts SET likes = $vw where body='$bd'";
 								$res = mysql_query($sql);
 					 ?>" class="fa fa-thumbs-up" ></i> Like</button>
				</div>
			<?php endif ?>
			</div>
			<!-- // full post div -->

			<!-- comments section -->
			<!--  coming soon ...  -->
		</div>
		<!-- // Page wrapper -->

		<!-- post sidebar -->
		<div class="post-sidebar">
			<div class="card">
				<div class="card-header">
					<h2>Topics</h2>
				</div>
				<div class="card-content">
					<?php foreach ($topics as $topic): ?>
						<a
							href="<?php echo BASE_URL . 'filtered_posts.php?topic=' . $topic['id'] ?>">
							<?php echo $topic['name']; ?>
						</a>
					<?php endforeach ?>
				</div>
			</div>
		</div>
		<!-- // post sidebar -->
	</div>
</div>
<!-- // content -->

<?php include( ROOT_PATH . '/includes/footer.php'); ?>