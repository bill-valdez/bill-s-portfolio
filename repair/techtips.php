<?php include "includes/header.php"; 
$make = $_GET['make'];
$model = $_GET['model'];

?>


<body class="cf">
	
			<img src="images/techtips.jpg">

			<ul id="partname">
				<li><form action="techtips.php" method="get" id="searchform">
					<input type="search" name="make" id="phrase" value="<?php echo $make; ?>">
					<input type="submit" value="Make">
				</form></li>
			</ul>

			<ul id="partnumber">
				<li><form action="techtips.php" method="get" id="searchform">
					<input type="search" name="model" id="phrase" value="<?php echo $model; ?>">
					<input type="submit" value="Model Number">
				</form></li>
			</ul>
			<h2>Tech Tips</h2>
			<?php $query="SELECT *
							FROM techtips";
			
				if($make){
					$query.= " WHERE make = '$make'";

				}
				if($model){
					$query.= " WHERE model = '$model'";

				}
							

				$query.=		" ORDER BY make ASC";
				$result=$db->query($query);
				 if ($result->num_rows>=1) {
				 	
				 ?>
			<table>
				<tr>
					<th>Make</th>
					<th>Model</th>
					<th>Problem</th>
					<th>Solution</th>
				</tr>

				<?php while ($row=$result->fetch_assoc()) {
					# code...
				 ?>
				<tr>
					<td><?php echo $row['make'] ?></td>
					<td><?php echo $row['model'] ?></td>
					<td><?php echo $row['problem'] ?></td>
					<td><?php echo $row['solution'] ?></td>
				</tr>
				<?php } ?>
			</table>
			<?php } ?>
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
