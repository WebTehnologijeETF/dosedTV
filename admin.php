<!DOCTYPE HTML> 
<html>
	<head>
		<link href="stylesheets/main.css" rel="stylesheet">
		<meta charset="UTF-8">
		<title> dosedTV - socialize your watching </title>
	</head>
	<body onload="">
		<?php
			session_start();
			if(isset($_SESSION['username']) && isset($_SESSION['password'])){
				$username=$_SESSION['username'];
				$password=$_SESSION['password'];
			}
  			else if(isset($_POST['username']) && isset($_POST['password'])){
	 		    $conn=new PDO("mysql:dbname=doseddb;host=localhost;charset=utf8", "dosed", "pass");
			    $username=$_POST['username'];
			    $password=$_POST['password'];
			    $stmt=$conn->prepare('select username, password, admin from users where username=:username');
			   	$stmt->execute(array(':username' => $username));
			    $result=$stmt->fetch(PDO::FETCH_ASSOC);
				$check=crypt($_POST['password'],$result['password'])===$result['password'];
				$check;
			    if(!$result || !$check){
			    	echo "<h1>Korisnik ne postoji</h1>";
			    }
			    else{
			    	$_SESSION['username']=$username;
				    $_SESSION['password']=$password;
			    	if($result['admin']!=0){
			    		$_SESSION['is_admin']=1;
			    	}
			    	else{
			    		$_SESSION['is_admin']=0;
			    	}
					
				}
		    }
		   
		    if(strcmp($_POST['login'],'Logout')==0) {
		    	session_unset();
		    }

		?>	
		<div class="logins" id="loginform">
		<?php
			if(isset($_SESSION['username'])){
				if($_SESSION['is_admin']==1){
					echo "<form action='admin.php' method='POST' id='logoutform'><a href='admin.php'> Panel </a>";
					echo "<a onClick='logoutForm()'> Logout </a><input type='hidden' name='login' value='Logout'></form>";
					echo "<input type='hidden' id='usernameField' value='".$_SESSION['username']."' >";
				}
				else{
					echo "<form action='admin.php' method='POST' id='logoutform'><a href='admin.php'> Home </a>";
					echo "<a onClick='logoutForm()'> Logout </a><input type='hidden' name='login' value='Logout'></form>";
					echo "<input type='hidden' id='usernameField' value='".$_SESSION['username']."' >";
				}
			}
			else{
				echo'
				<a onClick="showLoginForm()" id="loginbtn">Log in </a>
				<a onClick="replacePage("site_content/signup.html")" id="signupbtn">Sign up</a>';
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
			<?php
			$panel='<div id="content">
			<div class="headline">Panel</div>
			<hr/>
				<div class="adminPanel">
					<ul id="optionsList">
						<li onClick="getAllArticles()">ARTICLES</li>
						<li onClick="getAllComments()">COMMENTS</li>
						<li onClick="getAllUsers()">USERS</li>
					</ul>
					<div id="articleOptions">
						<div id="List">
						</div>
						<div id="Form" >
						</div>
					</div>
					<div id="userOptions">
					</div>
				</div>';

			if(isset($_SESSION['username']) && $_SESSION['is_admin'])
				echo $panel;
			else if(isset($_SESSION['username'])){
				echo '<div id="content">
					<div class="headline">Panel</div>
					<hr/>
					<h1> LOG IN WAS SUCCESSFUL. WELCOME</h1>
					</div>';
			}
			else{
				echo '<div id="content">
					<div class="headline">Panel</div>
					<hr/>
					<h1> PLEASE LOG IN AS AN ADMINISTATOR</h1>
					</div>';
			}	
			?>
			<div class="footer">
			<hr/>
				<a href="#" onClick="replacePage(\'site_content/contact.html\')"> Contact us. </a> All right reserved. Site developed by students of the Faculty of Electrical Engineering Sarajevo.
			</div>
				</div>

			</div>
		</div>
	</body>
	<script src="scripts/dropDownMenu.js" type="text/javascript"></script>
	<script src="scripts/signUpValidation.js" type="text/javascript"></script>
	<script src="scripts/zamgerWebService.js" type="text/javascript"></script>
	<script src="scripts/SPA.js" type="text/javascript"></script>
	<script src="scripts/crud.js" type="text/javascript"></script>
</html>