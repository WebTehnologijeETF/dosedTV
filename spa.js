function replacePage(url)
{
	var req = new XMLHttpRequest();
	req.onreadystatechange=function(){
		if(req.readyState==4 && req.status==200){
			document.open();
			document.write(req.responseText);
			document.close();
		}
	}
	req.open("GET",url,true);
	req.send();
}