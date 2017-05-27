<HTML>
<?php
/**
 * Шаблон страницы
 */
?>
<head>
  <title>Iris CRM</title>
  <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=<?php echo $data['encoding']; ?>"/>

  <meta http-equiv="Content-Language" content="ru">
  <meta http-equiv="X-UA-Compatible" content="chrome=1">

  <?php echo $data['javascript']; ?>
  
  <?php echo $data['css']; ?>

  <link rel="SHORTCUT ICON" href="<?php echo url($data['template_path']); ?>images/favicon.png" type="image/png">
</head>
<body onkeyup="ActivateHotKeys(event)">

<?php /* Главная таблица, в которой содержатся все элементы: 
  меню, реестр записей и т.д. */ ?>
<div align="center">
<table id="maintable" style="width: 960px; height: 100%;">
<tbody>

  <?php /* Панель для сворачивания окон */ ?>
  <tr>
    <td class="dock">
      <div id="dock"></div>
    </td>
  </tr>

  <tr>
    <td style="height: 22px;">
      <!-- Таблица, в которой находится заголовок и приветствие -->
      <table class="header">
      <tbody>
        <tr class="header">
          <td class="header">
            <span id="current_time_area" style="float: left"></span>
            <span id="user_welcome_area"></span>
            <span id="remind_area"></span>
            <span id="user_styleselect_area" style="margin-left: 10px; display: none;"></span>
            <span id="quickadd_area" style="margin-left: 10px;"></span>
          </td>
        </tr>
      </tbody>
      </table>
    </td>
  </tr>

  <tr style="height: 32px"><td>
    <?php /* Меню */ ?>
    <table width=100% height=32px>
    <tbody>
      <tr><td id="menu_panel"><?php /* Панель меню */ ?></td></tr>
    </tbody>
    </table>
  </td></tr>
  
  <tr><td height="10" class="h_div"><?php /* Отступ от меню */ ?></td></tr>
  
  <tr><td>
    <?php /* 
      Таблица, содержащая 3 столбца: 
      (1) панель меню и фильтров, 
      (2) разделитель, 
      (3) панель гридов 
      */ ?>
    <table style="width: 100%; height: 100%;">
    <tbody>
      <tr>
        <?php /* (1) панель меню и фильтров */ ?>
        <td class="left hidden">
          <table class="left" style="height: 100%;">
            <tr style="height: 100%;">
              <td class="left">
                <div id="filters_area" style="overflow-x: hidden; overflow-y: auto; height: 200px;"><?php 
                  /* Панель фильтров */ 
                ?></div>
              </td>
            </tr>
            </table>
        </td>
        <?php /* (2) разделитель */ ?>
        <td width=10 class="vert_div hidden">
        </td>
        <?php /* (3) панель гридов */ ?>
        <td>
          <table style="height: 100%;" >
          <tbody>
            <tr style="height: 100%;">
              <td id="grid_area" align=center valign=top><?php 
                /* Содержимое реестра записей формируется 
                через javascript */ 
              ?></td>
            </tr>
            <?php /* 
              Если нужно отображать закладки, то нужно 
              убрать этот комментарий 
              и у предыдущего tr сделать высоту 60% */
            /*
            <tr style="height: 40%">
              <td align=center valign=top>
                <table style="height: 100%">
                <tbody>
                  <tr>
                    <td id="tabs_area"></td>
                  </tr>
                  <tr>
                    <td id="detail_area"><br></td>
                  </tr>
                </tbody>
                </table>
              </td>
            </tr>
            */ ?>
          </tbody>
          </table>
        </td>
      </tr>
    </tbody>
    </table>
  </td></tr>

</tbody>
</table>
</div>

<?php echo $data['javascript_bottom']; ?>

</body>
</HTML>