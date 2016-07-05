<?php
//create new connection to the DB
//db host, username, pass, db name

if($_SERVER['HTTP_HOST'] == 'localhost'){
	$db_name = 'billstvrepair';
	$db_user = 'tvbill';
	$db_user_pass = 'ZPjGDKNc9q3LbKUT';
}else{

	$db_name = 'bill_billstvrepair';
	$db_user = 'bill_tvbill';
	$db_user_pass = 'ZPjGDKNc9q3LbKUT';
}
$db = new mysqli( 'localhost', $db_user , $db_user_pass , $db_name );

//handle errors, if any
if( $db->connect_errno > 0 ){
	//stop the rest of the page from loading, and show a message instead
	die('Unable to connect to Database.');
}
//define file path constants
//on xampp , Do
define("SITE_PATH",$_SERVER['DOCUMENT_ROOT'] . 'http://localhost/williamvaldezphp/billstvrepair/');
//Define Constants for file path management
define("INCLUDES_PATH", $_SERVER["DOCUMENT_ROOT"] . '/williamvaldezphp/billstvrepair/includes/');
