<?php 
//for nav 'selected' states
$page = 'manage';
//which post are we editing?
$post_id = $_GET['post_id'];

//admin-header has DB connect, and security check
require('admin-header.php'); 



//parse the form!
if($_POST['did_post']){
	//sanitize all fields
	$title = clean_input($_POST['title']);
	$body = clean_input($_POST['body']);
	$category = clean_input($_POST['category']);
	$is_published = clean_input($_POST['is_published']);
	$allow_comments = clean_input($_POST['allow_comments']);

	//validate
	$valid = true;

	//did they leave the title or body blank?
	if( strlen($title) == 0 OR strlen($body) == 0 ){
		$valid = false;
		$message = 'Please fill in all fields';
	}

	//for checkboxes: convert any value other than 1 to 0
	if($is_published != 1){
		$is_published = 0;
	}
	if($allow_comments != 1){
		$allow_comments = 0;
	}

	//if the form passed validation, update the post in the DB
	if($valid){
		$query_addpost = "UPDATE posts
						SET
							title = '$title',
							body = '$body',
							category_id = $category,
							is_published = $is_published,
							allow_comments = $allow_comments
						WHERE post_id = $post_id
						LIMIT 1";

		$result_addpost = $db->query($query_addpost);

		//check to see if it worked
		if($db->affected_rows == 1){
			$message = 'Post successfully saved.';
		}else{
			$message = 'No changes were made to the post.';
		}
	}//end if valid
}//end parser


//PRE-FILL THE FORM. also check to make sure the logged in person wrote it
$query = "SELECT * FROM posts
			WHERE post_id = $post_id
			AND user_id = $user_id
			LIMIT 1";
$result = $db->query($query);
?>
	<main>

		<?php //make sure the post was found
		if( $result->num_rows == 1 ){
			$row = $result->fetch_assoc(); ?>

		<h1>Edit Post</h1>
		<?php 
		if(isset($message)){
			echo "<div class='message'>$message</div>";
		} ?>
		<form action="<?php echo $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'] ?>" method="post">
			<div class="threequarters panel noborder">
				<label for="title">Title:</label>
				<input type="text" name="title" id="title" 
					value="<?php echo $row['title'] ?>" required>

				<label for="body">Body of post:</label>
				<textarea name="body" id="body" required><?php echo $row['body'] ?></textarea>
			</div>

			<div class="onequarter panel">
				<label for="category">Category:</label>
				<select name="category" id="category">
					<?php 
					//get all the categories
					$query_cats = "SELECT * FROM categories";
					$result_cats = $db->query($query_cats);
					if( $result_cats->num_rows >= 1 ){
						while( $row_cats = $result_cats->fetch_assoc() ){
					 ?>
					<option value="<?php echo $row_cats['category_id'] ?>" <?php 
						//IF this post is in this category, make it selected
						if( $row['category_id'] == $row_cats['category_id'] ){
							echo 'selected';
						}
					 ?> ><?php echo $row_cats['name']; ?></option>
					<?php 
						}//end while
					} //end if categories found ?>
				</select>

				<label>
					<input type="checkbox" name="is_published" id="is_published" value="1" <?php checked( $row['is_published'], 1 ); ?>>
					Make this post public?
				</label>

				<label>
					<input type="checkbox" name="allow_comments" id="allow_comments" value="1" <?php checked( $row['allow_comments'], 1 ); ?>>
					Allow people to comment on this post?
				</label>

				<input type="submit" value="Save Post">
			</div>
			<input type="hidden" name="did_post" value="1">
		</form>
		<?php 
		} //end if one post found
		else{
			echo 'You do not have permission to edit this post';
		} ?>
	</main>

<?php include('admin-footer.php'); ?>