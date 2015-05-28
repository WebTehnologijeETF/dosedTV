<?php
	if(isset($_POST['action'])){
		echo "alo";
		if(strcmp($_POST['action'],'create')==0){
			$conn=new PDO("mysql:dbname=doseddb;host=localhost;charset=utf8", "dosed", "pass");
			$stmt=$conn->prepare("INSERT INTO comments SET email=?, author=?, comment=?, article_id=?;");
			$stmt->execute(array($_POST['email'],  $_POST['author'],  $_POST['comment'], $_POST['article']));
		}
		if(isset($_POST['id'])){
			if(strcmp($_POST['action'],'delete')==0){
				$conn=new PDO("mysql:dbname=doseddb;host=localhost;charset=utf8", "dosed", "pass");
				$stmt=$conn->prepare("DELETE FROM comments WHERE id=?");		
				$stmt->execute(array($_POST['id']));	
			}

			if(strcmp($_POST['action'],'update')==0){
				$conn=new PDO("mysql:dbname=doseddb;host=localhost;charset=utf8", "dosed", "pass");
				$stmt=$conn->prepare("UPDATE comments SET email=?, author=?, comment=?, article_id=? WHERE id=?");
				$stmt->execute(array($_POST['email'], $_POST['author'], $_POST['comment'],  $_POST['article'],  $_POST['id']));
			}
		}
	}

?>