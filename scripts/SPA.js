

function replacePage(url,index)
{
	var req = new XMLHttpRequest();
	req.onreadystatechange=function(){
		if(req.readyState==4 && req.status==200){
			document.getElementById("content").innerHTML=req.responseText;
			
			if(url=='site_content/allshows.html'){
				readObjects();
			}

			if(url=='site_content/article.html'){
				setNews(index);
				setComments(index);	
			}
		}
	}
	req.open("GET",url,true);
	req.send();
}

function setComments(index){
	var req = new XMLHttpRequest();
	url="php/commentsService.php?news_id=";

	req.onreadystatechange=function(){
		if(req.readyState==4 && req.status==200){

			var section=document.getElementById('commentSection');
			section.innerHTML="";
			var comments=JSON.parse(req.responseText);
			if(comments.length==0){
				document.getElementById('commentLink').innerHTML="No comments";
			}
			else{
				if(document.getElementById('commentLink').innerHTML!="Comments");
				document.getElementById('commentLink').innerHTML="Show "+comments.length+" comments";	
				for(var i=0;i<comments.length;i++){
					section.innerHTML+="<div class='comment'>Author: "+comments[i]['author']+"<br>"+"Email:<a href='mailto:"+comments[i]['email']+"'>"+comments[i]['email']+"</a><br>"+comments[i]['time']+"<br>"+comments[i]['comment']+"<br><hr></div>";
				}
			}
		}
	}
	req.open("GET",url+index,true);
	req.send();
}

function setNews(index){
	var req = new XMLHttpRequest();
	url="php/read.php?news_id=";
	req.onreadystatechange=function(){
		if(req.readyState==4 && req.status==200){
			var article=JSON.parse(req.responseText);
			document.getElementById("newsimg").src=article['url'];
			document.getElementById("newstitle").innerHTML=article['title'];
			document.getElementById("newsauthor").innerHTML=article['author'];
			document.getElementById("newsdate").innerHTML=article['time'];
			document.getElementById("newsshort").innerHTML=article['headline'];
			document.getElementById("newslong").innerHTML=article['article'];
			document.getElementById("articleid").value=article['id'];
		}
	}

	req.open("GET",url+index,true);
	req.send();
}

function toggleComments(){
	document.getElementById("commentSection").style.display="block";
	document.getElementById('commentLink').innerHTML="Comments";
}

function sendComment(){
	var req = new XMLHttpRequest();
	var url = "php/postComments.php";
	var name=document.getElementById("commenterName").value;
	var email=document.getElementById("commenterEmail").value;
	var comment=document.getElementById("commenterComment").value;
	var article=document.getElementById("articleid").value;

	req.onreadystatechange=function(){
		if(req.readyState===4 && req.status===200){
			setComments(article);
			alert("Email sent");
		}
	}

	req.open("POST",url,true);
	req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	req.send("name="+name+"&email="+email+"&comment="+comment+"&article="+article);
	document.getElementById("commenterName").value="";
	document.getElementById("commenterEmail").value="";
	document.getElementById("commenterComment").value="";
}


function showLoginForm(){
	var form=document.getElementById("loginform");
	form.innerHTML="";
	form.innerHTML='<form action="admin.php" method="POST"><div><div class="tbLabel">Username</div><div class="tbInput"><input size="10" type="text" name="username"></div></div><div><div class="tbLabel">Password</div><div class="tbInput"><input size="10" type="password" name="password" ></div></div><input type="submit" name="login" value="Login"></form>';

}

function getAllUsers(){
	var req=new XMLHttpRequest();
	var url="php/userService.php?ignored=1&usernane="+document.getElementById('usernameField').value;

	req.onreadystatechange=function(){
		if(req.readyState===4 && req.status===200){
			var users=JSON.parse(req.responseText);
			var list=document.getElementById("List");
			list.innerHTML="";
			list.style.display='block';
			for(var i=0;i<users.length;i++){
				list.innerHTML+="<div class='user' id='user"+users[i]['id']+"' onClick='showUser(this)'>USERNAME: "+users[i]['username']+"<br>NAME: "+users[i]['name']+"<br>"+"EMAIL: "+users[i]['email']+"<br>"+"BIRTHDATE: "+users[i]['date']+"<br>"+"COUNTRY:<br>"+users[i]['country']+"<br>"+"GENDER: "+users[i]['gender']+"<br>ID:"+users[i]['id']+"<br><br>";}
		}
	}

	req.open("GET",url,true);
	req.send();

}

function getAllComments(){
	var req=new XMLHttpRequest();
	var url="php/commentsService.php";

	req.onreadystatechange=function(){
		if(req.readyState===4 && req.status===200){
			var comments=JSON.parse(req.responseText);
			var list=document.getElementById("List");
			list.innerHTML="";
			list.style.display='block';
			for(var i=0;i<comments.length;i++){
				list.innerHTML+="<div class='comment' id='comment"+comments[i]['id']+"' onClick='showComment(this)'>AUTHOR: "+comments[i]['author']+"<br>"+"EMAIL: "+comments[i]['email']+"<br>"+"DATE: "+comments[i]['time']+"<br>"+"COMMENT:<br>"+comments[i]['comment']+"<br>"+"ARTICLE ID:<br>"+comments[i]['article']+"<br><br>";}
		}
	}

	req.open("GET",url,true);
	req.send();

}

function getAllArticles(){
	var req=new XMLHttpRequest();
	var url="php/articlesService.php";

	req.onreadystatechange=function(){
		if(req.readyState===4 && req.status===200){
			var articles=JSON.parse(req.responseText);
			var list=document.getElementById("List");
			list.innerHTML="";
			list.style.display='block';
			for(var i=0;i<articles.length;i++){
				list.innerHTML+="<div class='article' id='article"+articles[i]['id']+"' onClick='showArticle(this)'>TITLE: "+articles[i]['title']+"<br>"+"AUTHOR: "+articles[i]['author']+"<br>"+"DATE: "+articles[i]['time']+"<br>"+"HEADLINE:<br>"+articles[i]['headline']+"<br>"+"ARTICLE:<br>"+articles[i]['article']+"<br><br>"+"PICTURE: "+articles[i]['url']+"<br>";articles
			}
		}
	}

	req.open("GET",url,true);
	req.send();
}


function showUserForm(user){
	var req=new XMLHttpRequest();
	var url="site_content/userform.html";

	req.onreadystatechange=function(){
		if(req.readyState===4 && req.status===200){
			document.getElementById('Form').innerHTML="";
			document.getElementById('Form').innerHTML=req.responseText;
			document.getElementById('Form').style.display="block";
			document.getElementById('userbox').value=user['username'];
			document.getElementById('namebox').value=user['name'];
			document.getElementById('emailbox').value=user['email'];
			document.getElementById('datebox').value=user['date'];
			document.getElementById('countrybox').value=user['country'];
			if(user['gender']==='male')
				document.getElementById('malebox').checked=true;
			else
				document.getElementById('femalebox').checked=true;
			document.getElementById('idbox').value=user['id'];
			if(user['admin']!=0)
				document.getElementById('adminbox').checked=true;
			else
				document.getElementById('adminbox').checked=false;

		}
	}
	req.open("GET",url,true);
	req.send();

}

function showUser(item){
	var element_id=item.id;
	var id=parseInt(element_id.replace('user',''));
	var req=new XMLHttpRequest();
	var url="php/userService.php?";

	req.onreadystatechange=function(){
		if(req.readyState===4 && req.status===200){
			var user=JSON.parse(req.responseText);
			showUserForm(user);
		}
	}

	req.open("GET",url+"id="+id,true);
	req.send();
}

function showComment(item){
	var element_id=item.id;
	var id=parseInt(element_id.replace('comment',''));
	var req=new XMLHttpRequest();
	var url="php/commentsService.php?";

	req.onreadystatechange=function(){
		if(req.readyState===4 && req.status===200){
			var comment=JSON.parse(req.responseText);
			showCommentForm(comment);
		}
	}

	req.open("GET",url+"id="+id,true);
	req.send();
}

function showCommentForm(comment){
	var req=new XMLHttpRequest();
	var url="site_content/commentform.html";

	req.onreadystatechange=function(){
		if(req.readyState===4 && req.status===200){
			document.getElementById('Form').innerHTML="";
			document.getElementById('Form').innerHTML=req.responseText;
			document.getElementById('Form').style.display="block";
			document.getElementById('authorbox').value=comment['author'];
			document.getElementById('emailbox').value=comment['email'];
			document.getElementById('commentbox').value=comment['comment'];
			document.getElementById('articlebox').value=comment['article'];
			document.getElementById('idbox').value=comment['id'];
		}
	}
	req.open("GET",url,true);
	req.send();

}


function showArticle(item){
	var element_id=item.id;
	var id=parseInt(element_id.replace('article',''));
	var req=new XMLHttpRequest();
	var url="php/articlesService.php?";

	req.onreadystatechange=function(){
		if(req.readyState===4 && req.status===200){
			var article=JSON.parse(req.responseText);
			showArticleForm(article);
		}
	}

	req.open("GET",url+"id="+id,true);
	req.send();
}

function showArticleForm(article){
	var req=new XMLHttpRequest();
	var url="site_content/articleform.html";

	req.onreadystatechange=function(){
		if(req.readyState===4 && req.status===200){
			document.getElementById('Form').innerHTML="";
			document.getElementById('Form').innerHTML=req.responseText;
			document.getElementById('Form').style.display="block";
			document.getElementById('titlebox').value=article['title'];
			document.getElementById('authorbox').value=article['author'];
			document.getElementById('headlinebox').value=article['headline'];
			document.getElementById('articlebox').value=article['article'];
			document.getElementById('picturebox').value=article['url'];
			document.getElementById('idbox').value=article['id'];
		}
	}
	req.open("GET",url,true);
	req.send();

}

function logoutForm(){
	var form=document.getElementById('logoutform');
	form.submit();
}

