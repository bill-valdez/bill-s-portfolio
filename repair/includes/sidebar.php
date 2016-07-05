<aside id="sidebar">
	<section>
		<h1>Latest Posts</h1>
		<?php //get the 3 latest published post titles and IDs
		$query_latest = "SELECT title, post_id
					FROM posts
					WHERE is_published = 1
					ORDER BY date DESC
					LIMIT 3";
		$result_latest = $db->query($query_latest); 
		//check to see if any rows are found
		if( $result_latest->num_rows >= 1 ){ ?>
		<ul>
			<?php while( $row_latest = $result_latest->fetch_assoc() ){ ?>
			<li><a href="single.php?post_id=<?php echo $row_latest['post_id']; ?>">
				<?php echo $row_latest['title']; ?> 
				<?php count_comments( $row_latest['post_id'], false ); ?>
			</a></li>
			<?php } //end while posts ?>
		</ul>
		<?php }else{
			echo 'Sorry, no posts yet.';
		} ?>
	</section>
	<section>
		<h1>Post Categories</h1>
		<?php //get all the categories that have posts in them and count the number of posts in each 
		$query_cats = "SELECT posts.category_id, categories.name, COUNT(*) as total 
						FROM posts, categories
						WHERE posts.category_id = categories.category_id
						GROUP BY category_id";
		$result_cats = $db->query($query_cats);
		if($result_cats->num_rows >= 1){?>
		<ul>
			<?php while($row_cats = $result_cats->fetch_assoc()){ ?>
			<li><a href="category.php?cat_id=<?php echo $row_cats['category_id'] ?>"><?php echo $row_cats['name'] ?> (<?php echo $row_cats['total'] ?>)</a></li>
			<?php } //end while categories ?>
		</ul>
		<?php } //end if there are categories ?>
	</section>
	<section>
		<h1>Links</h1>
		<?php //get all the links in Random order
		$query_links = "SELECT * 
						FROM links
						ORDER BY RAND()";
		$result_links = $db->query($query_links);
		if($result_links->num_rows >= 1){?>
		<ul>
			<?php while($row_links = $result_links->fetch_assoc()){ ?>
			<li><a href="<?php echo $row_links['url'] ?>"><?php echo $row_links['title'] ?> </a></li>
			<?php } //end while links ?>
		</ul>
		<?php } //end if there are links ?>
	</section>
	<section>
		<ul>
			<?php if($_SESSION['logged_in']){ ?>
			<li><a href="admin/">Admin Panel</a></li>
			<?php }else{ ?>
			<li><a href="admin/index.php">Log in to your Admin Panel</a></li>
			<li><a href="admin/register.php">Register as a new user</a></li>
			<?php } ?>
		</ul>
	</section>
</aside>