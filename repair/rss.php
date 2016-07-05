<?php require('includes/config.php');
include_once('includes/functions.php');

echo '<?xml version="1.0" encoding="utf-8" ?>'; 
?>
<rss version="2.0">
	<channel>
		<title>RSS page</title>
		<link>http://localhost/williamvaldezphp/billstvrepair/blog.php</link>
		<description>A blog about what is happening in tv repair</description>
		<language>en-us</language>
		
		<?php $query = "SELECT *		
						FROM posts
						WHERE is_published = 1";

		$result = $db->query($query);
		while( $row = $result->fetch_assoc() ){ ?>
		<item>
			<title><?php echo $row['title']; ?></title>
			<link>http://localhost/williamvaldezphp/billstvrepair/blog.php?post_id=<?php echo $row['post_id']; ?></link>
			<guid>http://localhost/williamvaldezphp/billstvrepair/blog.php?post_id=<?php echo $row['post_id']; ?></guid>
			<author><?php echo $row['email']; ?> (<?php echo $row['username'] ?>)</author>
			<description><![CDATA[ <?php echo $row['body']; ?> ]]></description>
			<pubDate><?php echo convTimestamp($row['date']); ?></pubDate>
		</item>
		<?php } ?>

	</channel>
</rss>