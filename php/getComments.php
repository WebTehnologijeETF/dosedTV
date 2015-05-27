<?php
	function get_comments_db(){
		$conn=new PDO("mysql:dbname=doseddb;host=localhost;charset=utf8", "dosed", "pass");
		$stmt=$conn->prepare("select id, date as time, author, email, comment from comments where article_id= :id");
		$stmt->execute(array(':id' => $_GET['news_id']));
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	    return $result;
	}

	if(isset($_GET['news_id'])){
		$comments=get_comments_db();
		echo json_encode($comments);
	}

?>