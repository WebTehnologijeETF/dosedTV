				<div class="news">
					<div class="headline">News stories</div>
					<hr/>
					<?php 
			function get_news_db(){
				$query = new PDO("mysql:dbname=doseddb;host=localhost;charset=utf8", "dosed", "pass");
			    $query->exec("set names utf8");
			    $result = $query->query("select id, UNIX_TIMESTAMP(date) time, title, author, headline, article, url from articles order by date desc");
			    if (!$result) {
			         $error = $query->errorInfo();
			         print "SQL error: " . $error[2];
			        exit();
			    }
			    return $result;
			}

			$articles=get_news_db();
			$i=0;
			foreach($articles as $news){
				if($i%3 == 0){
					print '<div class="articles">';
				}
				$num=($i%3)+1;
				print '<div class="article'.$num.'" >';
				print '<img src="'.$news['url'].'" alt="Site logo"/>';
				print '<div class="date">'.date("d.m.Y. | h:i", $news['time']).'</div>'; 
				print '<h2>'.$news['title'].'</h2>';
				print '<p>'.$news['headline'].'<p>';
				print "<a href='#' onClick=replacePage('site_content/article.html',".$news['id'].") > Read more </a>";
				print '<div class="author" >'.$news['author'].'</div></div>';
				if(($i+1)%3 == 0){
					print '</div><br><br>';
				}
				$i++;
			}
			
		?>
				</div>