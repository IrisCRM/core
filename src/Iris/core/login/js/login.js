function submit_form() {
	var loginform = document.getElementById("login_form");
	if (loginform.location.value == "") {
		var location = window.location.href.slice(0, window.location.href.lastIndexOf("/"));
		loginform.location.value = location;
	}
}
