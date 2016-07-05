<?php include "includes/header.php"; ?>
			<img src="images/blog.jpg">
			<h2>Blog</h2>
			<?php $query="SELECT *
							FROM posts
							WHERE is_published = 1";
			// Run the query. hold onto the results in a variable
			$result = $db->query( $query );
			// Check to see if one or more rows were found
			if ($result->num_rows >=1) {
				while( $row = $result->fetch_assoc() ){
				?>

			<article>
				<h2><?php echo $row['title'] ?></h2>
				<div>By <?php echo $row['username'] ?> |
					<?php echo convert_date( $row['date']) ?> |
					In the category <?php echo $row['category'] ?>
				</div>

				<p><?php echo $row['body'] ?></p>

			</article>
			<?php 
					}//end while loop
					}//end if rows found
				else{
					echo 'Sorry, no posts to show';
				}
			 ?>	
			<div class="base">
				<ul>
					<li><img src="images/piggybank.jpg" alt="Piggy bank"></li>
					<li><a href="register.php"><img src="images/chat.jpg" alt="Chat"></a></li>
					<li><a href="tvparts.php"><img src="images/tv.jpg" alt="T.V."></a></li>
				</ul>
			</div>
			<div class="logo">
				<ul>
					<li><img src="images/samsung.png" alt="Samsung"></li>
					<li><img src="images/mitsubishi.png" alt="Mitsubishi"></li>
					<li><img src="images/sony.png" alt="Sony"></li>
					<li><img src="images/sharp.png" alt="Sharp"></li>				
					<li><img src="images/pioneer.png" alt="Pioneer"></li>
				</ul>
			</div>
		</main>
		
	</div><!-- end cf -->
	<?php include "includes/footer.php"; ?>