function edit() {
	var main = document.getElementById("main");
	var edit = document.getElementById("edit-section");
	edit.style.display = "block";
	main.style.display = "none";

	
}

function save_edit(){
	//write code to change document elements to match enetered content
	var main = document.getElementById("main");
	var edit = document.getElementById("edit-section");
	var image = document.getElementById('profile_pic');
	image.src = URL.createObjectURL(document.getElementById("file-input").files[0]);
	document.getElementById("name_text").innerHTML = document.getElementById("fullname").value;
	document.getElementById("major_text").innerHTML = "Major: "+document.getElementById("majorinput").value;
	document.getElementById("year_text").innerHTML = "Class of: "+document.getElementById("yearinput").value;
	document.getElementById("linkedin_link").href = document.getElementById("linkedin_url").value;
	document.getElementById("github_link").href = document.getElementById("github_url").value;
	document.getElementById("bio_text").innerHTML = "About Me: "+document.getElementById("about").value;
	document.getElementById("skills_text").innerHTML = "Skills: "+document.getElementById("skills").value;

	
	main.style.display = "flex";
	edit.style.display = "none";
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
	
	
}