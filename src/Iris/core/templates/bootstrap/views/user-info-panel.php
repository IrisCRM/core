<script type="text/template" id="user-info-panel"> 
<%= data.name 
%><form id="user_welcome_area_exitform" method="post"><input type="hidden" name="btnLogout" value="<?php echo $T->t('Выход'); ?>"/></form>
<a onclick="g_vars.do_exit = true; jQuery('#user_welcome_area_exitform').submit()"><span class="glyphicon glyphicon-off"></span><?php echo $T->t('Выход'); ?></a>
</script>