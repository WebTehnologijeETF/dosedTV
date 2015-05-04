var shows=[{naziv:"SUPERNATURAL",opis:"Two brothers follow their father's footsteps as 'hunters' fighting evil supernatural beings of many kinds including monsters, demons, and gods that roam the earth.",slika:"http://images5.fanpop.com/image/photos/30500000/Supernatural-supernatural-30545991-1680-1050.jpg"},
		   {naziv:"SUPERNATTTURAL",opis:"Two brothers follow their father's footsteps as 'hunters' fighting evil supernatural beings of many kinds including monsters, demons, and gods that roam the earth.",slika:"http://images5.fanpop.com/image/photos/30500000/Supernatural-supernatural-30545991-1680-1050.jpg"}];

function replacePage(url)
{
	var req = new XMLHttpRequest();
	req.onreadystatechange=function(){
		if(req.readyState==4 && req.status==200){
			document.getElementById("content").innerHTML=req.responseText;
			if(url=='allshows.html'){
				populateTable(shows);
			}
		}
	}
	req.open("GET",url,true);
	req.send();
}