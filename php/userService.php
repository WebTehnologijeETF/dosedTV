<?php	
	if(isset($_POST['action'])){
		$conn=new PDO("mysql:dbname=doseddb;host=localhost;charset=utf8", "dosed", "pass");
		if(strcmp($_POST['action'],'create')==0){
			$pass='$2a$15$Ku2hb./9aA71tPo/E015h.dVudv3XXu6m92Dkv6MNgXMV5jzHPteG';
			$stmt=$conn->prepare("INSERT INTO users SET username=?, password='".$pass."', email=?, country=?, name=?, birthdate=?, gender=?");
			$stmt->execute(array($_POST['username'],  $_POST['email'],  $_POST['country'],  $_POST['name'], $_POST['date'], $_POST['gender']));		
			print_r($stmt->errorInfo());
		}

		if(strcmp($_POST['action'],'delete')==0){
			$stmt=$conn->prepare("DELETE FROM users WHERE id=?");
			$stmt->execute(array($_POST['id']));	
		}

		
		if(strcmp($_POST['action'],'update')==0){
			$stmt=$conn->prepare("UPDATE users SET username=?,  email=?, country=?, name=?, birthdate=?, gender=? WHERE id=?");
			$stmt->execute(array($_POST['username'],  $_POST['email'],  $_POST['country'],  $_POST['name'], $_POST['birthdate'], $_POST['gender'], $_POST['id']));		
		}
	}
?>