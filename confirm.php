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
			<div id="content">
			<div class="signupform">
			<div class="headline">
				Account created
			</div>
			<hr>
			<?php

				function createUser($data){
					$conn=new PDO("mysql:dbname=doseddb;host=localhost;charset=utf8", "dosed", "pass");
					$pass=crypt($data['pass1'], '$2a$15$Ku2hb./9aA71tPo/E015h.$');
					$stmt=$conn->prepare("INSERT INTO users SET username=?, password='".$pass."', email=?, country=?, name=?, birthdate=?, gender=?");
					$stmt->execute(array($data['username'],  $data['email'],  $data['country'],  $data['name'], date("Y-m-d",strtotime($data['date'])), $data['gender']));		
				}
				/*require("sendgrid-php/sendgrid-php.php");
				$service_plan_id = "sendgrid_56d99"; // your OpenShift Service Plan ID
				$account_info = json_decode(getenv($service_plan_id), true);
				$sendgrid = new SendGrid("amuslija", "amuslija16487");
				$email    = new SendGrid\Email();

				$email->addTo("amuslija1@etf.unsa.ba")
				      ->setFrom("muslija.adnan@gmail.com")
				      ->setCc("vljubovic@etf.unsa.ba")
				      ->setSubject("dosedTV Account Details")
				      ->setText($_POST['message']);

				try {
				    $sendgrid->send($email);
				} catch(\SendGrid\Exception $e) {
				    echo $e->getCode();
				    foreach($e->getErrors() as $er) {
				        echo $er;
				    }
				}*/
				createUser(unserialize($_POST['account_details']));
			?>
			<div id="confirm">
				Thank you for creating an account. Check your email to confirm it.<br>
				<input type="button" onClick="replacePage('site_content/news.html')" value="Return to homepage" id="confirmButton"> 
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