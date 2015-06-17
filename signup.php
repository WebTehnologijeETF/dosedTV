<!DOCTYPE HTML> 
<html>
	<head>
		<link href="stylesheets/main.css" rel="stylesheet">
		<meta charset="UTF-8">
		<title> dosedTV - socialize your watching </title>
	</head>
	<body>
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
						return filter_var($mail,FILTER_VALIDATE_EMAIL);
					}

					function validateCheckbox($value){
					if(strcmp($value,'male')==0 || strcmp($value,'female')==0)
						return true;
					return false;
					}

					function validateCountry($value){
						return (strcmp($value,'valid')==0);
					}
					function validateFields(){
						$is_valid=(validateUsername($_POST['username']) && validatePass($_POST['pass1'],$_POST['pass2']) && validateEmail($_POST['email']) && validateCheckbox($_POST['gender']) && validateCountry($_POST['cvalid'])); 
						return $is_valid;
					}

					function showConfirm(){						
						if(validateFields())
							return "block";
						return "none";
					}

					function showForm(){
						if(validateFields())
							return "hidden";
						return "visible";
					}
			?>		
			<div id="content">
			<div class="signupform">
			<div class="headline">
				Sign up
			</div>
			<hr/>
			<form id="confirmForm" style='display:<?php echo showConfirm() ?>;' action="confirm.php" method="POST">
				<div id="confirmHead">You entered the following information: </div>
				<p>
					Username: <?php echo $_POST['username'] ?><br>
					Email: <?php echo $_POST['email'] ?><br>
					Name: <?php echo $_POST['name'] ?><br>
					Date of birth: <?php echo $_POST['date'] ?><br>
					Country: <?php echo $_POST['country'] ?><br>
					Gender: <?php echo $_POST['gender'] ?><br>
					<input type="hidden" value='<?php echo htmlentities(serialize($_POST)); ?>' name='account_details'>
					<input type="hidden" name="message" value='<?php echo "ACCOUNT DETAILS: \n Username: ".$_POST["username"]."\n"."Email: ".$_POST["email"]."\n"."Name: ".$_POST["name"]."\n"."Birthday: ".$_POST["date"]."\n"."Country: ".$_POST["country"]."\n"."Gender: ".$_POST["gender"]."\n"; ?>'>
				</p>
				<div id="confirmFoot">Confirm the information:
					<input type="button" name="toggleForm" value="Change information" onClick="test()">
					<input type="submit" name="sendMail" value="Continue">
				</div>
			</form>


			<form id="logindata" action="signup.php" method="POST" style="visibility: <?php echo showForm(); ?>;">					
				<div class="userdata">
					USER DATA
				</div>

				Username: <input id="username" type="text" name="username" onblur="validateUsername()" 
				value="<?php if(isset($_REQUEST['username'])) print htmlEntities($_REQUEST['username'], ENT_QUOTES); else print htmlEntities($_POST['username'], ENT_QUOTES); ?>">
				<?php
					if(!validateUsername($_POST['username']))	
					echo '<img alt="error" src="pictures/error.png"> <label id="epic1m" style="visibility:visible;" >Incorrect username format.</label>';
				?>
				<br>
				
				Password:<input id="pass1" type="password" name="pass1"
				value="<?php if(isset($_REQUEST['pass1'])) print htmlEntities($_REQUEST['pass1'],ENT_QUOTES); else print htmlEntities($_POST['pass1'],ENT_QUOTES); ?>">
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
				value="<?php if(isset($_REQUEST['pass2'])) print htmlEntities($_REQUEST['pass2'],ENT_QUOTES); else print htmlEntities($_POST['pass2'],ENT_QUOTES); ?>">
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
					value="<?php if(isset($_REQUEST['email'])) print htmlEntities($_REQUEST['email'],ENT_QUOTES); else print htmlEntities($_POST['email'],ENT_QUOTES); ?>">
				<?php
					if(strlen(validateEmail($_POST['email']))==0)	
					echo '<img alt="error"  src="pictures/error.png"> <label id="epic4m" style="visibility:visible;" >Invalid email format.</label>';
				?>
					<br>
					<div class="personaldata">
						PERSONAL DATA
					</div>
					Full name:<input id="name" name="name" type="text"
					value="<?php if(isset($_REQUEST['name'])) print htmlEntities($_REQUEST['name'],ENT_QUOTES); else print htmlEntities($_POST['name'],ENT_QUOTES); ?>"><br>
					Date of birth:<input id="birth" type="date" name='date' 
					value="<?php if(isset($_REQUEST['date'])) print htmlEntities($_REQUEST['date'],ENT_QUOTES); else print htmlEntities($_POST['date'],ENT_QUOTES); ?>"><img alt="error" id="epic5" src="pictures/error.png"><label id="epic5m">You have to be over 18 years old.</label><br>

					Country:<input id="country" type="input" name="country" onblur="validateCountry()"
					value="<?php if(isset($_REQUEST['country'])) print htmlEntities($_REQUEST['country'],ENT_QUOTES); else print htmlEntities($_POST['country'],ENT_QUOTES); ?>">
					<input name="cvalid" type="hidden" id="cvalid" value="<?php if(isset($_REQUEST['cvalid'])) print htmlEntities($_REQUEST['valid'],ENT_QUOTES); else print htmlEntities($_POST['cvalid'],ENT_QUOTES);?>">
					<?php
						if(!validateCountry($_POST['cvalid']))	
							echo '<img alt="error" src="pictures/error.png"> <label id="epic4m" style="visibility:visible;" >Invalid country.</label>';
					?>
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
						<input type="submit" id="button" value="Create" name="Send" onclick="validateCountry()">
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