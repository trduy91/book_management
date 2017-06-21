<?php
include('header.php');

global $conn;
$sql  = "Select * from book";

$result = $conn->query($sql);


?>

<title>書籍一覧</title>
</head>
<body>
<div class="wrapper">
	<div class="header">
		<h1>書籍一覧</h1>
		<div class="underline"></div>			
	</div>		
	<div class="content">
		<a href="add.php" class="button" title="">追加</a>

		<?php
		if($result->num_rows > 0){
			$count =0;
			?>
			<table>
				<thead>
					<tr>
						<th>ID</th>
				       	<th>書籍名</th>
						<th>出版社名</th>
						<th>ページ数</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody>
					<?php while($row = $result->fetch_assoc()){
						$count++;
						$class="";
						if($count%2 == 1){
							$class="dark";
						}
						?>
						<tr class="<?php echo $class; ?>">
							<td><?php echo $row['id']; ?></td>
							<td class="book_name"><?php echo $row['name']; ?></td>
							<td class="book_publisher"><?php echo $row['publisher']; ?></td>
							<td><?php echo $row['page']; ?></td>
							<td class="function">
								
								<a href="edit.php?book_id=<?php echo $row['id']; ?>" class="button edit" title="">修正</a>
								
								<a href="delete.php?book_id=<?php echo $row['id']; ?>" class="button delete" title="">削除</a>
								
								<a href="comment.php?book_id=<?php echo $row['id']; ?>" class="button comment" title="">感想の一覧</a>
							</td>
						</tr>
						<?php
						} ?>
					
				</tbody>
			</table>
			<?php
		}
		$conn->close();

		?>

	</div>
</div>	

<?php
include('footer.php');