var check=true;
function addSubMenu(item){
	if(check)
	{
		item.innerHTML=item.innerHTML +" <li><a href=\"#\">Comedy</a></li> <li><a href=\"#\">Crime</a></li> <li><a href=\"#\">Drama</a></li> <li><a href=\"#\">Sci-fi</a></li>";
		check=false;
	}

}


function removeSubMenu(item){
	if(!check)
	{
		item.innerHTML="<li class=\"navmain\"><a href=\"recommended.html\">Recommended shows</a></li>";
		check=true;
	}

}