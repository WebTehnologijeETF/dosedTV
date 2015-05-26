

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
	url="getComments.php?news_id=";

	req.onreadystatechange=function(){
		if(req.readyState==4 && req.status==200){

			var section=document.getElementById('commentSection');
			section.innerHTML="";
			var comments=JSON.parse(req.responseText);
			if(comments.length==0){
				document.getElementById('commentLink').innerHTML="No comments";
			}
			else{
				document.getElementById('commentLink').innerHTML="Show "+comments.length+" comments";	
				for(var i=0;i<comments.length;i++){
					section.innerHTML+="<div class='comment'>Author: "+comments[i]['author']+"<br>"+comments[i]['time']+"<br>"+comments[i]['comment']+"<br><hr></div>";
				}
			}
		}
	}
	req.open("GET",url+index,true);
	req.send();
}

function setNews(index){
	var req = new XMLHttpRequest();
	url="read.php?news_id=";
	req.onreadystatechange=function(){
		if(req.readyState==4 && req.status==200){
			var article=JSON.parse(req.responseText);
			document.getElementById("newsimg").src=article['url'];
			document.getElementById("newstitle").innerHTML=article['title'];
			document.getElementById("newsauthor").innerHTML=article['author'];
			document.getElementById("newsdate").innerHTML=article['date'];
			document.getElementById("newsshort").innerHTML=article['headline'];
			document.getElementById("newslong").innerHTML=article['article'];
		}
	}

	req.open("GET",url+index,true);
	req.send();
}

function toggleComments(){
	document.getElementById("commentSection").style.display="block";
	document.getElementById('commentLink').innerHTML="Comments";
}