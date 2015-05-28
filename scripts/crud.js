function deleteArticleNews(){
	var req= new XMLHttpRequest();
	var url="php/articlesService.php";
	req.onreadystatechange=function(){
		if(req.readyState===4 && req.status===200){
		}
	}
	var id=document.getElementById("idbox").value;
	var title=document.getElementById("titlebox").value;
	var author=document.getElementById("authorbox").value;
	var headline=document.getElementById("headlinebox").value;
	var picurl=document.getElementById("picturebox").value
	var article=document.getElementById("articlebox").value;

	req.open("POST",url,true);
	req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	req.send("action=delete&id="+id);
	//req.send("action=delete"+"&title="+title+"&author="+author+"&headline="+headline+"&article="+article+"&url="+picurl+"&id="+id);
}

function createArticleNews(){
	var req= new XMLHttpRequest();
	var url="php/articlesService.php";
	req.onreadystatechange=function(){
		if(req.readyState===4 && req.status===200){
		}
	}
	var id=document.getElementById("idbox").value;
	var title=document.getElementById("titlebox").value;
	var author=document.getElementById("authorbox").value;
	var headline=document.getElementById("headlinebox").value;
	var picurl=document.getElementById("picturebox").value
	var article=document.getElementById("articlebox").value;

	req.open("POST",url,true);
	req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	req.send("action=create"+"&title="+title+"&author="+author+"&headline="+headline+"&article="+article+"&url="+picurl+"&id="+id);
}

function updateArticleNews(){
	var req= new XMLHttpRequest();
	var url="php/articlesService.php";
	req.onreadystatechange=function(){
		if(req.readyState===4 && req.status===200){
		}
	}
	var id=document.getElementById("idbox").value;
	var title=document.getElementById("titlebox").value;
	var author=document.getElementById("authorbox").value;
	var headline=document.getElementById("headlinebox").value;
	var picurl=document.getElementById("picturebox").value
	var article=document.getElementById("articlebox").value;

	req.open("POST",url,true);
	req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	req.send("action=update"+"&title="+title+"&author="+author+"&headline="+headline+"&article="+article+"&url="+picurl+"&id="+id);
}

function createCommentS(){
	var req = new XMLHttpRequest();
	var url = "php/commentsService.php";
	var name=document.getElementById("authorbox").value;
	var email=document.getElementById("emailbox").value;
	var comment=document.getElementById("commentbox").value;
	var article=document.getElementById("articlebox").value;
	req.onreadystatechange=function(){
		if(req.readyState===4 && req.status===200){
		}
	}

	req.open("POST",url,true);
	req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	req.send("action=create"+"&author="+name+"&email="+email+"&comment="+comment+"&article="+article);
}

function updateComment(){
	var req = new XMLHttpRequest();
	var url = "php/commentsService.php";
	var name=document.getElementById("authorbox").value;
	var email=document.getElementById("emailbox").value;
	var comment=document.getElementById("commentbox").value;
	var article=document.getElementById("articlebox").value;
	var id=document.getElementById('idbox').value;
	req.onreadystatechange=function(){
		if(req.readyState===4 && req.status===200){
		}
	}


	console.log("action=update"+"&author="+name+"&email="+email+"&comment="+comment+"&article="+article+"&id="+id);
	req.open("POST",url,true);
	req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	req.send("action=update"+"&author="+name+"&email="+email+"&comment="+comment+"&article="+article+"&id="+id);

}

function deleteComment(){
	var req = new XMLHttpRequest();
	var url = "php/commentsService.php";
	var name=document.getElementById("authorbox").value;
	var email=document.getElementById("emailbox").value;
	var comment=document.getElementById("commentbox").value;
	var article=document.getElementById("articlebox").value;
	var id=document.getElementById('idbox').value;
	req.onreadystatechange=function(){
		if(req.readyState===4 && req.status===200){
		}
	}

	req.open("POST",url,true);
	req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	req.send("action=delete"+"&id="+id);
}

function createUser(){
	var req = new XMLHttpRequest();
	var url = "php/userService.php";
	var username=document.getElementById('userbox').value;
	var name=document.getElementById('namebox').value;
	var email=document.getElementById('emailbox').value;
	var date=document.getElementById('datebox').value;
	var country=document.getElementById('countrybox').value;
	var gender="none";
	if(document.getElementById("malebox").checked)
	gender='male';
	else
	gender='female';

	req.onreadystatechange=function(){
		if(req.readyState===4 && req.status===200){
			alert("default password: pass");
		}
	}

	req.open("POST",url,true);
	req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	req.send("action=create"+"&username="+username+"&name="+name+"&email="+email+"&date="+date+"&country="+country+"&gender="+gender);

}

function deleteUser(){
	var req = new XMLHttpRequest();
	var url = "php/userService.php";
	var username=document.getElementById('userbox').value;
	var name=document.getElementById('namebox').value;
	var email=document.getElementById('emailbox').value;
	var date=document.getElementById('datebox').value;
	var country=document.getElementById('countrybox').value;
	var gender="none";
	if(document.getElementById("malebox").checked)
	gender='male';
	else
	gender='female';
	var id=document.getElementById('idbox').value;

	req.onreadystatechange=function(){
		if(req.readyState===4 && req.status===200){
		}
	}

	req.open("POST",url,true);
	req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	req.send("action=delete"+"&id="+id);
}

function updateUser(){
	var req = new XMLHttpRequest();
	var url = "php/userService.php";
	var username=document.getElementById('userbox').value;
	var name=document.getElementById('namebox').value;
	var email=document.getElementById('emailbox').value;
	var date=document.getElementById('datebox').value;
	var country=document.getElementById('countrybox').value;
	var gender="none";
	if(document.getElementById("malebox").checked)
	gender='male';
	else
	gender='female';
	var id=document.getElementById('idbox').value;

	req.onreadystatechange=function(){
		if(req.readyState===4 && req.status===200){
		}
	}

	req.open("POST",url,true);
	req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	req.send("action=update"+"&username="+username+"&name="+name+"&email="+email+"&date="+date+"&country="+country+"&gender="+gender+"&id="+id)
}