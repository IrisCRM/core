<script type="text/template" id="dialog"> 
<div class="flexbox-container flexbox-direction-column" style="height: 100%">
  <div class="flexbox-item-wide flexbox-container flexbox-direction-column flexbox-align-center flexbox-justify-center horizontal-gutter"><%= data.content %></div>
  <div class="text-center">
  <% _.each(data.buttons, function(item) { %>
    <input type="button" class="btn btn-default btn-sm" value="<%= item.name %>" onclick="<%= item.onclick %>"> 
  <%}); %>
  </div>
</div>
</script>