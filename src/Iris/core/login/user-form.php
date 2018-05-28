<?php
use Iris\Iris;
?>
<html lang="ru">
<head>
    <meta charset="UTF-8">

    <title>Iris CRM</title>

    <link rel="SHORTCUT ICON" href="<?php echo url('build/images/login/favicon.png'); ?>" type="image/png">

    <link href="<?php echo url('build/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo asset_path('build/css/login.min.css') ?>" rel="stylesheet" type="text/css"/>

    <script type="text/javascript" src="<?php echo asset_path('build/js/jquery.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo url('build/bootstrap/js/bootstrap.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset_path('build/js/login.min.js'); ?>"></script>
</head>

<body onLoad="document.getElementById('login_form').login.focus()">
    <div class="login-container">
        <div class="modal-content card">
            <form
              id="login_form"
              method="POST"
              ecntype="multipart/form-data"
              onsubmit="submit_form();"
            >
                <div class="form-group">
                    <div class="logo"></div>
                </div>

                <div class="form-group">
                    <input
                      type="text"
                      class="form-control"
                      name="login"
                      maxlength="60"
                      autocomplete="off"
                      placeholder="Логин"
                    />
                </div>

                <div class="form-group">
                    <input
                      type="password"
                      class="form-control"
                      name="password"
                      maxlength="60"
                      autocomplete="off"
                      placeholder="Пароль"
                    />
                    <input type="hidden" name="token" value="#TOKEN_VALUE#" />
                </div>

                <div class="form-group">
                    <div class="btn-group btn-flex">
                        <button
                          class="btn btn-primary"
                          type="submit"
                          name="btnLogin"
                        >
                            Вход
                        </button>
                        <button
                          class="btn btn-primary dropdown-toggle"
                          data-toggle="dropdown"
                          aria-haspopup="true"
                          aria-expanded="false"
                        >
                            <span class="caret"></span>
                            <span class="sr-only">Дополнительно</span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a id="toggle-extra-options" href="#">Дополнительные параметры</a></li>
                        </ul>
                    </div>
                </div>

                <div id="collapse" class="extra-options-container" style="display: none">
                    <div class="extra-option-group">
                        <label class="control-label" for="stylename">Тема</label>
                        <select name="stylename" class="form-control">
                            <?php
                            $l_options_list = '';
                            foreach (new DirectoryIterator(Iris::$app->getRootDir() . 'public/build/themes/') as $dir) {
                                if (!$dir->isDot() && $dir->isDir() && $dir->getFilename() !== 'common') {
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
                    </div>

                    <div class="extra-option-group-spacer"></div>

                    <div class="extra-option-group">
                        <label class="control-label" for="stylename">Язык</label>
                        <select name="language" class="form-control">
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
                    </div>
                </div>

                <input type="hidden" name="location">
            </form><!-- /form -->
        </div><!-- /modal-content card -->

        <div class="messages">
            <?php if (empty($_POST['login'])) : ?>
                <?php if ($check = Auth::checkLicenseTime()) : ?>
                    <div class="alert alert-<?php echo $check['level'] == 'error' ? 'danger' : $check['level']; ?>">
                        <?php echo $check['message']; ?>
                        <br>
                        <a target="_blank" href="http://iris-crm.ru/cloud-access-prolongation">Инструкция по продлению доступа</a>
                    </div>
                <?php endif; ?>
            <?php elseif (!empty($errorInfo)) : ?>
            <div class="alert alert-danger">
                <?php echo $errorInfo['message']; ?>

                <?php if (!empty($errorInfo['prolongate_license'])): ?>
                    <br><a target="_blank" href="http://iris-crm.ru/cloud-access-prolongation">Инструкция по продлению доступа</a>
                <?php endif; ?>
                <?php if (!empty($errorInfo['request_license'])): ?>
                    <br><a target="_blank" href="<?php echo url('page/License/request') ?>">Запросить лицензии</a>
                <?php endif; ?>

            </div>
            <?php endif; ?>
        </div>
    </div><!-- /login-container -->

    <div class="vesion-container"><h6><!--CORE_VERSION--></h6></div>

</body>
</html>
