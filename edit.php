<?php
include('header.php');

if(isset($_GET['book_id'])){
	$book_id = $_GET['book_id'];
	$book = get_book_from_book_id($book_id);


	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$name = '';
		$publisher = '';
		$page = 0;
		if(isset($_POST['name'])){
			$name = $_POST['name'];
		}
		if(isset($_POST['publisher'])){
			$publisher = $_POST['publisher'];
		}
		if(isset($_POST['page'])){
			$page = $_POST['page'];
			if($page < 0){
				$page = 0;
			}
		}

		$sql = "update book set name='$name',publisher='$publisher',page='$page' where id='$book_id'";
		if($conn->query($sql) === TRUE){
			// return;
			header('Location: index.php');
			exit;
		}else{
			echo "Error: ". $conn->error;
		}
	}




?>
<title>書籍の編集</title>
</head>
<body>

<div class="wrapper">
	<div class="header">
		<h1>書籍の編集</h1>
		<div class="underline">
			
		</div>
	</div>
	<div class="content">
		<form action="edit.php?book_id=<?php echo $book_id; ?>" method="post" accept-charset="utf-8">
			
			<div class="row">
				<div class="label">
					書籍名
				</div>
				<div class="input">
					<input type="text" name="name" value="<?php echo $book['name']; ?>">
				</div>
			</div>
			<div class="row">
				<div class="label">
					出版社名
				</div>
				<div class="input">
					<input type="text" name="publisher" value="<?php echo $book['publisher']; ?>">
				</div>
			</div>
			<div class="row">
				<div class="label">
					ページ数
				</div>
				<div class="input">
					<input type="number" name="page" value="<?php echo $book['page']; ?>">
				</div>
			</div>
			<div class="row">
				<button type="submit" class="button submit">送信</button>
			</div>


		</form>
		<a href="index.php" title="" class="button">戻る</a>
	</div>
</div>

<?php
}
$conn->close();
include('footer.php');