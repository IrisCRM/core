<?php
/**
 * Форма карточки
 */
?>

<?php if ($data['have_files']) { ?>
<form name="<?php echo $data['form_name']; ?>" target="upload_iframe" action="web.php" method="post" enctype="multipart/form-data">
<iframe id="upload_iframe" name="upload_iframe" style="display: none"></iframe>
<?php }
else { ?>
<form name="<?php echo $data['form_name']; ?>" action="" method="POST" onsubmit="return false;">
<?php } ?>

<?php /* Служебные скрытые поля */ ?>
<?php foreach ($data['hidden'] as $item) : ?>
  <input type="hidden" id="<?php echo $item['name']; ?>" name="<?php echo $item['name']; ?>" value="<?php echo $item['value']; ?>">
<?php endforeach; ?>

<?php /* Закладки карточек. Их рисуем, если закладок больше 1 */ ?>
<?php if (count($data['tabs']) > 1) : ?>
<div>
  <div class="card_pages_cont">
    <ul class="card_pages_ul">
      <?php foreach ($data['tabs'] as $key => $tab) : ?>
      <li class="card_page <?php echo $key == 0 ? 'card_page_selected' : ''; 
      ?>" rel="<?php echo $tab['rel']; 
      ?>" onclick="selectCardPage(this)" onmouseover="$(this).addClassName('card_page_hover')" onmouseout="$(this).removeClassName('card_page_hover')">
        <span href="#" class="card_page_right"><em class="card_page_left"><span class="card_page_inner"><span class="card_page_caption"><?php 
          echo $T->t($tab['caption'], $tab['source'], 'Card'); 
        ?></span></span></em></span>
      </li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>
<?php endif; ?>

<div class="form_table_scroll iris-card-scroll" style="overflow-y: auto; display: none">
  <?php /* Закладки карточки */ ?>
  <?php foreach ($data['tabs'] as $key => $tab): ?>
  <table class="form_table iris-card-tab" width="100%" cellspacing=0<?php 
    echo $tab['rel'] ? ' tab="' . $tab['rel']. '"' : ''; 
    ?><?php echo $key == 0 ? '' : ' style="display: none"'; ?>>
    <tbody>
      <?php /* Строки карточки */ ?>
      <?php foreach ($tab['rows'] as $row) : ?>
        <tr class="form_row">
        <?php /* Поля карточки */ ?>
          <?php foreach ($row['fields'] as $field) : ?>
            <?php if ($field['type'] != 'splitter' && $field['type'] != 'button' && $field['type'] != 'detail' && $field['type'] != 'matrix') : ?>
              <td class="form_table" align="left" width="1%"><nobr><span class="card_elem_caption<?php
                echo $field['mandatory'] ? ' card_elem_mandatory' : ''; 
              ?><?php echo $field['title'] ? ' card_elem_title"' : ''; 
              ?>"<?php echo $field['title'] ? ' title="' . $field['title'] . '"' : ''; 
              ?>><?php echo $field['caption']; 
              ?><br></span></nobr></td>
            <?php endif; ?>
              <td class="form_table" colspan=<?php echo $field['size'] * 2 - ($field['type'] == 'splitter' || $field['type'] == 'button' || $field['type'] == 'detail' || $field['type'] == 'matrix' ? 0 : 1); 
              ?> width="20%"><?php
                /* Поле карточки */
                getView('card-field-' . $field['type'], $field);
              ?></td>
          <?php endforeach; ?>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php endforeach; ?>
</div>

<table class="form_table_buttons_panel" cellspacing=0>
  <tbody>
    <tr>
      <td style="vertical-align: middle;"></td>
      <td align=right>
        <?php if ($data['on_save_and_insert']) : ?>
        <abbr title="<?php echo $T->t('Сохранить текущую запись и сразу добавить новую в этом же окне (Shift + Enter)'); ?>">
          <input id="btn_save_and_cont" type="button" class="button" value="<?php echo $T->t('Сохранить и добавить'); ?>" onclick="<?php echo $data['on_save_and_insert']; ?>">
        </abbr>
        <?php endif; ?>
        <?php if ($data['on_ok']) : ?>
        <abbr title="<?php echo $T->t('Сохранить запись и закрыть окно (Enter). '
          . 'Удерживайте ctrl, чтобы применить изменения, не закрывая окно (Ctrl + Enter)'); ?>">
          <input id="btn_ok" type="button" class="button" style="width: 70px;" value="<?php echo $T->t('ОК'); ?>" onclick="<?php echo $data['on_ok']; ?>">
        </abbr>
        <?php endif; ?>
        <abbr title="<?php echo $T->t('Закрыть окно без сохранения (Esc)'); ?>">
          <input id="btn_cancel" type="button" class="button" style="width: 70px;" value="<?php echo $T->t('Отмена'); ?>" onclick="CloseCardWindow(this)">
        </abbr>
      </td>
    </tr>
  </tbody>
</table>

</form>