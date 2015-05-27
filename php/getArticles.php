<?php
	function get_articles_db($id){
		$conn=new PDO("mysql:dbname=doseddb;host=localhost;charset=utf8", "dosed", "pass");
		if($id==0){
		$stmt=$conn->prepare("select id, date as time, title, author, headline, article, url from articles");
		$stmt->execute();
		}
		else{
			$stmt=$conn->prepare("select id, date as time, title, author, headline, article, url from articles where id=:id");
			$stmt->execute(array(':id' => $id));
		}
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	    return $result;
	}
	if(isset($_GET['id'])){
		$article=get_articles_db($_GET['id']);
		echo json_encode($article);
	}
	else{
		$articles=get_articles_db();
		echo json_encode($articles);
	}

?>