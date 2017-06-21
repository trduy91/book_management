<?php
include('header.php');

if(isset($_GET['comment_id'])){
	$comment_id = $_GET['comment_id'];

	$comment = get_comment_from_comment_id($comment_id);


	$book_id = get_book_id_from_comment_id($comment_id);

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		if(isset($_POST['comment'])){

			$comment_content = $_POST['comment'];
		}
		
		$sql = "update book_comment set name='$comment_content' where id='$comment_id'";
		if($conn->query($sql) === TRUE){
			// return;
			$redirect = 'Location: comment.php?book_id=' . $book_id ;
			header($redirect);
			exit;
		}else{	
			echo "Error: ". $conn->error;
		}

	}

?>
<title>感想の編集</title>
</head>
<body>
<div class="wrapper">
	<div class="header">
		<h1>感想の編集</h1>
		<div class="underline">
			
		</div>
	</div>
	<div class="content">
		<form action="edit_comment.php?comment_id=<?php echo $comment_id; ?>" method="post" accept-charset="utf-8">
			
			<div class="row">
				<div class="label">
					コメント
				</div>
				<div class="input">
					<textarea name="comment"><?php echo $comment['name']; ?></textarea>
				</div>
			</div>
			
			<div class="row">
				<button type="submit" class="button submit">送信</button>
			</div>


		</form>
	</div>
	
</div>

<?php
}

include('footer.php');