<?php
	if(isset($_POST['action'])){
		$conn=new PDO("mysql:dbname=doseddb;host=localhost;charset=utf8", "dosed", "pass");
		if(strcmp($_POST['action'],'create')==0){
			$stmt=$conn->prepare("INSERT INTO articles SET title=?, author=?, headline=?, article=?, url=?;");
			$stmt->execute(array($_POST['title'],  $_POST['author'], $_POST['headline'],  $_POST['article'],  $_POST['url']));		
		}

		if(strcmp($_POST['action'],'delete')==0){
			$stmt=$conn->prepare("DELETE FROM articles WHERE id=?");
			$stmt->execute(array($_POST['id']));	
		}

		
		if(strcmp($_POST['action'],'update')==0){
			$stmt=$conn->prepare("UPDATE articles SET title=?, author=?, headline=?, article=?, url=? WHERE id=?");
			$stmt->execute(array($_POST['title'], $_POST['author'],  $_POST['headline'], $_POST['article'], $_POST['url'], $_POST['id']));
		}
	}

?>