var check=true;
function addSubMenu(){
	if(check)
	{
		item=document.getElementById("navcol");
		item.innerHTML=item.innerHTML +" <li><a href=\"#\">Comedy</a></li> <li><a href=\"#\">Crime</a></li> <li><a href=\"#\">Drama</a></li> <li><a href=\"#\">Sci-fi</a></li>";
		item.parentNode.style.backgroundColor = 'rgba(211,211,211,0.2)'
		check=false;
	}

}


function removeSubMenu(){
	if(!check)
	{
		item=document.getElementById("navcol");
		item.innerHTML="<li class=\"navmain\"><a href=\"recommended.html\">Recommended shows</a></li>";
		item.parentNode.style.backgroundColor = 'rgba(211,211,211,0.0)'
		check=true;
	}

}