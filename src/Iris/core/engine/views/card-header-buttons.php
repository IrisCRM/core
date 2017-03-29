<?php 
/**
 * Кнопки на карточке, которые добавляются из конфигурации
 */
?>
<script type="text/template" id="card-header-buttons"> 
<% _.each(data, function(item) { 
  %><span class="card_top_panel_button <%= item['class'] %>" onclick="<%= item.onclick %>" captions_json="<%= item.captions_json %>" actions_json="<%= item.actions_json %>" title="<%= item.title %>"><%= item.name %></span><% 
}); %>
</script>