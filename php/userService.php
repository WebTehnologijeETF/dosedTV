<?php

	function zag() {
    	header("{$_SERVER['SERVER_PROTOCOL']} 200 OK");
    	header('Content-Type: text/html');
    	header('Access-Control-Allow-Origin: *');
	}

	function createUser($data){
		$conn=new PDO("mysql:dbname=doseddb;host=localhost;charset=utf8", "dosed", "pass");
		$pass='$2a$15$Ku2hb./9aA71tPo/E015h.dVudv3XXu6m92Dkv6MNgXMV5jzHPteG';
		$stmt=$conn->prepare("INSERT INTO users SET username=?, password='".$pass."', email=?, country=?, name=?, birthdate=?, gender=?");
		$stmt->execute(array($_POST['username'],  $_POST['email'],  $_POST['country'],  $_POST['name'], $_POST['date'], $_POST['gender']));		
		print_r($stmt->errorInfo());
	}

	function deleteUser($data){
		$conn=new PDO("mysql:dbname=doseddb;host=localhost;charset=utf8", "dosed", "pass");
		$stmt=$conn->prepare("DELETE FROM users WHERE id=?");
		$stmt->execute(array($_POST['id']));	
	}

		
	function updateUser($data){
		$conn=new PDO("mysql:dbname=doseddb;host=localhost;charset=utf8", "dosed", "pass");
		$stmt=$conn->prepare("UPDATE users SET username=?,  email=?, country=?, name=?, birthdate=?, gender=? WHERE id=?");
		$stmt->execute(array($_POST['username'],  $_POST['email'],  $_POST['country'],  $_POST['name'], $_POST['birthdate'], $_POST['gender'], $_POST['id']));		
	}

	function getUser($data){
		$conn=new PDO("mysql:dbname=doseddb;host=localhost;charset=utf8", "dosed", "pass");
		if($data['ignored'] && $data['username']){
			$stmt=$conn->prepare("select id, username, name, password, email, birthdate as date, gender, country from users where username!=:username");
			$stmt->execute(array(':username' => $data['username']));
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    return json_encode($result);
		}
		else if($data['id']){
			$stmt=$conn->prepare("select id, username, name, password, email, birthdate as date, gender, country from users where id=:id");
			$stmt->execute(array(':id' => $data['id']));
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
		    return json_encode($result);
		}
		else{
			$stmt=$conn->prepare("select id, username, name, password, email, birthdate as date, gender, country from users");
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	    	return json_encode($result);
		}

	}
	
	function rest_get($request, $data) { echo getUser($data); }
	function rest_post($request, $data) { createUser($data); }
	function rest_delete($request) { deleteUser($data); }
	function rest_put($request, $data) { updateUser($data); }
	function rest_error($request) { }

	$method  = $_SERVER['REQUEST_METHOD'];
	$request = $_SERVER['REQUEST_URI'];

	
	switch($method) {
	    case 'PUT':
	        parse_str(file_get_contents('php://input'), $put_vars);
	        zag(); $data = $put_vars; rest_put($request, $data); break;
	    case 'POST':
	        zag(); $data = $_POST; rest_post($request, $data); break;
	    case 'GET':
	        zag(); $data = $_GET; rest_get($request, $data); break;
	    case 'DELETE':
	        zag(); rest_delete($request); break;
	    default:
	        header("{$_SERVER['SERVER_PROTOCOL']} 404 Not Found");
	        rest_error($request); break;
	}

?>