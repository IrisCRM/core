<?php 
/**
 * Панель итогов в таблице
 */
?>
<script type="text/template" id="grid-summary">
<table id="<%= data.id %>_summary" class="total">
  <tbody>
    <tr class="summary">
      <td>
        <table>
          <tbody>
            <tr class="summary">
              <% _.each(data.items, function(item) { 
                %><td class="grid_row" width="<%= item.width %>"><%= item.total %></td><% 
              }); %>
            </tr>
          </tbody>
        </table>
      </td>
      <td width="<%= data.scrollbar_width %>">&nbsp;</td>
    </tr>
  </tbody>
</table>
</script>