<!DOCTYPE HTML> 
<html>
	<head>
		<link href="stylesheets/main.css" rel="stylesheet">
		<meta charset="UTF-8">
		<title> dosedTV - socialize your watching </title>
	</head>
	<body>
		<div class="logins">
			<a onClick="replacePage('site_content/signup.html')">Log in </a>
			<a onClick="replacePage('site_content/signup.html')">Sign up</a>
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
						<div class="signupform">
			<div class="headline">
				Sign up
			</div>
			<hr/>
			<form id="logindata" action="signup_test.php" method="POST">					
				<div class="userdata">
					USER DATA
				</div>
				<?php
					function validateUsername($username){
						if(strlen($username)==0){
							return false;
						}
						$pattern="~^[a-z0-9_-]{3,16}$~";
						$valid=preg_match($pattern, $username, $match);
						return $valid;
					}
					function validatePass($pass1, $pass2){
						if(strlen($pass1)==0){
							return -1;
						}
						if(strcmp($pass1,$pass2)!=0){
							return 0;
						}
						return 1;
					}

					function validateEmail($mail){
						if(strlen($mail)==0){
							return false;
						}
						$pattern="~^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$~";
						$valid=preg_match($pattern, $username, $match);
						return $valid;
					}

					function validateCheckbox($value){
					if(strcmp($value,'male')==0 || strcmp($value,'female')==0)
						return true;
					return false;
					}
				?>
				
				Username: <input id="username" type="text" name="username" onblur="validateUsername()" 
				value="<?php if(isset($_REQUEST['username'])) print $_REQUEST['username']; else print $_POST['username']; ?>">
				<?php
					if(!validateUsername($_POST['username']))	
					echo '<img alt="error" src="pictures/error.png"> <label id="epic1m" style="visibility:visible;" >Incorrect username format.</label>';
				?>
				<br>
				
				Password:<input id="pass1" type="password" name="pass1"
				value="<?php if(isset($_REQUEST['pass1'])) print $_REQUEST['pass1']; else print $_POST['pass1']; ?>">
				<?php 
				if(validatePass($_POST['pass1'],$_POST['pass2'])!=1){ 
					print '<img alt="error" src="pictures/error.png">';
					if(validatePass($_POST['pass1'],$_POST['pass2'])==-1){
						print '<label id="epic1m" style="visibility:visible;"> Password must contain atleast 3 characters.</label>';
					}
					if(validatePass($_POST['pass1'],$_POST['pass2'])==0){
						print '<label id="epic1m" style="visibility:visible;"> Passwords do not match.</label>';
					}
				} 
				?>
				<br>

				Repeat password:<input id="pass2" type="password" name="pass2" onblur="validatePassword()"
				value="<?php if(isset($_REQUEST['pass2'])) print $_REQUEST['pass2']; else print $_POST['pass2']; ?>">
				<?php 
				if(validatePass($_POST['pass1'],$_POST['pass2'])!=1){ 
					print '<img alt="error" src="pictures/error.png">';
					if(validatePass($_POST['pass1'],$_POST['pass2'])==-1){
						print '<label id="epic1m" style="visibility:visible;"> Password must contain atleast 3 characters.</label>';
					}
					if(validatePass($_POST['pass1'],$_POST['pass2'])==0){
						print '<label id="epic1m" style="visibility:visible;"> Passwords do not match.</label>';
					}
				} 
				?><br>

				email:<input id="email" type="text" name="email" onblur="validateEmail()"
					value="<?php if(isset($_REQUEST['email'])) print $_REQUEST['email']; else print $_POST['email']; ?>">
				<?php
					if(validateEmail($_POST['email']))	
					echo '<img alt="error"  src="pictures/error.png"> <label id="epic4m" style="visibility:visible;" >Invalid email format.</label>';
				?>
					<br>
					<div class="personaldata">
						PERSONAL DATA
					</div>
					Full name:<input id="name" name="name" type="text"
					value="<?php if(isset($_REQUEST['name'])) print $_REQUEST['name']; else print $_POST['name']; ?>"><br>
					Date of birth:<input id="birth" type="date" name='date' 
					value="<?php if(isset($_REQUEST['date'])) print $_REQUEST['date']; else print $_POST['date']; ?>"><img alt="error" id="epic5" src="pictures/error.png"><label id="epic5m">You have to be over 18 years old.</label><br>

					Country:<input id="country" type="input" name="country" onblur="validateCountry()"
					value="<?php if(isset($_REQUEST['country'])) print $_REQUEST['country']; else print $_POST['country']; ?>">
					<img alt="error" id="epic6" src="pictures/error.png" onmouseenter="showError(this)" onmouseleave="hideError(this)">
					<label id="epic6m">Invalid country.</label>
					<br>
					Gender:
					<input id="mradio" type="radio" value="male" name="gender" 
					<?php if(isset($_REQUEST['gender'])){ if(strcmp($_POST['gender'],'male')==0) print 'checked';} ?>> Male
					<input type="radio" value="female" name="gender"
					<?php if(isset($_REQUEST['gender'])){ if(strcmp($_POST['gender'],'female')==0) print 'checked';} ?>> Female 
					<?php
						if(!validateCheckbox($_POST['gender']))	
							echo '<img alt="error" style="margin-left:15%;" src="pictures/error.png"> <label id="epic4m" style="visibility:visible;" >Gender is invalid or not selected.</label>';
					?>
					<br> 
					<div class="buttons">
						<input type="submit" id="button" value="Create" name="Send" onclick="">
					</div>					
				</form>
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