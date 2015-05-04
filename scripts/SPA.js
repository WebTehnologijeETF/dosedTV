

function replacePage(url)
{
	var req = new XMLHttpRequest();
	req.onreadystatechange=function(){
		if(req.readyState==4 && req.status==200){
			document.getElementById("content").innerHTML=req.responseText;
			if(url=='site_content/allshows.html'){
				readObjects();
			}
		}
	}
	req.open("GET",url,true);
	req.send();
}