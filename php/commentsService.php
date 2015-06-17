<?php

	function zag() {
    	header("{$_SERVER['SERVER_PROTOCOL']} 200 OK");
    	header('Content-Type: text/html');
    	header('Access-Control-Allow-Origin: *');
	}
	
	function createComment($data){
		$conn=new PDO("mysql:dbname=doseddb;host=localhost;charset=utf8", "dosed", "pass");
		$stmt=$conn->prepare("INSERT INTO comments SET email=?, author=?, comment=?, article_id=?;");
		$stmt->execute(array($_POST['email'],  $_POST['author'],  $_POST['comment'], $_POST['article']));
	}
	
	function deleteComment($data){
		$conn=new PDO("mysql:dbname=doseddb;host=localhost;charset=utf8", "dosed", "pass");
		$stmt=$conn->prepare("DELETE FROM comments WHERE id=?");		
		$stmt->execute(array($_POST['id']));	
	}

	function updateComment($data){
		$conn=new PDO("mysql:dbname=doseddb;host=localhost;charset=utf8", "dosed", "pass");
		$stmt=$conn->prepare("UPDATE comments SET email=?, author=?, comment=?, article_id=? WHERE id=?");
		$stmt->execute(array($_POST['email'], $_POST['author'], $_POST['comment'],  $_POST['article'],  $_POST['id']));
	}

	function getComment($data){
		$conn=new PDO("mysql:dbname=doseddb;host=localhost;charset=utf8", "dosed", "pass");
		if($data['news_id'] && $data['id']){
			$conn=new PDO("mysql:dbname=doseddb;host=localhost;charset=utf8", "dosed", "pass");
			$stmt=$conn->prepare("SELECT id, date AS time, author, email, comment FROM comments WHERE article_id=? AND id=?");
			$stmt->execute(array($data['news_id'],$data['id']));
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    return json_encode($result);
		}
		else if($data['news_id']){
			$stmt=$conn->prepare("select id, date as time, author, email, comment from comments where article_id= :id");
			$stmt->execute(array(':id' => $data['news_id']));
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	    	return json_encode($result);
		}
		else if($data['id']){
			$stmt=$conn->prepare("select id, date as time, author, email, comment, article_id as article from comments where id= :id");
			$stmt->execute(array(':id' => $data['id']));
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
	    	return json_encode($result);
		}
		else{
			$stmt=$conn->prepare("select id, date as time, author, email, comment, article_id as article from comments");
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	    	return json_encode($result);
		}
	}
	

	function rest_get($request, $data) { echo getComment($data); }
	function rest_post($request, $data) { createComment($data); }
	function rest_delete($request) { deleteComment($data); }
	function rest_put($request, $data) { updateComment($data); }
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