<script type="text/template" id="grid-buttons"> 
<% _.each(data, function(item) { %><input type="button" class="btn btn-default btn-sm <%= item['class'] %>" value="<%= item.name %>" onclick="<%= item.onclick %>" captions_json="<%= item.captions_json %>" actions_json="<%= item.actions_json %>"/><% }); %>
</script>