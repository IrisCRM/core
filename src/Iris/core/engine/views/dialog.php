<script type="text/template" id="dialog"> 
<form>
  <table class="form_table" style="width: 100%; height: 100%">
    <tbody>
      <tr class="form_row">
        <td class="form_table" style="height: 100%; vertical-align: middle;"><%= 
          data.content
        %></td>
      </tr>
      <tr>
        <td>
          <table class="form_table_buttons_panel">
            <tbody>
              <tr>
                <td style="vertical-align: middle;"></td>
                <td align="right"><% 
                  _.each(data.buttons, function(item) { 
                  %><input type="button" class="button" value="<%= item.name %>" onclick="<%= item.onclick %>"><% 
                  }); %></td>
              </tr>
            </tbody>
          </table>
        </td>
      </tr>
    </tbody>
  </table>
</form>
</script>