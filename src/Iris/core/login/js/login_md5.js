function submit_form_md5() {
	var loginform = document.getElementById("login_form");
	if (loginform.location.value == "") {
		var location = window.location.href.slice(0, window.location.href.lastIndexOf("/"));
		loginform.location.value = location;
	}
	loginform.password.value = hex_md5(hex_md5(loginform.password.value)+loginform.token.value);
}
