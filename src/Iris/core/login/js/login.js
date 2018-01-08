function submit_form() {
	var loginform = document.getElementById("login_form");
	if (loginform.location.value == "") {
		var location = window.location.href.slice(0, window.location.href.lastIndexOf("/"));
		loginform.location.value = location;
	}
}

jQuery(document).ready(function() {
  jQuery("#toggle-extra-options").on("click", function() {
    var container = jQuery('#collapse');
    var method = container.is(":visible") ? "hide" : "show";
    var timeoutMs = 100;

    container[method](timeoutMs);
  });
});
