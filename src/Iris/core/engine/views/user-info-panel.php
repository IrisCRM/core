<script type="text/template" id="user-info-panel"> 
<span id="user_welcome_area_usercap">Пользователь<span>:</span></span> <span id="user_welcome_area_username"><%= data.name %></span>
<form id="user_welcome_area_exitform" method="post" style="display: none"><input type="hidden" name="btnLogout" value="<?php echo $T->t('Выход'); ?>"/></form>
<span type="bracket">(</span><a id="user_welcome_area_exitform_link" onclick="g_vars.do_exit = true; $('user_welcome_area_exitform').submit()"><?php echo $T->t('Выход'); ?></a><span type="bracket">)</span>
</script>