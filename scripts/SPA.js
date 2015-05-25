

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
			}
		}
	}
	req.open("GET",url,true);
	req.send();
}


function setNews(index){
	var req = new XMLHttpRequest();
	url="read.php?news_id="
	req.onreadystatechange=function(){
		if(req.readyState==4 && req.status==200){
			var article=JSON.parse(req.responseText);
			document.getElementById("newsimg").src=article['link'];
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