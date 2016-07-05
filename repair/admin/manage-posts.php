<?php 
//for nav 'selected' states
$page = 'manage';
//admin-header has DB connect, and security check
require('admin-header.php'); ?>
	<main>
		<h1>Manage Your Posts</h1>
		<?php //get all the posts by the logged in user, newest first
		$query = "SELECT post_id, title, is_published
					FROM posts
					WHERE user_id = $user_id
					ORDER BY date DESC";
		$result = $db->query($query);
		if( $result->num_rows >= 1 ){ ?>
		<ul>
			<?php while( $row = $result->fetch_assoc() ){ ?>
			<li>
				<a href="edit-post.php?post_id=<?php echo $row['post_id'] ?>">
				<?php echo $row['title'];?>
				</a>
				<?php 
				if(! $row['is_published']){
					echo '<i> - Draft</i>';
				} ?>
			</li>
			<?php } //end while ?>
		</ul>
		<?php 
		}else{
			echo 'You haven\'t written any posts yet';
		} ?>
	</main>

<?php include('admin-footer.php'); ?>