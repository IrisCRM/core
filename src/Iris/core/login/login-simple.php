<?php

/**********************************************************************
login.php
Форма для авторизации

Версия: 1.0.0
Автор: mnv
Дата создания: 08.05.2008 
Последнее изменение: mnv
Дата последней модификации: 08.05.2008
**********************************************************************/

/***
mnv
Отображает форму авторизации
***/
function GetCoreVersion() {
	$xml = simplexml_load_file(Loader::getLoader()->corePath() . 'core/version.xml');
	return $xml->CURRENT_VERSION;
}

function showLoginForm($p_default_style, $p_default_language, $encrypt_method) {
	$login_js = 'login' . ($encrypt_method ? '_' . $encrypt_method : '') . '.js';

	echo '<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset='.GetDefaultEncoding().'">';
	echo '<table class="open0" style="width:100%">';
	echo '<tr><td>';
	echo '<td class="right">&nbsp;';
	echo '<a href="http://iris-integrator.ru" target="_blank">Сайт IRIS CRM</a>';
//	echo 'Технологии автоматизации бизнеса<br/>';
	//	echo '+7 (495) 924 11 58';
	echo '</td>';
	echo'</td></tr></table>';
	
	echo '<div id="horizon">';
	echo '<div id="content">';
	
	//echo '<table style="width: 100%; height: 100%; background-color: red"><tr><td>qqq</td></tr></table>';
	//echo '<div>123</div>';
	
	echo '<form method="POST" ecntype="multipart/form-data">';
	echo '<table class="login" style="width:100%">';
	
	// строка с заголовком окна логина
	echo '<tr class="login_head">';
	echo '<td colspan=3>IRIS CRM: Вход в систему</td>';
	echo '</tr>';
	
	echo '<tr>';
	echo '<td class="login" style="width: 30%;">Логин</td>';
	echo '<td class="login"><input class="edtText_login" type="text" name="login" style="width: 100%" maxlength=60 /></td>';
	echo '<td class="login" style="width: 20%;"></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class="login">Пароль</td>';
	echo '<td class="login"><input class="edtText_login" type="password" name="password" style="width: 100%" maxlength=60 /></td>';
	echo '<td class="login"></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class="login"></td>';
	echo '<td align="left" class="login"><INPUT TYPE="submit" class="button_login" style="margin: 0px; width: 100%" VALUE="Вход" NAME="btnLogin"></td>';
	echo '<td class="login"></td>';
	echo '</tr>';
	echo '<tr><td>&nbsp;</td><td>&nbsp;</td></tr>';
	//echo '<tr><td>&nbsp;</td><td>&nbsp;</td></tr>';
	echo '<tr>';
	echo '<td class="login">Стиль</td>';
	//echo '<td class="login"><input class="edtText" type="text" name="stylename" size=15 maxlength=20 /></td>';
	echo '<td class="login">';

	//$l_options_list = '';
	//echo realpath('./core/templates/');
	foreach(new DirectoryIterator(Loader::getLoader()->basePath() . 'public/build/themes/') as $dir) {
		if (((string)$dir !='.') and ((string)$dir !='..')) {
			if ((string)$dir == $p_default_style) {
				$l_selected = ' selected = "" ';
			} else {
				$l_selected = '';
			}
			$l_options_list .= '<option value="'.(string)$dir.'"'.$l_selected.'>'.(string)$dir.'</option>';
		}
	}
	echo '<select name="stylename" class="edtText_login" style="margin-bottom: 4px; width: 100%">';
	echo $l_options_list;
	echo '</select>';

	// определение версии
	$version = @GetCoreVersion();
	
	echo '<td class="login version">'.$version.'</td>';
	echo '</td>';
	echo '</tr>';
	echo '</table>';	
	echo '</form>';
	
	
	echo '</div>';
	echo '</div>';
/*
	echo '<table class="open" style="width:100%">';
	echo '<tr>';
	echo '<td style="width:40%" align="right">&nbsp;<br/><br/><br/><br/><br/><br/>';

	//echo '<img src="iriscrm250.jpg"/><br/>';
	echo '<div class="login_logo"/><br/>';	

	
	echo '</td>';
	echo '<td class="open" style="width: 20%;">';

	echo '</td>';
	echo '<td style="width:40%">&nbsp;</td>';
	echo '</tr></table>';
*/
	
	//echo '<table class="footer"><tbody><tr>';
	//echo '<td></td>';
	//echo '</tr></tbody></table>';
}

?>