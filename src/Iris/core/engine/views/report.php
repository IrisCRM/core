<HTML>
<?php
/**
 * Шаблон отчёта
 */
?>
<head>
  <title><?php echo $data['title']; ?></title>
  <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=<?php echo $data['encoding']; ?>"/>

  <meta http-equiv="Content-Language" content="ru">
  <meta http-equiv="X-UA-Compatible" content="chrome=1">

  <?php echo $data['javascript']; ?>
  
  <?php echo $data['css']; ?>

  <link rel="SHORTCUT ICON" href="<?php echo url($data['template_path'] . 'images/favicon.png'); ?>" type="image/png">
</head>
<body class="report" onkeyup="ActivateHotKeys(event)">

  <?php echo $data['parameters']; ?>

  <table id="maintable" width="100%">
    <tbody>
      <tr>
        <td class="normal">&nbsp;</td>
        <td class="normal" style="<?php echo $data['width']; ?>">

          <?php echo $data['params']; ?>

          <h1><?php echo htmlspecialchars($data['title']); ?></h1>

          <table id="filters" class="filter">
            <tbody>
              <tr>
                <td width="10" style="white-space: nowrap;"><?php echo $data['filters']; ?></td>
                <td align="right">Дата: <?php echo $data['date']; ?><br/>Время: <?php echo $data['time']; ?></td>
              </tr>
            </tbody>
          </table>

          <?php echo $data['table']; ?>

          <?php echo $data['graph']; ?>

          <p><?php echo htmlspecialchars($data['description']); ?></p>

        </td>
        <td class="normal">&nbsp;</td>
      </tr>
    </tbody>
  </table>

  <?php echo $data['javascript_bottom']; ?>

</body>
</HTML>