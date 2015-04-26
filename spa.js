function getXML()
{
	var req = new XMLHttpRequest();
	var site="recommended.html";
	req.onreadystatechange=function(){
		if(req.readyState==4 && req.status==200){
			console.log(req.responseXML.documentElement);
		}
	}

	req.open("GET",site,true);
	req.send();
}