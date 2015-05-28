<?php
	function get_comments_db(){
		$conn=new PDO("mysql:dbname=doseddb;host=localhost;charset=utf8", "dosed", "pass");
		$stmt=$conn->prepare("select id, date as time, author, email, comment from comments where article_id= :id");
		$stmt->execute(array(':id' => $_GET['news_id']));
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	    return $result;
	}

	function get_comments_by_id($id){
		$conn=new PDO("mysql:dbname=doseddb;host=localhost;charset=utf8", "dosed", "pass");
		if($id==0){
		$stmt=$conn->prepare("select id, date as time, author, email, comment, article_id as article from comments");
		$stmt->execute();
		}
		else{

			$stmt=$conn->prepare("select id, date as time, author, email, comment, article_id as article from comments where id= :id");
		$stmt->execute(array(':id' => $id));
		}
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	    return $result;
	}

	if(isset($_GET['news_id'])){
		$comments=get_comments_db();
		echo json_encode($comments);
	}
	else 	if(isset($_GET['comment_id'])){
		$comment=get_comments_by_id($_GET['comment_id']);
		echo json_encode($comment);
	}
	else{
		$comment=get_comments_by_id();
		echo json_encode($comment);
	}


?>