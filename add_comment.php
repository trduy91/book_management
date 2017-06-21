<?php
include('header.php');


if(isset($_GET['book_id'])){
	$book_id = $_GET['book_id'];
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$comment="";
		if(isset($_POST['comment'])){

			$comment = $_POST['comment'];
		}

		$sql = "INSERT INTO book_comment (name, book_id) VALUES ('$comment', '$book_id')";
		if($conn->query($sql) === TRUE){
			// return;
			$redirect = 'Location: comment.php?book_id=' . $book_id;
			header($redirect);
			exit;
		}else{
			echo "Error: ". $conn->error;
		}
	}
	$conn->close();
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
		<form action="add_comment.php?book_id=<?php echo $book_id; ?>" method="post" accept-charset="utf-8">
			
			<div class="row">
				<div class="label">
					コメント
				</div>
				<div class="input">
					<textarea name="comment"></textarea>
				</div>
			</div>
			
			<div class="row">
				<button type="submit" class="button submit">送信</button>
			</div>


		</form>
		<?php $url = 'comment.php?book_id=' . $book_id; ?>
		<a href="<?php echo $url; ?>" title="" class="button">戻る</a>
	</div>
</div>

<?php

}
include('footer.php');