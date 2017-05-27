<html>
<title>Iris CRM</title>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=#charset#">
<link rel="SHORTCUT ICON" href="<?php echo url('build/images/login/favicon.png'); ?>" type="image/png">

<script type="text/javascript" src="<?php echo asset_path('build/js/login.min.js'); ?>"></script>
<script src="<?php echo asset_path('build/js/jquery.min.js'); ?>" type="text/javascript"></script>

<style>
body {
    font-family: sans-serif;
    background-color: white;
}
#horizon {
	background-color: transparent;
	color: white;
	display: block;
	height: 1px;
	left: 0px;
	overflow: visible;
	position: absolute;
	text-align: center;
	top: 50%;
	visibility: visible;
	width: 100%;
}

#content {
	background-color: transparent;
	font-family: Verdana,Geneva,Arial,sans-serif;
	height: 150px;
	left: 50%;
	margin-left: -150px;
	position: absolute;
	top: -75px;
	visibility: visible;
	width: 300px;
}
	

tr.login_head, tr.login_head td {
	font-family      : sans-serif;
	font-size      	: 14px;
	font-weight		: bold;
	text-align: center;
	padding-top: 10px;
	padding-bottom: 10px;
}
	
table.result {
    background-color: red;
    color: white;
    padding: 10px;
    position: absolute;
    text-align: center;
    width: 100%;
}
	
</style>
	
<div id="horizon">
    <div id="content">
	
        <form id="login_form" method="POST" ecntype="multipart/form-data" onsubmit="submit_form();" post_vars="">
            <table class="login" style="width: 100%; border-top: 2px solid #aaaaaa; border-bottom: 2px solid #aaaaaa">

                <tr class="login_head">
                    <td colspan=3>Вход в личный кабинет</td>
                </tr>

                <tr>
                    <td class="login" style="width: 33%;">Логин</td>
                    <td class="login"><input class="edtText_login" type="text" name="login" style="width: 200px" maxlength=60 /></td>
                    <td class="login" style="width: 33%;"></td>
                </tr>
                <tr>
                    <td class="login" style="width: 33%;">Пароль</td>
                    <td class="login">
                        <input class="edtText_login" type="password" name="password" style="width: 200px" maxlength=60 />
                        <input type="hidden" name="token" value="#TOKEN_VALUE#" />
                        <input type="hidden" name="authtype" value="" />
                    </td>
                    <td class="login"></td>
                </tr>
                <tr>
                    <td class="login"></td>
                    <td align="left" class="login" style="width: 33%;"><INPUT TYPE="submit" class="button_login" style="margin: 0px; width: 200px" VALUE="Вход" NAME="btnLogin"></td>
                    <td class="login"></td>
                </tr>
                <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
            </table>

            <input name="stylename" type=hidden value="iris-client"/>
            <input type="hidden" name="location">
        </form>

    </div>
</div>

<?php if (empty($_POST['login'])) : ?>
    <?php if ($check = Auth::checkLicenseTime()) : ?>
        <table class="result">
            <tbody>
            <tr>
                <td>
                    <font class="<?php echo $check['level']; ?>"><?php echo $check['message']; ?></font>
                </td>
                <td></td>
            </tr>
            <tr></tr>
            </tbody>
        </table>
    <?php endif; ?>
<?php elseif (!empty($errorInfo)) : ?>
    <table class="result">
        <tbody>
        <tr>
            <td>
                <font class="error"><?php echo $errorInfo['message']; ?></font>
            </td>
            <td></td>
        </tr>
        <tr></tr>
        </tbody>
    </table>
<?php endif; ?>

<script>
    jQuery(document).ready(function() {
        var form = jQuery("#login_form");
        if (form.attr('post_vars') != '') {
            var autologin = {};
            try {
                autologin = form.attr('post_vars').evalJSON();
            } catch (e) {}
            form.find('#login').val(autologin.login);
            form.find('#password').val(autologin.password);
            form.find('#authtype').val(autologin.authtype);
            submit_form();
            form.submit();
        }
    });
</script>
	
</html>
