<?php
/**
 * Таблица
 */
?>
<?php
  if (!empty($data['error'])) {
    echo $data['error'];
    return;
  } 
?>
<?php
  if (!empty($data['search'])) {
    getView('grid-search', $data['search']); 
  } 
?>
<?php
  if (!empty($data['customSearch'])) {
    getView('grid-customsearch', $data['customSearch']);
  } 
?>
<div conttype="outer">
  <?php /* Заголовок */ ?>
  <table class="grid-header">
  <tbody>
    <tr>
      <td>
        <table class="grid grid_header" is_focused="no">
        <tbody>
        <tr>
        <?php foreach ($data['fields'] as $field) : ?>
          <th class="grid" <?php echo $field['attributes']; ?>>
            <table>
              <tr>
                <td><span class="grid-th-span"><?php 
                    echo $field['caption'];
                ?></span></td><?php if ($field['sort']) : ?>
                      <td class="sort_image"><img src="<?php echo url('build/themes/' . $_SESSION['style_name']
                              . '/images/sort_' . $field['sort'] . '.gif'); ?>" class="sort_image"></td>
                <?php endif; ?>
              </tr>
            </table>
          </th>
        <?php endforeach; ?>
        </tr>
        </tbody>
        </table>
      </td>
      <th class="grid grid_header_right">&nbsp;</th>
    </tr>
  </tbody>
  </table>
<?php /* Данные */ ?>
  <div conttype="inner" class="table-responsive inner<?php 
    echo $data['height'] ? ' fixedheight' : ''; ?>">
  <table class="grid table table-striped table-hover<?php
    echo $data['lines'] == 1 ? ' one-row-value' : '';
    ?>" width="100%" style="height: <?php echo 
    $data['height'] ? $data['height'] : '190px'; 
    ?>;"<?php echo $data['attributes']; ?>>
    <tbody>
      <?php /* Пустая служебная строка */ ?>
      <tr>
        <?php foreach ($data['fields'] as $field) : ?>
          <th width="<?php echo $field['width']; 
          ?>" <?php echo $field['attributes_zero']; ?>></th>
        <?php endforeach; ?>
      </tr>
      <?php /* Строки таблицы */ ?>
      <?php foreach ($data['rows'] as $rownum => $row) : ?>
      <tr <?php echo $rownum + 1 == $data['selected_row_number'] ? 'class="active" ' : ''; 
      ?> selectedclass="active" unselectedclass="" <?php echo $row['attributes']; ?>>
        <?php foreach ($row['columns'] as $column) : ?>
          <td class="grid_row_<?php echo $column['type'];
            echo $data['lines'] == 1 ? '' : ' grid-value'; 
          ?>" <?php echo $column['attributes']; 
          ?>><?php echo $data['lines'] == 1 ? '<span class="grid-value">' : ''; 
          ?><?php echo $column['value']; 
          ?><?php echo $data['lines'] == 1 ? '</span>' : ''; ?></td>
        <?php endforeach; ?>
      </tr>
      <?php endforeach; ?>
      <?php /* Строка "..." для редактируемого грида */ ?>
      <?php if ($data['is_editable']) : ?>
        <tr is_new="yes" selectedclass="active" unselectedclass="" onclick="editgridselectrow(this)" ondblclick="callAddGridRecordFunc(this)">
          <?php foreach ($data['fields'] as $field) : ?>
            <td class="grid_row_<?php echo $field['type']; 
              echo $data['lines'] == 1 ? '' : ' grid-value'; 
            ?>" ondblclick="DrawEditGridElement(this)"><?php 
              echo $data['lines'] == 1 ? '<span class="grid-value">' : ''; 
            ?>&hellip;<?php echo $data['lines'] == 1 ? '</span>' : ''; ?></td>
          <?php endforeach; ?>
        </tr>
      <?php endif; ?>
      <?php /* Строка для "растяжки" таблицы */ ?>
      <tr class="grid_void">
        <?php foreach ($data['fields'] as $field) : ?>
          <td class="grid_row"></td>
        <?php endforeach; ?>
      </tr>
    </tbody>
  </table>
  </div>
</div>
<?php /* Футер */ ?>
<?php if (empty($data['hide_footer']) || !$data['hide_footer']) : ?>
<div class="panel panel-default grid_footer no-bottom-margin">
  <div class="panel-body no-padding">
    <!-- <form role="form"> -->
      <div class="pull-left grid_footer_left">
      <?php if (!$data['hide_buttons']) : ?>
        <input type="button" <?php 
          echo $data['access_c'] ? '' : 'disabled="disabled"'; 
        ?> class="btn btn-default btn-success btn-sm button_add" onclick="openGridCard('<?php 
          echo $data['grid_id']; ?>', '<?php echo $data['grid_type']; ?>', 'insert')" value="<?php 
          echo $T->t('Добавить'); ?>" title="<?php echo $T->t('Добавить новую запись'); ?>">
        <input type="button" <?php echo $data['access_u'] ? '' : 'disabled="disabled"'; 
        ?> class="btn btn-default btn-warning btn-sm button_edit" onclick="modifyGridCard_click(event, '<?php 
          echo $data['grid_id']; ?>', '<?php 
          echo $data['grid_type']; ?>', 'update')" value="<?php 
          echo $T->t($data['can_update'] ? 'Изменить' : 'Просмотр'); ?>" title="<?php 
          echo $T->t(($data['can_update'] ? 'Изменить' : 'Просмотреть') 
              . ' выбранную запись. Удерживайте Ctrl, чтобы изменить доступ у выбранных записей.'); 
        ?>">
        <input type="button" <?php echo $data['access_d'] ? '' : 'disabled="disabled"'; 
        ?> class="btn btn-default btn-danger btn-sm button_delete" onclick="AskForDeleteGridRecord('<?php echo $data['grid_id']; 
        ?>')" value="<?php echo $T->t('Удалить'); 
        ?>" title="<?php echo $T->t('Удалить выбранную запись'); ?>">
      <?php endif; ?>
      </div>
      <div class="pull-left grid_footer_spacer">
      </div>
      <div class="pull-right grid_footer_right">
        <ul class="pager">
          <li>
            <button
              type="button"
              class="btn btn-default btn-sm"
              title="<?php echo $T->t('Обновить');?>"
              data-role="refresh"
              <?php if (empty($data['is_custom'])) : ?>
                onclick="refresh_grid('<?php echo $data['grid_id'];?>')"
              <?php endif; ?>
            >
              <span class="glyphicon glyphicon-refresh"></span>
            </button>
          </li>
          <?php if ($data['have_pages']) : ?>
          <li>
            <button
              type="button"
              class="btn btn-default btn-sm<?php echo $data['page_number'] <= 1 ? ' disabled' : '';?>"
              <?php if ($data['page_number'] <= 1) : ?>
                disabled="disabled"
              <?php endif; ?>
              title="<?php echo $T->t('Предыдущая страница');?>"
              data-role="prev"
              <?php if (empty($data['is_custom'])) : ?>
                onclick="document.getElementById('<?php echo $data['grid_id'];?>').setAttribute('page_number', eval(document.getElementById('<?php echo $data['grid_id']; ?>').getAttribute('page_number')) - 1); redraw_grid('<?php echo $data['grid_id']; ?>')"
              <?php endif; ?>
            >
              <span class="glyphicon glyphicon-chevron-left"></span>
            </button>
          </li>
          <li>
            <?php echo $T->t('Страница'). "&nbsp;" . $data['page_number'];?>
            <?php if (empty($data['is_custom'])) : ?>
              <?php echo"&nbsp;" . $T->t('из') . "&nbsp;" . $data['page_count'];?>
            <?php endif; ?>
          </li>
          <li>
            <button
              type="button"
              class="btn btn-default btn-sm<?php echo $data['page_number'] >= $data['page_count'] ? ' disabled' : '';?>"
              <?php if ($data['page_number'] >= $data['page_count']) : ?>
                disabled="disabled"
              <?php endif; ?>
              title="<?php echo $T->t('Следующая страница');?>"
              data-role="next"
              <?php if (empty($data['is_custom'])) : ?>
                onclick="document.getElementById('<?php echo $data['grid_id'];?>').setAttribute('page_number', eval(document.getElementById('<?php echo $data['grid_id']; ?>').getAttribute('page_number')) + 1); redraw_grid('<?php echo $data['grid_id']; ?>')"
              <?php endif; ?>
            >
              <span class="glyphicon glyphicon-chevron-right"></span>
            </button>
          </li>
          <?php endif; ?>
        </ul>
      </div>
    <!-- </form> -->
  </div>
</div>
<?php endif; ?>
<?php if (!empty($data['is_child'])) : ?>
  <table class="grid_footer_buttons">
  <tbody>
    <tr>
      <td>
        <input type="button" class="btn btn-primary btn-sm button_ok" onclick="refresh_lookup_and_close(this, '<?php 
          echo $data['grid_id']; ?>')" value="<?php echo $T->t('ОК'); ?>">
        <input type="button" class="btn btn-default btn-sm button_cancel" onclick="Windows.close(get_window_id(this))" value="<?php 
          echo $T->t('Отмена'); ?>">
      </td>
    </tr>
  </tbody>
  </table>
<?php elseif (!empty($data['is_custom'])) : ?>
  <table class="grid_footer_buttons">
  <tbody>
    <tr>
      <td>
        <input type="button" class="btn btn-primary btn-sm button_ok" value="<?php echo $T->t('ОК'); ?>">
        <input type="button" class="btn btn-default btn-sm button_cancel" onclick="Windows.close(get_window_id(this))" value="<?php 
          echo $T->t('Отмена'); ?>">
      </td>
    </tr>
  </tbody>
  </table>
<?php endif; ?>