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
				Account created
			</div>
			<hr>
			<?php
				require("sendgrid-php/sendgrid-php.php");
				$service_plan_id = "sendgrid_56d99"; // your OpenShift Service Plan ID
				$account_info = json_decode(getenv($service_plan_id), true);
				$sendgrid = new SendGrid("amuslija", "amuslija16487");
				$email    = new SendGrid\Email();

				$email->addTo("core.qr@gmail.com")
				      ->setFrom("muslija.adnan@gmail.com")
				      ->setSubject("dosedTV Account Details")
				      ->setText($_POST['message']);

				try {
				    $sendgrid->send($email);
				} catch(\SendGrid\Exception $e) {
				    echo $e->getCode();
				    foreach($e->getErrors() as $er) {
				        echo $er;
				    }
				}
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