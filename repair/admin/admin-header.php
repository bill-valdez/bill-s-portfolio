<?php 
session_start();
require( '../includes/config.php');
include_once( INCLUDES_PATH . '/functions.php');

//security!  make sure the person viewing this page is logged in
if( $_SESSION['logged_in'] != true ){
	//redirect to login 
	header('Location:login.php');
	//stop loading the rest of this page
	die('You do not have sufficient privileges to view this page');
}
//who is logged in?  this will be needed on all admin pages
$user_id = $_SESSION['user_id'];
?>
<!doctype html>
<html>
<head>
	<title>Admin Panel</title>
	<link rel="stylesheet" type="text/css" href="../css/admin-style.css">

	<script>
	//confirmation screen for permanent actions
	//use with onclick="return confirmAction() in links or buttons"
	function confirmAction(){
		return confirm("This is permanent, are you sure?");
	}
	</script>
</head>
<body class="<?php echo $page; ?>">
	<header>
		<h1>Blog Admin Panel</h1>
		<nav>
			<ul>
				<li class="dashboard"><a href="index.php">Dashboard</a></li>
				<li class="write"><a href="write-post.php">Write Post</a></li>
				<li class="manage"><a href="manage-posts.php">Manage Posts</a></li>
				<li class="comments"><a href="manage-comments.php">Manage Comments</a></li>
				<li class="profile"><a href="edit-profile.php">Edit Profile</a></li>
			</ul>
		</nav>
		<ul class="utilities">
			<li><a href="../" >View Blog</a></li>
			<li><a href="login.php?action=logout" class="warn">Log Out!</a></li>

		</ul>
	</header>
