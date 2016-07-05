<?php 
//for nav 'selected' states
$page = 'comments';
//admin-header has DB connect, and security check
require('admin-header.php'); 

//parse 'delete' buttons
if( $_GET['action'] == 'delete' ){
	//which comment?
	$comment_id = $_GET['comment_id'];
	$query_del = "DELETE FROM comments
					WHERE comment_id = $comment_id
					LIMIT 1";
	$result_del = $db->query($query_del);
	//display a message if the delete was successful
	if($db->affected_rows == 1){
		$message = 'Comment successfully deleted.';
	}
}
?>
	<main>
		<h1>Manage comments on your posts</h1>

		<?php
		//display feedback after deleting a comment
		if( isset($message) ){
			echo "<div class=\"message\">$message</div>";
		}

		//get all the comments on the logged in person's posts, grouped by post
		$query = "SELECT posts.title, comments.name, comments.body, comments.comment_id
					FROM posts, comments
					WHERE posts.post_id = comments.post_id
					AND posts.user_id = $user_id
					ORDER BY posts.date DESC, comments.date ASC";
		$result = $db->query($query);
		if( $result->num_rows >= 1 ){
		 ?>
		<ul>
			<?php while( $row = $result->fetch_assoc() ){ ?>
			<li>
				<a href="?action=delete&amp;comment_id=<?php echo $row['comment_id']; ?>" class="warn button" onclick="return confirmAction()">Delete</a> 
				<i><b><?php echo $row['name']; ?></b> 
				commented on <?php echo $row['title']; ?>
				:</i> 
				<b><?php echo $row['body']; ?> </b>
				
			</li>
			<?php }//end while ?>
		</ul>
		<?php 
		}else{
			echo 'Your posts do not have any comments yet.';
		} ?>

	</main>

<?php include('admin-footer.php'); ?>