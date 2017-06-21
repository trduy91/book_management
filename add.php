<?php
include('header.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$name = '(no Title)';
	$publisher = '(no Publisher)';
	$page = 0;
	if(isset($_POST['name']) && $_POST['name'] !=null){
		$name = $_POST['name'];
	}
	if(isset($_POST['publisher']) && $_POST['publisher'] !=null){
		$publisher = $_POST['publisher'];
	}
	if(isset($_POST['page']) && $_POST['page'] !=null){
		$page = $_POST['page'];
		if($page < 0){
			$page = 0;
		}
	}

	$sql = "INSERT into book(name, publisher, page) values ('$name', '$publisher', '$page')";
	if($conn->query($sql) === TRUE){
		// return;
		header('Location: index.php');
		exit;
	}else{
		echo "Error: ". $conn->error;
	}
}
$conn->close();
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
		<form action="add.php" method="post" accept-charset="utf-8">
			
			<div class="row">
				<div class="label">
					書籍名
				</div>
				<div class="input">
					<input type="text" name="name">
				</div>
			</div>
			<div class="row">
				<div class="label">
					出版社名
				</div>
				<div class="input">
					<input type="text" name="publisher">
				</div>
			</div>
			<div class="row">
				<div class="label">
					ページ数
				</div>
				<div class="input">
					<input type="number" name="page">
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
include('footer.php');