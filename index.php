<!DOCTYPE HTML> 
<html>
	<head>
		<link href="stylesheets/main.css" rel="stylesheet">
		<meta charset="UTF-8">
		<title> dosedTV - socialize your watching </title>
	</head>
	<body>
		<div class="logins">
			<a  onClick="replacePage('site_content/signup.html')">Log in </a>
			<a  onClick="replacePage('site_content/signup.html')">Sign up</a>
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
				<div class="news">
					<div class="headline">News stories</div>
					<hr/>
		<?php 
			function get_news(){
				$dir="news";
				$files=scandir("$dir");
				$txt_files=array();
				foreach ($files as &$file){
					if(strlen($file)>3){
						if(strcmp(substr($file,-4),'.txt')==0){
							array_push($txt_files,"news/".$file);
						}
					}
				}

				$i=0;
				$j=0;
				$break=false;
				$short="";
				$long="";
				$news=array();
				foreach($txt_files as &$file){
					$content=file($file);

					foreach ($content as $line_num => $line) {
					    if($line_num==0){
					    	$date=$line;
					    }
					    if($line_num==1){
					    	$author=$line;
					    }
					    if($line_num==2){
					    	$title=$line;
					    }
					    if($line_num==3){
					    	$link=$line;
					    }
					    if(strcmp($line,"--\n")==0){
					    	$break=true;
					    	continue;
					    }
					    if($line_num>3 && !$break){
					    	$short.=$line."\n";
					    }
					    if($line_num>3 && $break){
					    	$long.=$line."\n";
					    }
					}
				array_push($news,array('date' => $date, 'author' => $author, 'title' => $title, 'link' => $link, 'short' => $short, 'long' => $long));
				}
				return $news;
			}
			$try="site_content/article.html";
			$news=get_news();
			for($i=0;$i<count($news);$i++){
				if($i%3 == 0){
					print '<div class="articles">';
				}
				$num=($i%3)+1;
				print '<div class="article'.$num.'" >';
				print '<img src="'.$news[$i]['link'].'" alt="Site logo"/>';
				print '<div class="date">'.$news[$i]['date'].'</div>'; 
				print '<h2>'.$news[$i]['title'].'</h2>';
				print '<p>'.$news[$i]['short'].'<p>';
				print "<a href='#' onClick='replacePage(\"".$try."\",".$i.")'> Read more </a>";
				print '<div class="author">'.$news[$i]['author'].'</div></div>';
				if(($i+1)%3 == 0){
					print '</div><br><br>';
				}
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