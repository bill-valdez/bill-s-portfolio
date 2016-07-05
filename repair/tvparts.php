<?php include "includes/header.php";
$partsname = $_GET['partsname'];
$partnum = $_GET['partnum'];

 ?>


<body class="cf">
	
			<img src="images/tvparts.jpg">
			
			<ul id="partname">
				<li><form action="tvparts.php" method="get" id="searchform">
					<input type="search" name="partsname" id="phrase" value="<?php echo $partsname; ?>">
					<input type="submit" value="Part Name">
				</form></li>
			</ul>

			<ul id="partnumber">
				<li><form action="tvparts.php" method="get" id="searchform">
					<input type="search" name="partnum" id="phrase" value="<?php echo $partnum; ?>">
					<input type="submit" value="Part Number">
				</form></li>
			</ul>
			<h2>Part Search</h2>
			<?php $query="SELECT *
							FROM parts";
			
				if($partsname){
					$query.= " WHERE partsname = '$partsname'";

				}
				if($partnum){
					$query.= " WHERE partnum = '$partnum'";

				}
							

				$query.=		" ORDER BY partsname ASC";
				
				$result=$db->query($query);
				 if ($result->num_rows>=1) {
				 	
				 ?>
			<table>
				<tr>
					<th>Part Name</th>
					<th>Part Number</th>
					<th>Vendor</th>
					<th>Price</th>
					<th>Image</th>
					<th>Inventory</th>
				</tr>

				<?php while ($row=$result->fetch_assoc()) {
					# code...
				 ?>
				<tr>
					<td><?php echo $row['partsname'] ?></td>
					<td><?php echo $row['partnum'] ?></td>
					<td><?php echo $row['vendor'] ?></td>
					<td><?php echo $row['price'] ?></td>
					<td><img src="<?php echo $row['image'] ?>"></td>
					<td><?php echo $row['inventory'] ?></td>
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
	<footer id="pageFoot">
		<h4> Copyright - strategicwebdesigns.net </h4>
	</footer>
</body>

</html>
