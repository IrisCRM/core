<script type="text/template" id="field-ext-button"> 
<div class="input-group input-group-sm">
  <%= data.field %>
  <span class="input-group-btn">
    <button class="btn btn-default btn-sm button" title="<%= data.title %>" onclick="<%= data.onClick %>" id="<%= data.buttonId %>" id_primary="<%= data.fieldId %>">
      <span class="glyphicon glyphicon-<%= data.iconClass %>"></span>
    </button>
  </span>
</div>
</script>