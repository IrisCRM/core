<?php 
/**
 * Контейнер для отображения контента внутри строки грида
 */
?>
<script type="text/template" id="grid-record-wrapper">
  <tr class="record_wrapper_js" parent_id="<%= data.id %>">
    <td colspan="<%= data.columns %>">
      <div class="content_wrapper content_wrapper_js"><%= data.content %></div>
    </td>
  </tr>
</script>