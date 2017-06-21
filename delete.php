<?php
include('connect.php');
global $conn;
if(isset($_GET['book_id'])){
	$book_id = $_GET['book_id'];

	$sql1 = "DELETE FROM book_comment WHERE book_comment.book_id = '$book_id';";
	$sql2 = "DELETE FROM book WHERE book.id = '$book_id';";

	if($conn->query($sql1) && $conn->query($sql2)){
		header('Location: index.php');
		exit;
	}else{
		echo $conn->error;
	}
}

if(isset($_GET['comment_id'])){
	$comment_id = $_GET['comment_id'];
	$book_id = get_book_id_from_comment_id($comment_id);
	
	if(isset($book_id)){
		$sql = "DELETE FROM book_comment where id='$comment_id'";

		if($conn->query($sql)){
			$url = "Location: comment.php?book_id=" . $book_id;
			header($url);
			exit;
		}else{
			echo $conn->error;
		}
	}
	
}