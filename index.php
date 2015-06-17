<!DOCTYPE HTML> 
<html>
	<head>
		<link href="stylesheets/main.css" rel="stylesheet">
		<meta charset="UTF-8">
		<title> dosedTV - socialize your watching </title>
	</head>
	<body>
	<?php
		session_start();
	?>
		<div class="logins" id="loginform">
			<?php
			if(isset($_SESSION['username'])){
				echo "<form action='admin.php' method='POST' id='logoutform'><a href='admin.php'> Panel </a>";
				echo "<a onClick='logoutForm()'> Logout </a><input type='hidden' name='login' value='Logout'></form>";
				echo "<input type='hidden' id='usernameField' value='".$_SESSION['username']."' >";
			}
			else{
				echo'<a onClick="showLoginForm()" id="loginbtn">Log in </a>';
				echo '<a onClick="replacePage('."'site_content/signup.html'".')" id="signupbtn">Sign up</a>';
			}

		?>
		</div>
		<div class="main">

			<div id="logo">	
				<img src="pictures/logotv.png" alt="Site logo"/>
			</div>
			<div class="nav">
				<ul>
					<li>
						<ul>
							<li onClick="replacePage('site_content/news.php')" class="navmain"><a href="#" >News stories</a></li>
						</ul>
					</li>
					<li>
						<ul id="navcol" onmouseenter="addSubMenu(this)" onmouseleave="removeSubMenu(this)" >
							<li onClick="replacePage('site_content/recommended.html')" class="navmain" ><a href="#" >Recommended shows</a></li>
						</ul>
					</li>
					<li>
						<ul>
							<li onClick="replacePage('site_content/episodes.html') "class="navmain"><a href="#" >New episodes schedule</a></li>
						</ul>
					</li>
					<li>
						<ul>
							<li class="navmain"><a href="#">Videos</a></li>
						</ul>
					</li>
				</ul>
			</div>
			<div id="content">
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
		</div>
			<div class="footer">
				<hr/>
				<a href="#" onClick="replacePage('site_content/contact.html')"> Contact us. </a> All right reserved. Site developed by students of the Faculty of Electrical Engineering Sarajevo.
			</div>
		</div>
	</body>
	<script src="scripts/dropDownMenu.js" type="text/javascript"></script>
	<script src="scripts/signUpValidation.js" type="text/javascript"></script>
	<script src="scripts/zamgerWebService.js" type="text/javascript"></script>
	<script src="scripts/SPA.js" type="text/javascript"></script>
</html>
	</body>
</html>