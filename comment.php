<?php
include('header.php');

if(isset($_GET['book_id'])){
	$book_id = $_GET['book_id'];

	$book = get_book_from_book_id($book_id);

	$sql  = "Select * from book_comment where book_id='$book_id'";
	$result = $conn->query($sql);


?>
<title>感想一覧</title>
</head>
<body>
<div class="wrapper">
	<div class="header">
		<h1>感想一覧</h1>
		<div class="book_name">
			<?php echo $book['name']; ?>
		</div>
		<div class="underline">
			
		</div>
	</div>
	<div class="content">
		<a href="add_comment.php?book_id=<?php echo $book_id; ?>" class="button" title="">追加</a>
		<?php
		if($result->num_rows > 0){
			$total_comment = $result->num_rows;
			$rand = rand();
			$count=0;
			?>
			<table>
				<input type="hidden" id="current_page_<?php echo $rand; ?>">
				<input type="hidden" id="show_per_page_<?php echo $rand; ?>" value="<?php echo COMMENT_LIMITED; ?>">
				<thead>
					<tr>
						<th>ID</th>
						<th>コメント</th>
						<th>操作</th>
					</tr>
				</thead>
				 <tbody class="comment-list" id="comment_<?php echo $rand; ?>" data-id="#comment_<?php echo $rand; ?>" data-current_page="#current_page_<?php echo $rand; ?>" data-show_per_page="#show_per_page_<?php echo $rand; ?>" data-navigation="#page_navigation_<?php echo $rand; ?>" > 
				<!-- <tbody class="comment-list">  -->
				<?php 
		        	while ($row = $result->fetch_assoc()) {
							$count++;
							$class="";
							if($count%2 == 1){
								$class="dark";
							}
							?>
							
							<tr class="<?php echo $class; ?>">

								<td><?php echo $row['id']; ?></td>
								<td class="comment"><?php echo $row['name']; ?></td>
								
								<td class="function">
									
									<a href="edit_comment.php?comment_id=<?php echo $row['id']; ?>" class="button edit" title="">修正</a>
									
									<a href="delete.php?comment_id=<?php echo $row['id']; ?>" class="button delete" title="">削除</a>
									
									
								</td>
							</tr>

							<?php
						
					}	
				?>
				</tbody>
			</table>
			 <div class="pagination" >
				<ul class="page-numbers clearfix" id='page_navigation_<?php echo $rand; ?>'>
		                </ul><!--page-numbers-->
			 </div> 
			
			<?php
				
			}
			?>
	</div>
	<a href="index.php" title="" class="button">戻る</a>
</div>


<?php
}
$conn->close();

include('footer.php');