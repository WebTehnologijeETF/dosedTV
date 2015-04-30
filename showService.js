function getEmptyTable(){
	return "<tr class='weekdaysWS'><th class='odays'>TV Show</th><th class='odays'>Description</th><th class='odays'>Picture</th></tr>";
}

function getNameColumn(name)
{
	return "<td class='nameWS'>" + name + "</td>";
}

function getDescColumn(desc)
{
	return "<td class='descWS'>" + desc + "</td>";
}

function getImgColumn(url)
{
	return "<td><img class='imgWS' src='" + url + "'></td>";
}

function getRow(num,name,desc,url){
	var type=""
	if(num%2===1) type="troneWS"; else type="trtwoWS";
	return "<tr class='"+type+"'>"+ getNameColumn(name) + getDescColumn(desc) + getImgColumn(url) + "</tr>";
}


function populateTable(objects){
	var table=document.getElementById("tableWS");
	table.innerHTML=getEmptyTable();
	for(i = 0; i<objects.length; i++)
		table.innerHTML+=getRow(i+1,objects[i].naziv,objects[i].opis,objects[i].url);
	table.innerHTML+="<tr class='blankrow'><td colspan='7'></td></tr>";
}


function readObjects(){
	/*var link="http://zamger.etf.unsa.ba/wt/proizvodi.php?brindexa=16487";
	var req=new XMLHttpRequest();

	req.onreadystatechange=function(){
		if(req.readyState==4 && req.status==200){
			var shows = JSON.parse(req.responseText);
			populateTable(shows);
		}
	}

	req.open("GET","http://zamger.etf.unsa.ba/wt/proizvodi.php?brindexa=16487",true);
	req.send();*/
}

function postObject(){
	link = "http://zamger.etf.unsa.ba/wt/proizvodi.php?brindexa=16487"
	naziv = "supernatural"
	opis = "horror serija"
	url = "www.imdb.com"
	var test = {
		naziv: naziv,
		opis: opis,
		url: url
	};

	alert(JSON.stringify(test));

	var req=new XMLHttpRequest();

	req.readystatechange=function(){
		if(req.readyState===4 && req.status===400)
			alert("Uspješno");
	}
	req.open("POST","http://zamger.etf.unsa.ba/wt/proizvodi.php?brindexa=16487",true);
	req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	req.send("akcija=dodavanje" + "&brindexa=16487&proizvod=" + JSON.stringify(test));
}