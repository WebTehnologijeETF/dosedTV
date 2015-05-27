<!DOCTYPE HTML> 
<html>
	<head>
		<link href="stylesheets/main.css" rel="stylesheet">
		<meta charset="UTF-8">
		<title> dosedTV - socialize your watching </title>
	</head>
	<body onload="getAllArticles()">
		<?php
			session_start();
  
 		    $veza = new PDO("mysql:dbname=wt8;host=localhost;charset=utf8", "wt8user", "wt8pass");
	     	$veza->exec("set names utf8");

    		if (isset($_SESSION['username'])){
        		$username = $_SESSION['username'];
        		$password = $_SESSION['password'];
      		}
    		else if (isset($_REQUEST['username'])) {
		        $username = $_REQUEST['username'];
		        $password = $_REQUEST['password'];
		        $stmt = $veza->prepare('SELECT * from users where username= :user and password=:pass');
		        $stmt->execute(array(':user' => $username, ':pass' => $password));
		        $result = $stmt->fetch(PDO::FETCH_ASSOC);
		        if(!$result){
		          echo "<h1>Korisnik ne postoji</h1>";
		        }
		        $_SESSION['username']=$username;
		        $_SESSION['password']=$password;
      		}

		    if(isset($_POST['logout'])){
        		session_unset();
      		}
		?>	
		<div class="logins" id="loginform">
			<a onClick="showLoginForm()" id="loginbtn">Log in </a>
			<a onClick="replacePage('site_content/signup.html')" id="signupbtn">Sign up</a>
		</div>
		<div class="main">
			<div id="logo">	
				<img src="pictures/logotv.png" alt="Site logo"/>
			</div>
			<div class="nav">
				<ul>
					<li>
						<ul>
							<li onClick="replacePage('site_content/news.html')" class="navmain"><a href="#" >News stories</a></li>
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
			<div class="headline">Panel</div>
			<hr/>
				<div class="adminPanel">
					<ul id="optionsList">
						<li>Articles</li>
						<li>Users</li>
					</ul>
					<div id="articleOptions">
						<div id="articleList">
						</div>
						<div id="commentSection">
						</div>
						<div id="articleForm">
							<div>
								<div class="tbLabel">Title</div>
								<div class="tbInput"><input type="text" name="title" id="titlebox"></div>
							</div>
							<div>
								<div class="tbLabel">Author</div>
								<div class="tbInput"><input type="text" name="author" id="authorbox"></div>
							</div>
							<div>
								<div class="tbLabel">Headline</div>
								<div class="tbInput"><textarea rows="4" cols="31" name="headline" id="headlinebox"></textarea></div>
							</div>
							<div>
								<div class="tbLabel">Article</div>
								<div class="tbInput"><textarea rows="4" cols="31" name="article" id="articlebox"></textarea></div>
							</div>
							<div>
								<div class="tbLabel">Picture URL</div>
								<div class="tbInput"><input type="text" name="url" id="picturebox"></div>
							</div>
							<input type='hidden' value='-1' name='id'>
							<div>
								<input class="actionButton" type='button' name="action" value='delete'>
								<input type='button' class="actionButton" name="action" value='update'>
								<input type='button' name="action" class="actionButton" value='create'>
							</div>
						</div>
					</div>
					<div id="userOptions">
					</div>
				</div>
				<div class="footer">
				<hr/>
				<a href="#" onClick="replacePage('site_content/contact.html')"> Contact us. </a> All right reserved. Site developed by students of the Faculty of Electrical Engineering Sarajevo.
			</div>
				</div>

			</div>
		</div>
	</body>
	<script src="scripts/dropDownMenu.js" type="text/javascript"></script>
	<script src="scripts/signUpValidation.js" type="text/javascript"></script>
	<script src="scripts/zamgerWebService.js" type="text/javascript"></script>
	<script src="scripts/SPA.js" type="text/javascript"></script>
</html>