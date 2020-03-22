function edit() {
	var main = document.getElementById("main");
	var edit = document.getElementById("edit-section");
	edit.style.display = "block";
	main.style.display = "none";

	
}

function share(){
	var link = document.getElementById("view_profile").href;
		//document.getElementById("view_profile").href
	var Url = document.createElement("textarea");
    Url.innerHTML = link;
    Url.select();
	document.execCommand("copy");
	//   document.body.removeChild(Url);

}

function openDM(){
	//sprint 3 functionality
	
}