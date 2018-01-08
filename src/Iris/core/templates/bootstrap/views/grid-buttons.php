<script type="text/template" id="grid-buttons"> 
<% _.each(data, function(item) { %>
  <% if (!item.buttons) { %>
    <input type="button" class="btn btn-default btn-sm <%= item['class'] %>" value="<%= item.name %>" onclick="<%= item.onclick %>" captions_json="<%= item.captions_json %>" actions_json="<%= item.actions_json %>"/>
  <% } else { %>
    <div class="btn-group dropup">
      <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <%= item.name.split('&hellip;').join('') %>
        <span class="caret"></span>
      </button>
      <ul class="dropdown-menu">
      <% _.each(item.buttons, function(dropdownItem) { %>
        <li><a href="#" onclick="<%= dropdownItem.onclick %>"><%= dropdownItem.name %></a></li>
      <% });%>
      </ul>
    </div>
  <% } %>
<% });%>
</script>