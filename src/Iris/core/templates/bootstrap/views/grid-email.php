<?php 
/**
 * Отображение письма в таблице
 */
?>
<script type="text/template" id="grid-email">
    <div class="mail_header">
        <div class="mail_header_title mail_header_title_js">
            <h2><%- subject || 'Без темы' %> <small><%- contactName %> | <%- accountName %>
                <input type="button" class="btn btn-default" value="Ответить" onclick="<%= instanceName %>.replyMessage();">
                <input type="button" class="btn btn-default" value="Ответить всем" onclick="<%= instanceName %>.replyToAll();">
                <input type="button" class="btn btn-default" value="Переслать" onclick="<%= instanceName %>.forwardMessage();">
            </small></h2>
        </div>
        <hr>
        <div class="email_properties">
            <div>От: <span class="email_address" title="<%- from %>"><%- from %></span></div>
            <div class="spacer">&nbsp;</div>
            <div>Кому: <span class="email_address" title="<%- to %>"><%- to %></span></div>
            <% if (cc) { %>
            <div>Копия: <span class="email_address" title="<%- cc %>"><%- cc %></span></div>
            <% } %>
            <% if (bcc) { %>
            <div>Скрытая копия: <span class="email_address" title="<%- bcc %>"><%- bcc %></span></div>
            <% } %>
            <% _.each(files, function (file) { %>
                <div class="spacer">&nbsp;</div>
                <div class="file"><a target="_blank" href="<%= file.download_url %>" title="<%- file.file_filename %>">
                    <div class="filename"><%- file.name %></div>
                    <br>
                    <div class="extension"><%- file.extension %></div>
                </a></div>
            <% }); %>
        </div>
    </div>
    <hr>
    <div class="mail_body">
        <iframe class="email email_js" src="<%= baseUrl %>?section=Email&action=show&params[id]=<%= id %>" scrolling="no" onload="stylingEmailIframe(this)"></iframe>
    </div>
</script>