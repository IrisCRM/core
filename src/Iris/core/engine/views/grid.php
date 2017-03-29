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
<div conttype="outer">
  <?php /* Заголовок */ ?>
  <table class="grid-header" style="width: 100%;">
  <tbody>
    <tr>
      <td>
        <table class="grid grid_header" is_focused="no" style="table-layout: fixed;">
        <tbody>
        <tr>
        <?php foreach ($data['fields'] as $field) : ?>
          <th class="grid" <?php echo $field['attributes']; ?>>
            <table style="width: 100%; table-layout:fixed;">
              <tr>
                <td style="width: 100%; overflow: hidden;"><span class="grid-th-span"><?php 
                    echo $field['caption'];
                ?></span></td><?php if ($field['sort']) : ?>
                  <td class="sort_image"><img src="build/themes/<?php echo $_SESSION['style_name'];
                    ?>/images/sort_<?php echo $field['sort']; ?>.gif" class="sort_image"></td>
                <?php endif; ?>
              </tr>
            </table>
          </th>
        <?php endforeach; ?>
        </tr>
        </tbody>
        </table>
      </td>
      <th class="grid grid_header_right" style="padding: 0; margin: 0; width: 14px;">&nbsp;</th>
    </tr>
  </tbody>
  </table>


<?php /* Данные */ ?>
  <div conttype="inner"<?php echo $data['height'] ? ' class="fixedheight"' : '';
    ?> style="overflow-y: scroll; height: <?php echo $data['height'] ? $data['height'] : '190px'; 
    ?>;">
  <table class="grid" <?php 
    echo $data['lines'] == 1 ? 'style="table-layout: fixed;" ' : ''; 
  ?> width="100%" <?php echo $data['attributes']; ?>>
    <tbody>
      <?php /* Пустая служебная строка */ ?>
      <tr>
        <?php foreach ($data['fields'] as $field) : ?>
          <th style="height: 0; padding: 0; margin: 0;" width="<?php echo $field['width']; 
          ?>" <?php echo $field['attributes_zero']; ?>></th>
        <?php endforeach; ?>
      </tr>
      <?php /* Строки таблицы */ ?>
      <?php $rowstyle = $unselected = ''; ?>
      <?php if (array_key_exists('rows', $data)) : ?>
        <?php foreach ($data['rows'] as $rownum => $row) : 
          $rowstyle = (($rownum + 1) % 2 == 0) ? 'grid_odd' : 'grid_even'; 
          $unselected = $rowstyle;
          if ($rownum+1 == $data['selected_row_number']) {
            // если указали show_rec_id, то выберем эту запись
            $rowstyle = $rowstyle . ' grid_selected';
          }
        ?>
        <tr class="<?php echo $rowstyle; 
        ?>" selectedclass="grid_selected" unselectedclass="<?php echo $unselected; 
        ?>" <?php echo $data['lines'] == 1 ? 'style="table-layout: fixed;" ' : ''; 
        ?> <?php echo $row['attributes']; ?>>
          <?php foreach ($row['columns'] as $column) : ?>
            <td class="grid_row_<?php echo $column['type']; 
              echo $data['lines'] == 1 ? '' : ' grid-value'; 
            ?>" <?php echo $data['lines'] == 1 ? 'style="overflow: hidden; white-space: nowrap;" ' : ''; 
            ?> <?php echo $column['attributes']; 
            ?>><?php echo $data['lines'] == 1 ? '<span class="grid-value" style="white-space: nowrap;">' : ''; 
            ?><?php echo $column['value']; 
            ?><?php echo $data['lines'] == 1 ? '</span>' : ''; ?></td>
          <?php endforeach; ?>
        </tr>
        <?php endforeach; ?>
      <?php endif; ?>

      <?php /* Строка "..." для редактируемого грида */ ?>
      <?php if ($data['is_editable']) : 
        $rowstyle = $rowstyle == 'grid_odd' ? 'grid_even' : 'grid_odd'
      ?>
        <tr class="<?php echo $rowstyle; ?>" is_new="yes" <?php 
          echo $data['lines'] == 1 ? 'style="table-layout: fixed;" ' : ''; 
        ?> selectedclass="grid_selected" unselectedclass="<?php 
          echo $rowstyle; 
        ?>" onclick="editgridselectrow(this)" ondblclick="callAddGridRecordFunc(this)">
          <?php foreach ($data['fields'] as $field) : ?>
            <td class="grid_row_<?php echo $field['type']; 
              echo $data['lines'] == 1 ? '' : ' grid-value'; 
            ?>" <?php 
              echo $data['lines'] == 1 ? 'style="overflow: hidden; white-space: nowrap;" ' : ''; 
            ?> ondblclick="DrawEditGridElement(this)"><?php 
              echo $data['lines'] == 1 ? '<span class="grid-value" style="white-space: nowrap;">' : ''; 
              ?>&hellip;<?php echo $data['lines'] == 1 ? '</span>' : ''; ?></td>
          <?php endforeach; ?>
        </tr>
      <?php endif; ?>

      <?php /* Строка для "растяжки" таблицы */ ?>
      <tr class="grid_void" style="height: 100%; padding: 0; margin: 0;">
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
<table class="grid_footer">
  <tbody>
    <tr>
      <td class="grid_footer_left grid_footer">
      <?php if (!$data['hide_buttons']) : ?>
        <input type="button" <?php 
          echo $data['access_c'] ? '' : 'disabled="disabled"'; 
        ?> class="button button_add" onclick="openGridCard('<?php 
          echo $data['grid_id']; ?>', '<?php echo $data['grid_type']; ?>', 'insert')" value="<?php 
          echo $T->t('Добавить'); ?>" title="<?php echo $T->t('Добавить новую запись'); ?>">
        <input type="button" <?php echo $data['access_u'] ? '' : 'disabled="disabled"'; 
        ?> class="button button_edit" onclick="modifyGridCard_click(event, '<?php 
          echo $data['grid_id']; ?>', '<?php 
          echo $data['grid_type']; ?>', 'update')" value="<?php 
          echo $T->t($data['can_update'] ? 'Изменить' : 'Просмотр'); ?>" title="<?php 
          echo $T->t(($data['can_update'] ? 'Изменить' : 'Просмотреть') 
              . ' выбранную запись. Удерживайте Ctrl, чтобы изменить доступ у выбранных записей.'); 
        ?>">
        <input type="button" <?php echo $data['access_d'] ? '' : 'disabled="disabled"'; 
        ?> class="button button_delete" onclick="AskForDeleteGridRecord('<?php echo $data['grid_id']; 
        ?>')" value="<?php echo $T->t('Удалить'); 
        ?>" title="<?php echo $T->t('Удалить выбранную запись'); ?>">
      <?php endif; ?>
      </td>
      <td class="grid_footer">
        <table>
          <tbody>
            <tr class="grid_footer_spacer"><td></td></tr>
          </tbody>
        </table>
      </td>
      <td class="grid_footer grid_footer_spacer_after"></td>
      <td class="grid_footer grid_footer_right">
        <input type="button" class="button button_refresh" value="" title="<?php echo $T->t('Обновить'); 
        ?>" onclick="refresh_grid('<?php echo $data['grid_id']; ?>')">
        <?php if ($data['have_pages']) : ?>
          <input <?php echo $data['page_number'] <= 1 ? 'disabled="disabled"' : ''; 
          ?> type="button" class="button button_prev<?php 
            echo $data['page_number'] <= 1 ? ' button_prev_disabled' : ''; 
          ?>" title="<?php echo $T->t('Предыдущая страница'); 
          ?>" onclick="document.getElementById('<?php echo $data['grid_id']; 
          ?>').setAttribute('page_number', eval(document.getElementById('<?php 
            echo $data['grid_id']; ?>').getAttribute('page_number')) - 1); redraw_grid('<?php 
            echo $data['grid_id']; ?>')">
          <span class="grid_page_title"><?php echo $T->t('Страница'); 
          ?>&nbsp;</span><span class="grid_page_number"><?php echo $data['page_number']; 
          ?>&nbsp;<?php echo $T->t('из'); ?>&nbsp;<?php echo $data['page_count']; ?></span>
          <input <?php echo $data['page_number'] >= $data['page_count'] ? 'disabled="disabled"' : ''; 
          ?> type="button" class="button button_next<?php 
            echo $data['page_number'] >= $data['page_count'] ? ' button_next_disabled' : ''; 
          ?>" title="<?php echo $T->t('Следующая страница'); 
          ?>" onclick="document.getElementById('<?php echo $data['grid_id']; 
          ?>').setAttribute('page_number', eval(document.getElementById('<?php 
            echo $data['grid_id']; ?>').getAttribute('page_number')) + 1); redraw_grid('<?php 
            echo $data['grid_id']; ?>')">
        <?php endif; ?>
      </td>
    </tr>
  </tbody>
</table>
<?php endif; ?>
<?php if (!empty($data['is_child'])) : ?>
  <table class="grid_footer_buttons">
  <tbody>
    <tr>
      <td>
        <input type="button" class="button button_ok" onclick="refresh_lookup_and_close(this, '<?php 
          echo $data['grid_id']; ?>')" value="<?php echo $T->t('ОК'); ?>">
        <input type="button" class="button button_cancel" onclick="Windows.close(get_window_id(this))" value="<?php 
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
        <input type="button" class="button button_ok" value="<?php 
          echo $T->t('ОК'); ?>">
        <input type="button" class="button button_cancel" value="<?php 
          echo $T->t('Отмена'); ?>" onclick="Windows.close(get_window_id(this))">
      </td>
    </tr>
  </tbody>
  </table>
<?php endif; ?>