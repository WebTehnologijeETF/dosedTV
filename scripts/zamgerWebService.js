
var zamgerurl="http://zamger.etf.unsa.ba/wt/proizvodi.php?brindexa=16487";
var optionsShowed=false;
var optionsLabel="Name of the show <p>Description </p> <p>Picture </p>";
var optionsInput="<input id='showName' type='text'> <input id='showDesc' type='text'> <input id='showPic' type='text'>";
var clicked=-1;


//            TABLE MANIPULATION            /////
/////////////////////////////////////////////////
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
	return "<td><img class='imgWS' src='"+url+"'></td>";
}

function getRow(num,name,desc,url){
	var type=""
	if(num%2===1) type="troneWS"; else type="trtwoWS";
	return "<tr id='row_id_"+num+"' onClick='populateFields(this)' class='"+type+"'>"+ getNameColumn(name) + getDescColumn(desc) + getImgColumn(url) + "</tr>";
}

function populateFields(row){
	var row_strings=row.id.split('_')
	show=shows[parseInt(row_strings[2])-1];
	updatingOptions(parseInt(row_strings[2]));	
	if(optionsShowed){
		document.getElementById("showName").value=show.naziv;
		document.getElementById("showDesc").value=show.opis;
		document.getElementById("showPic").value=show.slika;
		document.getElementById("showID").value=show.id;		
	}
}

function populateTable(objects){
	var table=document.getElementById("tableWS");
	table.innerHTML=getEmptyTable();
	for(i = 0; i<objects.length; i++)
		table.innerHTML+=getRow(i+1,objects[i].naziv,objects[i].opis,objects[i].slika);
	table.innerHTML+="<tr class='blankrow'><td colspan='7'></td></tr>";
}

/////////////////////////////////////////////////
/////////////////////////////////////////////////


//           WWEB SERVICE FUNCTIONS         /////
/////////////////////////////////////////////////

function clearShows()
{
	var link= "http://zamger.etf.unsa.ba/wt/proizvodi.php?brindexa=16487";
	var req = new XMLHttpRequest();

	for(i=0;i<shows.length;i++){
		console.log(JSON.stringify(shows[i]));
		req.open("POST","http://zamger.etf.unsa.ba/wt/proizvodi.php?brindexa=16487",true);
		req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		req.send("akcija=brisanje" + "&brindexa=16487&proizvod=" + JSON.stringify(shows[i]));
	}
}


function readObjects(){
	var link="http://zamger.etf.unsa.ba/wt/proizvodi.php?brindexa=16487";
	var req=new XMLHttpRequest();

	req.onreadystatechange=function(){
		if(req.readyState==4 && req.status==200){
			shows = JSON.parse(req.responseText);
			populateTable(shows);
		}
	}

	req.open("GET","http://zamger.etf.unsa.ba/wt/proizvodi.php?brindexa=16487",true);
	req.send();
}

function deleteObject(id,name,desc,url){
	
	var show={
		id:id,
		naziv:name,
		opis:desc,
		slika:url
	};

	var req=new XMLHttpRequest();
	req.onreadystatechange=function(){
		if(req.readyState===4 && req.status===200){
			alert("Show deleted!");
			readObjects();
		}
	}

	req.open("POST", zamgerurl, true);
	req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	req.send("akcija=brisanje"+"&brindexa=16487"+"&proizvod="+JSON.stringify(show));

}


function updateObject(id,name,desc,url){
	
	var show={
		id:id,
		naziv:name,
		opis:desc,
		slika:url
	};

	var req=new XMLHttpRequest();
	req.onreadystatechange=function(){
		if(req.readyState===4 && req.status===200){
			alert("Show updated!");
			readObjects();
		}
	}

	req.open("POST", zamgerurl, true);
	req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	req.send("akcija=promjena"+"&brindexa=16487"+"&proizvod="+JSON.stringify(show));
}

function postObject(name,desc,pic){
	show={
		naziv:name,
		opis:desc,
		slika:pic
	};

	req=new XMLHttpRequest();

	req.onreadystatechange=function(){
		if(req.status===200 && req.readyState===4){
			alert("Show added");
			readObjects();
		}
	}
	req.open("POST", zamgerurl,true);
	req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	req.send("akcija=dodavanje"+"&brindexa=16487&proizvod="+JSON.stringify(show));
}

/////////////////////////////////////////////////
/////////////////////////////////////////////////


//////          FORM FUNCTIONS               /////
/////////////////////////////////////////////////

function validateName(){
	name=document.getElementById("showName").value
	return name.length>0;
}

function validateDesc(){
	desc=document.getElementById("showDesc").value;
	return desc.length>0
}

function validateUrl(){
	url=document.getElementById("showPic").value;
	urlregex=/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/;
	return urlregex.test(url);
}


function createShow(){
	var name="";
	var desc="";
	var pic="";
	if(validateName() && validateDesc() && validateUrl()){
		name=document.getElementById("showName").value;
		desc=document.getElementById("showDesc").value;
		pic=document.getElementById("showPic").value
		postObject(name,desc,pic);
		return true;
	}
	return false;
}

function updateShow(){
	var name="";
	var desc="";
	var pic="";

	if(validateName() && validateDesc() && validateUrl()){
		name=document.getElementById("showName").value;
		desc=document.getElementById("showDesc").value;
		pic=document.getElementById("showPic").value
		id=document.getElementById("showID").value
		updateObject(id,name,desc,pic);
		return true;
	}
	return false;
	clearOptions();
}


function deleteShow(){
	var name="";
	var desc="";
	var pic="";

	if(validateName() && validateDesc() && validateUrl()){
		name=document.getElementById("showName").value;
		desc=document.getElementById("showDesc").value;
		pic=document.getElementById("showPic").value
		id=document.getElementById("showID").value
		deleteObject(id,name,desc,pic);
		return true;
	}
	return false;
	clearOptions();
}



function clearOptions(){
	var options=document.getElementById("showOptions");
	options.innerHTML="<div id='showOptionsLabel'></div> <div id='showOptionsInput'></div>";
	
	var label=document.getElementById("showOptionsLabel");
	var input=document.getElementById("showOptionsInput");	
	label.innerHTML="";
	input.innerHTML="";
	options.style.display="none";
	optionsShowed=false;
}

function addingOptions(){
	var options=document.getElementById("showOptions");
	
	if(!optionsShowed || clicked!=-1){
		options.innerHTML="<div id='showOptionsLabel'></div> <div id='showOptionsInput'></div>";
		document.getElementById("showOptionsLabel").innerHTML=optionsLabel;
		document.getElementById("showOptionsInput").innerHTML=optionsInput;
		options.style.display="block";
		options.innerHTML+="<input type='button' onClick='createShow()' value='Add show'>";
		optionsShowed=true;
		if(clicked!=-1)
			clicked=-1;
	}
	else{
		clearOptions();	
	}
}

function updatingOptions(row_num){
	var options=document.getElementById("showOptions");

	if(optionsShowed && clicked==row_num){
		clearOptions();
		clicked=-1;
	}
	else{
		options.innerHTML="<div id='showOptionsLabel'></div> <div id='showOptionsInput'></div>";
		options.style.display="block";
		document.getElementById("showOptionsLabel").innerHTML=optionsLabel+"<p>ID</p>";
		document.getElementById("showOptionsInput").innerHTML+=optionsInput+"<input id='showID' type='text' disabled>";
		options.innerHTML+="<input type='button' onClick='updateShow()' value='Update show' style='padding:5px;'>";
		options.innerHTML+="<input type='button' onClick='deleteShow()' value='Delete show' style='padding:5px; margin-left:10px;'>";
		optionsShowed=true;
		clicked=row_num;
	}
	
}


/////////////////////////////////////////////////
/////////////////////////////////////////////////