
function validateCountry(){
	var country=document.getElementById("country").value

	var req=new XMLHttpRequest();

	req.onreadystatechange=function(){
		if(req.readyState==4 && req.status==200){
			var response=JSON.parse(req.responseText);
			document.getElementById("country").value=response[0].name;
			document.getElementById("epic6").style.visibility="hidden"
		}
		else if(req.status==404){
			document.getElementById("epic6").style.visibility="visible"
		}
	}
	var url="https://restcountries.eu/rest/v1/name/"+country;
	req.open("GET",url,true);
	req.send();
}


function checkCountry(){
	validateCountry();
	return(document.getElementById("epic6").style.visibility == "visible")
}

function showError(control){
	if(control.id==="epic1"){
		document.getElementById("epic1m").style.visibility="visible";
	}
	if(control.id==="epic2" || control.id==="epic3"){
		if(passchoice){
			document.getElementById("epic2m").innerHTML="Passwords do not match.";
			document.getElementById("epic3m").innerHTML="Passwords do not match.";
			document.getElementById("epic2m").style.visibility="visible";
			document.getElementById("epic3m").style.visibility="visible";
		}
		else {
			document.getElementById("epic2m").innerHTML="Password must be bigger than 3 characters.";
			document.getElementById("epic2m").style.visibility="visible";
		}
	}

	if(control.id==="epic4"){
		document.getElementById("epic4m").style.visibility="visible";
	}

	if(control.id==="epic6"){
		document.getElementById("epic6m").style.visibility="visible";
	}
}

function hideError(control){
	document.getElementById(control.id+"m").style.visibility="hidden";
	if(control.id==="epic3" || control.id==="epic2"){
		document.getElementById("epic3m").style.visibility="hidden";
		document.getElementById("epic2m").style.visibility="hidden";
	}
}


var passchocie=false;

function validatePassword()
{	
	var pass1=document.getElementById("pass1").value;
	var pass2=document.getElementById("pass2").value;
	if(pass1!=pass2)
	{
		passchoice=true;
		document.getElementById("epic3").style.visibility="visible";
		document.getElementById("epic2").style.visibility="visible";
		return true;
	}
	else if(pass1.length<3)
	{
		passchoice=false;
		document.getElementById("epic3").style.visibility="visible";
		document.getElementById("epic2").style.visibility="visible";
		return true;
	}
	else
	{	
		passchoice=false;
		document.getElementById("epic3").style.visibility="hidden";
		document.getElementById("epic2").style.visibility="hidden";
		return false;
	}
}

function validateEmail(){
	var regex=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	var email=document.getElementById("email").value
	if(!regex.test(email))
	{
		document.getElementById("epic4").style.visibility="visible";
		return true;
	}
	else
	{
		document.getElementById("epic2").style.visibility="hidden";
		return false;
	}
}

function validateUsername(){
	var username=document.getElementById("username").value;
	var temp=false;
	username == "" ? temp=false : temp=true;
	for(i=0;i<username.length;i++){
		if(!((username.charCodeAt(i)>=65 && username.charCodeAt(i)<=90)||(username.charCodeAt(i)>=97 && username.charCodeAt(i)<=122)))
			temp=false;
	}
	if(!temp){
		document.getElementById("epic1").style.visibility="visible";
		return true;
	}
	else
	{
		document.getElementById("epic1").style.visibility="hidden";
		return false;
	}
}

function validateFields(){
	return !(validateUsername() || validatePassword() || validateEmail() || checkCountry());

}