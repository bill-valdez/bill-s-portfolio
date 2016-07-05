<?php 
//for nav 'selected' states
$page = 'dashboard';
//admin-header has DB connect, and security check
require('admin-header.php'); 

?>
	<main>
		<div class="onehalf panel">
			<h1>Stats</h1>
			<ul>
				<li>You have <?php echo count_posts( $user_id ); ?> Published Posts</li>
				<li>You have <?php echo count_posts( $user_id, 2 ); ?> Post Drafts</li>
				<li>There are <?php echo count_user_comments(  $user_id ); ?> Comments on your posts</li>
			</ul>
		</div>
		<div class="onehalf panel">
			<h1>Trends</h1>
			<ul>
				<li>Most popular post: <?php echo most_popular('post'); ?></li>
				<li>Most popular category: <?php echo most_popular('category'); ?></li>
			</ul>
		</div>
	</main>

<?php include('admin-footer.php'); ?>