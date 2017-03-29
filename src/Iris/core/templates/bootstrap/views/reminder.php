<script type="text/template" id="reminder"> 
<ul class="nav nav-pills"><% _.each(data, function(item) { 
	%><li class="alert<%= item.count > 0 ? ' alert-danger blink' : ' zero' 
	%>" onclick="<%= item.onclick 
	%>"<%= item.description != '' ? ' title="' + item.description + '"' : '' 
	%>><p><span class="label<%= item.count > 0 ? ' label-default' : '' 
	%>"><%= item.name 
		%></span></p><p><span class="badge"><%= item.count 
	%></span></p></li><% 
}); %></ul>
</script>