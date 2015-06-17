<?php
	
	function zag() {
    	header("{$_SERVER['SERVER_PROTOCOL']} 200 OK");
    	header('Content-Type: text/html');
    	header('Access-Control-Allow-Origin: *');
	}


	function createArticle($data){
		$conn=new PDO("mysql:dbname=doseddb;host=localhost;charset=utf8", "dosed", "pass");
		$stmt=$conn->prepare("INSERT INTO articles SET title=?, author=?, headline=?, article=?, url=?;");
		$stmt->execute(array($data['title'],  $data['author'], $data['headline'],  $data['article'],  $data['url']));		
	}

	function deleteArticle($data){
		$conn=new PDO("mysql:dbname=doseddb;host=localhost;charset=utf8", "dosed", "pass");
		$stmt=$conn->prepare("DELETE FROM articles WHERE id=?");
		$stmt->execute(array($data['id']));	
	}

	function updateArticle($data){
		$conn=new PDO("mysql:dbname=doseddb;host=localhost;charset=utf8", "dosed", "pass");
		$stmt=$conn->prepare("UPDATE articles SET title=?, author=?, headline=?, article=?, url=? WHERE id=?");
		$stmt->execute(array($data['title'], $data['author'],  $data['headline'], $data['article'], $data['url'], $data['id']));
	}

	function getArticle($data){
		$conn=new PDO("mysql:dbname=doseddb;host=localhost;charset=utf8", "dosed", "pass");
		if($data['id']){
			$stmt=$conn->prepare("select id, date as time, title, author, headline, article, url from articles where id=?");
			$stmt->execute(array($data['id']));
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
		}
		else{
			$stmt=$conn->prepare("select id, date as time, title, author, headline, article, url from articles");
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
	    return json_encode($result);
	}
	
	function rest_get($request, $data) { echo getArticle($data); }
	function rest_post($request, $data) { createArticle($data); }
	function rest_delete($request) { deleteArticle($data); }
	function rest_put($request, $data) { updateArticle($data); }
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