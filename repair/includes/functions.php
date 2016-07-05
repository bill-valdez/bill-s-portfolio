<?php
//convert datetime format to human-friendly format
function convert_date($dateR){
	$engMon=array('January','February','March','April','May','June','July','August','September','October','November','December',' ');
	$l_months='January:February:March:April:May:June:July:August:September:October:November:December';
	$dateFormat='F j, Y';
	$months=explode (':', $l_months);
	$months[]='&nbsp;';
	$dfval=strtotime($dateR);
	$dateR=date($dateFormat,$dfval);
	$dateR=str_replace($engMon,$months,$dateR);
	return $dateR;
}

//Count the number of comments on ANY post!
function count_comments( $post_id, $long_content = true ){
	//use the $db variable that we created in a different file
	global $db;
	$query_count = "SELECT COUNT(*) AS total
					FROM comments
					WHERE post_id = $post_id";
	$result_count = $db->query($query_count);
	//no looping because COUNT only returns ONE row
	$row_count = $result_count->fetch_assoc();

	//if the parameter is set to show long content, show it in english, otherwise use numbers
	if( $long_content ){
		//grammar!
		if($row_count['total'] == 0){
			echo 'No comments yet.';
		}elseif($row_count['total'] == 1){
			echo 'One comment.';
		}else{
			echo $row_count['total'] . ' comments';
		}
	}else{ //short content
		echo '(' . $row_count['total'] . ')';
	}
}


//sanitize form input for DB
function clean_input( $input ){
	global $db;
	return mysqli_real_escape_string( $db, strip_tags(trim($input)) );
}

//convert mysql datetime to RFC-822 date for RSS
function convTimestamp($date){
	$year   = substr($date,0,4);
	$month  = substr($date,5,2);
	$day    = substr($date,8,2);
	$hour   = substr($date,11,2);
	$minute = substr($date,14,2);
	$second = substr($date,17,2);
	$stamp =  date('D, d M Y H:i:s O', mktime($hour, $min, $sec, $month, $day, $year));
	return $stamp;
}

//shorten a long piece of content, preserving words
function shorten($str, $length, $minword = 3){
    $sub = '';
    $len = 0;   
    foreach (explode(' ', $str) as $word){
        $part = (($sub != '') ? ' ' : '') . $word;
        $sub .= $part;
        $len += strlen($part);       
        if (strlen($word) > $minword && strlen($sub) >= $length){
            break;
        }
    }   
    return $sub . (($len < strlen($str)) ? '<span class="ellipses">&hellip;</span>' : '');
}


//simplify sticky checkboxes
function checked($value, $expected){
	if($value == $expected){
		echo 'checked="checked"';
	}
}

/**
 *  Count the number of total comments for any user's posts 
 * @param $user_id int - provide any user id
 * @param $status int - OPTIONAL. What kind of comments are we counting?
 *						1 => DEFAULT. only count approved comments
 *						2 => only count unapproved comments
 *						3 => count all comments on this user's posts
 * @return int - Number of comments
 */
function count_user_comments( $user_id ){
	global $db;
	$query = "SELECT COUNT(*) AS total
			FROM comments
			LEFT JOIN posts 
			ON posts.post_id = comments.post_id
			WHERE posts.user_id = $user_id";
	$result = $db->query($query);
	$row = $result->fetch_assoc();
	return $row['total'];
}
/**
 * Return the number of posts for any user.
 *
 * @param $user_id int - provide any user id
 * @param $status int - OPTIONAL. What kind of posts are we counting?
 *						1 => DEFAULT. only count public posts
 *						2 => only count private posts
 *						3 => count all posts
 * @return int - total number of posts
 */
function count_posts(  $user_id, $status = 1 ){
	global $db;
	$query = "SELECT COUNT(*) AS total
				FROM posts
				WHERE user_id = $user_id";
	//depending on the status argument, refine the query to get the right posts
	if( 1 == $status ):
		$query .= ' AND is_published = 1'; 
	elseif( 2 == $status ):
		$query .= ' AND is_published = 0';
	endif;
	//run it!
	$result = $db->query($query);
	$row = $result->fetch_assoc();
	return $row['total'];
}

/**
 * Return the title of the most popular post or category
 * @param $type - string. 'post' or 'catgegory'
 * @return string - title or name of post/category
 */
function most_popular( $type='post' ){
	global $db;
	switch($type){
		case 'category': 
		$query = "SELECT categories.name AS title, COUNT(*) as total
					FROM posts, categories
					WHERE posts.category_id = categories.category_id
					GROUP BY posts.category_id
					ORDER BY total DESC
					LIMIT 1";
		break;
		default: //most popular post by comments
		$query = "SELECT posts.title, COUNT(*) as total
					FROM posts, comments
					WHERE posts.post_id = comments.post_id
					GROUP BY comments.post_id
					ORDER BY total DESC
					LIMIT 1";

	}//end switch
	$result = $db->query($query);
	$row = $result->fetch_assoc();
	return $row['title'];
}


//Show any user's avatar
function show_avatar( $user_id, $size = 'thumb_img' ){
	global $db;
	$query = "SELECT $size AS avatar
				FROM users
				WHERE user_id = $user_id
				LIMIT 1";
	$result = $db->query($query);
	//check to make sure the user was found
	if( $result->num_rows == 1 ){
		$row = $result->fetch_assoc();
		//make sure avatar is not blank
		if( $row['avatar'] == '' ){
			//generic avatar
			echo 'images/default-user.png';
		}else{
			echo $row['avatar'];
		}
	}
}

// -------------------------------------------------------------------------------
//output an array as an unordered list
function bv_array_list($array){
	//if array exists, display it
	if (is_array($array)) {
		
	
echo '<ul>';
//output one list item per thing in the array
foreach ($array as $item) {
	echo '<li>'.$item.'</li>';
	
}
echo '</ul>';
	}
}

//display one inline error message(use this next to a field)
function bv_inline_error($array,$item){
	//check to make sure the item exsists in the array
	if (isset($array[$item])) {
		echo '<div class="inline-error">'.$array[$item].'</div>';
	}
}
//no close php!