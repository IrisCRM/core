<!DOCTYPE html>
<html>
<?php
/**
 * Шаблон страницы
 */
?>
<head>
  <title>Iris CRM</title>
  <meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=<?php 
    echo $data['encoding']; ?>"/>
  <meta http-equiv="Content-Language" content="ru">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <?php echo $data['javascript']; ?>
  <script type="text/javascript" src="build/bootstrap/js/bootstrap.min.js"></script>
<?php 
/* HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries */ 
/* Для выравнивания в IE8 это решение пока что не помогло */
?>
<!--[if lt IE 9]>
  <script type="text/javascript" src="build/js/ie9.min.js"></script>
<![endif]-->

  <link href="build/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
  <?php echo $data['css']; ?>

  <link rel="SHORTCUT ICON" href="build/templates/<?php echo $data['name']; ?>/images/favicon.png" type="image/png">
</head>

<body onkeyup="ActivateHotKeys(event)">

  <?php /* Контейнер */ ?>
  <div id="maintable" class="container">

    <?php /* Панель для сворачивания окон */ ?>
    <div id="dock"> 
    </div>

    <?php /* Заголовок */ ?>
    <div class="header">
      <div class="logo pull-left"></div>
      <div>
        <div class="pull-right">
          <div id="user_welcome_area"></div>
          <div id="current_time_area"></div>
        </div>
        <div id="remind_area"></div>
      </div>
    </div>

    <?php /* Меню */ ?>
    <div id="menu_panel"></div>

    <div class="row">

      <?php /* Фильтры */  ?>
      <div id="filters_area" class="col-sm-2"></div>

      <?php /* Таблица записей */ ?>
      <div id="grid_area" class="col-sm-10"></div>
    </div>
  </div>

  <?php echo $data['javascript_bottom']; ?>
</body>
</html>