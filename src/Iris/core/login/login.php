<?php

/**
 * Отображает форму авторизации
 */
function showLoginForm($p_default_style, $p_default_language, $encrypt_method, $errorInfo) {
    ob_start();
    $customForm = Loader::getLoader()->getFileName('login/user-form.php');
    if ($customForm) {
        require $customForm;
    }
    else {
        require dirname(__FILE__) . '/user-form.php';
    }
    $result = ob_get_clean();
    return $result;
}

function showClientLoginForm($p_default_style, $p_default_language, $encrypt_method, $errorInfo) {
    ob_start();
    $customForm = Loader::getLoader()->getFileName('login/client-form.php');
    if ($customForm) {
        require $customForm;
    }
    else {
        require dirname(__FILE__) . '/client-form.php';
    }
    $login_html = ob_get_clean();

    // если передали параметры для автовхода, то передадим их в форму логина для автовхода
    if (!empty($_POST['autologin'])) {
        $login_html = iris_str_replace('post_vars=""', 'post_vars="'.htmlentities(json_encode($_POST), ENT_QUOTES).'"', $login_html);
    }
    $login_html = iris_str_replace('#charset#', GetDefaultEncoding(), $login_html);

    return $login_html;
}