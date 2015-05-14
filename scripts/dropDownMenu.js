var check=true;
function addSubMenu(){
	if(check)
	{
		item=document.getElementById("navcol");
		item.innerHTML=item.innerHTML +" <li><a href=\"#\">Comedy</a></li> <li><a href=\"#\">Crime</a></li> <li><a href=\"#\">Drama</a></li> <li><a href=\"#\">Sci-fi</a> <li onClick=\"replacePage('site_content/allshows.html')\"><a href='#''>Browse all shows</a></li>";
		item.parentNode.style.backgroundColor = 'rgba(211,211,211,0.2)'
		check=false;
	}

}

function test(){
	console.log("test");
	visibility=document.getElementById('logindata').style.visibility;
	if(visibility=="hidden"){
		document.getElementById('logindata').style.visibility="visible";
	}
	else{
		document.getElementById('logindata').style.visibility="hidden";
	}
}


function removeSubMenu(){
	if(!check)
	{
		item=document.getElementById("navcol");
		item.innerHTML="<li  onClick=\"replacePage('site_content/recommended.html')\" class=\"navmain\"><a href='#'>Recommended shows</a></li>";
		item.parentNode.style.backgroundColor = 'rgba(211,211,211,0.0)'
		check=true;
	}

}