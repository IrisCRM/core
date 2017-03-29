<?php
use Iris\Iris;
?>
<html lang="ru">
<head>
    <meta charset="UTF-8">

    <title>Iris CRM</title>

    <link rel="SHORTCUT ICON" href="build/images/login/favicon.png" type="image/png">

    <link href="<?php echo asset_path('build/css/login.min.css') ?>" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="<?php echo asset_path('build/js/login.min.js'); ?>"></script>
</head>
<body onLoad="document.getElementById('login_form').login.focus()">

<table class="open0" style="width: 100%;">
    <tbody>
        <tr>
            <td class="right">
                <a href="http://iris-crm.ru" target="_blank" title="Автоматизация бизнеса">Сайт Iris CRM</a>
            </td>
        </tr>
    </tbody>
</table>

<table class="open" style="width: 100%;">
    <tbody>
    <tr>
        <td style="width: 40%;" align="right">&nbsp;<br/><br/><br/><br/><br/><br/>
            <div class="login_logo"><div class="login_version"><!--CORE_VERSION--></div></div>
        </td>
        <td class="open" style="width: 20%;">

            <form id="login_form" method="POST" ecntype="multipart/form-data" onsubmit="submit_form();">
            <table class="login" style="width: 100%;">
            <tbody>
                <tr>
                    <td class="login" style="width: 33%;">Логин</td>
                    <td class="login"><input class="edtText_login" type="text" name="login" style="width: 110px;" maxlength="60"></td>
                    <td class="login" style="width: 33%;"></td>
                </tr>
                <tr>
                    <td class="login">Пароль</td>
                    <td class="login">
                        <input class="edtText_login" type="password" name="password" style="width: 110px;" maxlength="60">
                        <input type="hidden" name="token" value="#TOKEN_VALUE#" />
                    </td>
                    <td class="login"></td>
                </tr>
                <tr>
                    <td class="login"></td>
                    <td align="left" class="login">
                        <input type="submit" class="button_login" style="margin: 0px; width: 110px;" value="Вход" name="btnLogin">
                    </td>
                    <td class="login"></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>

                <tr>
                    <td class="login">Тема</td>
                    <td class="login">
                        <select name="stylename" class="edtText_login" style="width: 110px;">
                            <?php
                            $l_options_list = '';
                            foreach (new DirectoryIterator(Iris::$app->getRootDir() . 'public/build/themes/') as $dir) {
                                if (!$dir->isDot() && $dir->isDir()) {
                                    if ($dir->getFilename() == $p_default_style) {
                                        $l_selected = ' selected = "" ';
                                    }
                                    else {
                                        $l_selected = '';
                                    }
                                    echo '<option value="' . $dir->getFilename() . '"' . $l_selected . '>' . $dir->getFilename() . '</option>'."\n";
                                }
                            }
                            ?>
                        </select>
                    </td>
                    <td class="login"></td>
                </tr>


                <tr>
                    <td class="login">Язык</td>
                    <td class="login">
                        <select name="language" class="edtText_login" style="width: 110px;">
                            <?php
                            $l_languages_list = '';
                            foreach (new DirectoryIterator(Iris::$app->getRootDir() . 'public/build/js/language/') as $dir) {
                                if (!$dir->isDot() && $dir->isDir()) {
                                    if ($dir->getFilename() == $p_default_language) {
                                        $l_selected = ' selected = "" ';
                                    }
                                    else {
                                        $l_selected = '';
                                    }
                                    $lang = require Loader::getLoader()->getFileName('language/' . $dir . '/' . $dir . '.php');
                                    echo '<option value="' . $dir->getFilename() . '"' . $l_selected.'>' . $lang['name'] . '</option>' . "\n";
                                }
                            }
                            ?>
                        </select>
                    </td>
                    <td class="login"></td>
                </tr>

                <input type="hidden" name="location">
            </tbody>
            </table>
        </form>
        </td>
        <td style="width: 40%;">&nbsp;</td>
    </tr>
    </tbody>
</table>

<table class="footer">
    <tbody>
        <tr>
            <td>&nbsp;</td>
        </tr>
    </tbody>
</table>

<?php if (empty($_POST['login'])) : ?>
    <?php if ($check = Auth::checkLicenseTime()) : ?>
        <table class="result">
            <tbody>
            <tr>
                <td>
                    <font class="<?php echo $check['level']; ?>"><?php echo $check['message']; ?></font><br>
                    <a target="_blank" href="http://iris-crm.ru/cloud-access-prolongation">Инструкция по продлению доступа</a>
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
                <?php if (!empty($errorInfo['prolongate_license'])): ?>
                    <br><a target="_blank" href="http://iris-crm.ru/cloud-access-prolongation">Инструкция по продлению доступа</a>
                <?php endif; ?>
                <?php if (!empty($errorInfo['request_license'])): ?>
                    <br><a target="_blank" href="license/request.html">Запросить лицензии</a>
                <?php endif; ?>
            </td>
            <td></td>
        </tr>
        <tr></tr>
        </tbody>
    </table>
<?php endif; ?>

</body>

</html>