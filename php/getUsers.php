	
<?php
	function get_users_db($id){
		$conn=new PDO("mysql:dbname=doseddb;host=localhost;charset=utf8", "dosed", "pass");
		if($id==0){
		$stmt=$conn->prepare("select id, username, name, password, email, birthdate as date, gender, country from users");
		$stmt->execute();
		}
		else{
			$stmt=$conn->prepare("select id, username, name, password, email, birthdate as date, gender, country from users where id=:id");
			$stmt->execute(array(':id' => $id));
		}
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	    return $result;
	}
	function get_users_wodb($user){
		$conn=new PDO("mysql:dbname=doseddb;host=localhost;charset=utf8", "dosed", "pass");
		$stmt=$conn->prepare("select id, username, name, password, email, birthdate as date, gender, country from users where username!=:username");
		$stmt->execute(array(':username' => $user));
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	    return $result;
	}
	if(isset($_GET['ignored'])){
		$users=get_users_wodb($_GET['ignored']);
		echo json_encode($users);
	}
	else if(isset($_GET['user_id'])){
		$user=get_users_db($_GET['user_id']);
		echo json_encode($user);
	}
	else{
		$users=get_users_db();
		echo json_encode($users);
	}

?>