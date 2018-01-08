<?php 
/**
 * Кнопки на карточке, которые добавляются из конфигурации
 */
?>
<script type="text/template" id="card-header-buttons"> 
<% _.each(data, function(item) { %>
  <% if (!item.buttons) { %>
    <a href="#" onclick="<%= item.onclick %>" title="<%= item.title || '' %>"><%= item.name %></a>
  <% } else { %>
    <span class="dropdown">
      <a class="dropdown-toggle" href="#" type="button" data-toggle="dropdown">
        <%= item.name %>
        <!-- <span class="caret"></span> -->
      </a>
      <ul class="dropdown-menu">
      <% _.each(item.buttons, function(dropdownItem) { %>
        <li><a href="#" onclick="<%= dropdownItem.onclick %>" title="<%= dropdownItem.title || '' %>"><%= dropdownItem.name %></a></li>
      <% });%>
      </ul>
    </span>
  <% } %>
<% }); %>
</script>