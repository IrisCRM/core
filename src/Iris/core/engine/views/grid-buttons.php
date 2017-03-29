<?php 
/**
 * Кнопки на панели таблицы, которые добавляются из конфигурации
 */
?>
<script type="text/template" id="grid-buttons"> 
<% _.each(data, function(item) { 
  %><td><input type="button" class="button <%= item['class'] %>" value="<%= item.name %>" onclick="<%= item.onclick %>" captions_json="<%= item.captions_json %>" actions_json="<%= item.actions_json %>"/></td><% 
}); %>
</script>