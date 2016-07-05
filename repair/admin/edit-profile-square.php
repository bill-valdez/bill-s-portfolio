<?php 
//for nav 'selected' states
$page = 'profile';
//admin-header has DB connect, and security check
require('admin-header.php'); 

//who is logged in?
$user_id = $_SESSION['user_id'];

//parse the image uploader
if($_POST['did_upload']){
	
	//file uploading stuff begins	
	$target_path = "uploads/";
	
	//list of image sizes to generate. make sure a column name in your DB matches up with a key for each size
	$sizes = array(
		'thumb_img' => 150,
		'medium_img' => 300
		);	

	// This is the temporary file created by PHP
	$uploadedfile = $_FILES['uploadedfile']['tmp_name'];
	// Capture the original size of the uploaded image
	list($width,$height) = getimagesize($uploadedfile);
	
	//make sure the width and height exist, otherwise, this is not a valid image
	if($width > 0 AND $height > 0){

		//what kind of image is it
		$filetype = $_FILES['uploadedfile']['type'];

		switch($filetype){
			case 'image/gif':
			// Create an Image from it so we can do the resize
			$src = imagecreatefromgif($uploadedfile);
			break;

			case 'image/pjpeg':
			case 'image/jpg':
			case 'image/jpeg': 
			// Create an Image from it so we can do the resize
			$src = imagecreatefromjpeg($uploadedfile);
			break;

			case 'image/png':
			// Create an Image from it so we can do the resize
			$required_memory = Round($width * $height * $size['bits']);
			$new_limit=memory_get_usage() + $required_memory;
			ini_set("memory_limit", $new_limit);
			$src = imagecreatefrompng($uploadedfile);
			ini_restore ("memory_limit");
			break;		
			
		}
		//for filename
		$randomsha = sha1(microtime());

		//do it!  resize images
		foreach($sizes as $size_name => $target_dimension){
		
			//BIG IMAGE: set up square canvas if original image is larger than target size
			if($width >=  $target_dimension AND $height >= $target_dimension){
				//set canvas size to the target size
				$canvaswidth = $canvasheight = $target_dimension;
				// original image is LANDSCAPE:
				if( $width > $height){
					$crop_width = $crop_height = $height;
					$offsetX = ($width - $height) / 2;
					$offsetY = 0;

				}// original image is PORTRAIT:
				else{
					$crop_width = $crop_height = $width;
					$offsetX = 0;
					$offsetY = ($height - $width) / 2;
				}	
			
			}else{
			//SMALL IMAGE - use the original size
				$canvaswidth=$width;
				$canvasheight=$height;
				$crop_width = $width;
				$crop_height = $height;
				$offsetX = $offsetY= 0;
			}
			//make temporary square canvas
			$destination_canvas=imagecreatetruecolor($canvaswidth,$canvasheight);

			//apply the cropped, resized image to the destination canvas
			imagecopyresampled($destination_canvas,$src,0,0,$offsetX,$offsetY,$canvaswidth,$canvasheight,$crop_width,$crop_height);
			
			//craft the unique filename
			$filename = $target_path.$randomsha.'_'.$size_name.'.jpg';
			//admin-panel relative filepath
			$relative_path = '../'. $filename;
			//save image into the folder
			$didcreate = imagejpeg($destination_canvas,$relative_path,100);
			imagedestroy($destination_canvas);

			//update the user info in the DB
			if($didcreate){
				//delete the old avatar files
				//look up the name of the old file
				$query_old = "SELECT $size_name as avatar 
				FROM users
				WHERE user_id = $user_id
				LIMIT 1";
				$result_old = $db->query($query_old);
				$row_old = $result_old->fetch_assoc();
				//get the file name only
				$old_file = '../'.$row_old['avatar'];
				//delete the file
				@unlink($old_file);
				//END delete old avatar
				$query = "UPDATE users
				SET $size_name = '$filename'
				WHERE user_id = $user_id
				LIMIT 1";
				$result = $db->query($query);	
			}//end if didcreate
		}//end foreach
		
		//delete the large original image from memory
		imagedestroy($src);
		
	}else{//width and height not greater than 0
		$didcreate = false;
	}
	
	//set up success/error feedbac
	if($didcreate) {
		$statusmsg .=  "The file ".  basename( $_FILES['uploadedfile']['name']). 
		" has been uploaded <br />";
	} else{
		$statusmsg .= "There was an error uploading the file, please try again!<br />";
	}	
}//end parser
?>
<main>
	<h1>Edit Your Profile</h1>
	<h2>Change user pic</h2>

	<img src="../<?php show_avatar($user_id); ?>">

	<?php 
	if(isset($statusmsg)){
		echo "<div class='message'>$statusmsg</div>";

	} ?>
	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" 
		enctype="multipart/form-data">

		<label for="uploadedfile">Choose an image:</label>
		<input type="file" name="uploadedfile" id="uploadedfile">

		<input type="submit" value="Upload Image">
		<input type="hidden" name="did_upload" value="1">

	</form>
</main>

<?php include('admin-footer.php'); ?>