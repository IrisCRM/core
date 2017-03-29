<script type="text/template" id="field-ext-button">
<td style="width: 21px;">
  <a id="<%= data.buttonId %>Link" href="#" title="<%= data.title %>" onclick="<%= data.onClick %>" id_primary="<%= data.fieldId %>">
    <div id="<%= data.buttonId %>" class="<% 
      if (data.fieldId == 'Skype') { 
        %>skype_img<% 
      }
      else if (data.iconClass == 'envelope') { 
      	%>email_img<% 
      }
      else { 
      	%><%= data.iconClass %><% 
      } %>"></div>
  </a>
</td>
</script>