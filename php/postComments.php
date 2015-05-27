<?php 
	if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['comment']) && isset($_POST['article'])){
		$conn=new PDO("mysql:dbname=doseddb;host=localhost;charset=utf8", "dosed", "pass");
		$stmt=$conn->prepare("INSERT INTO comments SET author=?, email=?, article_id=?, comment=?;");
		if (!$stmt) {
    	echo "\nPDO::errorInfo():\n";
    	print_r($dbh->errorInfo()); 	
		}
		$stmt->execute(array($_POST['name'], $_POST['email'], $_POST['article'], $_POST['comment']));
		echo $_POST['name'].$_POST['comment'].$_POST['email'].$_POST['article'];

	}
?>