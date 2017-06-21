<?php

define('DB_NAME','book_management');
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');

define('COMMENT_LIMITED', 2);

//connect database

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if($conn->connect_error){
    die("Error: " . $conn->connect_error);
}

function get_book_id_from_comment_id($comment_id){
	global $conn;
	$sql = "SELECT book_id from book_comment where id='$comment_id'";
	$result = $conn->query($sql);
	if($result->num_rows > 0){
		$row = $result->fetch_assoc();
		return $row['book_id'];
	}
	return 0;

}

function get_book_from_book_id($book_id){
	global $conn;
	$sql = "SELECT * FROM book where id='$book_id'";
	$result = $conn->query($sql);
	if($result->num_rows > 0){
		$row = $result->fetch_assoc();
		return $row;
	}
	return 0;
}

function get_comment_from_comment_id($comment_id){
	global $conn;
	$sql = "SELECT * FROM book_comment where id='$comment_id'";
	$result = $conn->query($sql);
	if($result->num_rows > 0){
		$row = $result->fetch_assoc();
		return $row;
	}
	return 0;
}