<?php
/**
 * Форма карточки
 */
?>

<?php if ($data['have_files']) : ?>
  <form role="form" class="iris-card-form" target="upload_iframe" name="<?php 
    echo $data['form_name']; 
    ?>" action="web.php" method="post" enctype="multipart/form-data">
    <iframe id="upload_iframe" name="upload_iframe" style="display: none"></iframe>
<?php else : ?>
  <form role="form" class="iris-card-form" action="" method="POST" name="<?php 
    echo $data['form_name']; ?>" onsubmit="return false;">
<?php endif; ?>

<?php /* Служебные скрытые поля */ ?>
<?php foreach ($data['hidden'] as $item) : ?>
  <input type="hidden" id="<?php echo $item['name']; 
    ?>" name="<?php echo $item['name']; 
    ?>" value="<?php echo $item['value']; ?>">
<?php endforeach; ?>
<!-- fake button for disable first button click event on enter in input -->
<!-- https://jsfiddle.net/mivxxx/j15z5zdy/1/ -->
<button style="display: none"></button>

<?php /* Закладки карточек. Их рисуем, если закладок больше 1 */ ?>
<?php if (count($data['tabs']) > 1) : ?>
<ul class="nav nav-tabs" role="tablist">
  <?php foreach ($data['tabs'] as $key => $tab) : ?>
    <li<?php echo $key == 0 ? ' class="active"' : ''; ?>>
      <a
        href="#<?php echo $tab['rel'];?>"
        rel="<?php echo $tab['rel'];?>"
        role="tab"
        data-toggle="tab"
      >
        <?php echo $T->t($tab['caption'], $tab['source'], 'Card');?>
      </a>
    </li>
  <?php endforeach; ?>
</ul>
<?php endif; ?>

<div class="form_table_scroll iris-card-scroll" style="overflow-y: auto; display: none">
  <?php /* Закладки карточки */ ?>

  <?php if (count($data['tabs']) > 1) : ?>
    <div class="tab-content iris-card-tabs">
  <?php endif; ?>

  <?php foreach ($data['tabs'] as $key => $tab): ?>
    <?php if (count($data['tabs']) > 1) : ?>
      <div class="tab-pane iris-card-tab<?php echo $key == 0 ? ' active' : ''; 
        ?>" tab="<?php echo $tab['rel']; ?>" id="<?php echo $tab['rel']; ?>">
    <?php endif; ?>
    <?php /* Строки карточки */ ?>
    <?php foreach ($tab['rows'] as $row) : ?>
      <div class="row form_row">
      <?php /* Поля карточки */ ?>
        <?php $colwidth = 12 / count($row['fields']) - 2; ?>
        <?php $fieldwidth = 12 / count($row['fields']); ?>
        <?php $labelwidth = $fieldwidth == 12 ? 3 : 6; ?>
        <?php $controlwidth = $fieldwidth == 12 ? 9 : 6; ?>
        <?php foreach ($row['fields'] as $index => $field) : ?>
          <?php $field['colwidth'] = $colwidth; ?>
          <?php $field['fieldwidth'] = $fieldwidth; ?>
          <?php $field['labelwidth'] = $labelwidth; ?>
          <?php $field['controlwidth'] = $controlwidth; ?>
          <?php $field['controlindex'] = $index; /* не используется */ ?>
            <?php
              /* Поле карточки */
              getView('card-field-' . $field['type'], $field);
            ?>
        <?php endforeach; ?>
      </div>
    <?php endforeach; ?>
    <?php if (count($data['tabs']) > 1) : ?>
      </div>
    <?php endif; ?>
  <?php endforeach; ?>
  <?php if (count($data['tabs']) > 1) : ?>
    </div>
  <?php endif; ?>
</div>

<table class="form_table_buttons_panel" cellspacing=0>
  <tbody>
    <tr>
      <td style="vertical-align: middle;"></td>
      <td align=right>
        <?php if ($data['on_save_and_insert']) : ?>
          <input id="btn_save_and_cont" type="button" class="btn btn-default btn-primary btn-sm button" value="<?php 
            echo $T->t('Сохранить и добавить'); ?>" onclick="<?php 
            echo $data['on_save_and_insert']; ?>" title="<?php 
            echo $T->t('Сохранить текущую запись и сразу добавить новую в этом же окне (Shift + Enter)'); ?>">
        <?php endif; ?>
        <?php if ($data['on_ok']) : ?>
          <input id="btn_ok" type="button" class="btn btn-default btn-primary btn-sm button" style="width: 70px;" value="<?php 
            echo $T->t('ОК'); ?>" onclick="<?php 
            echo $data['on_ok']; ?>" title="<?php 
            echo $T->t('Сохранить запись и закрыть окно (Enter). '
                . 'Удерживайте ctrl, чтобы применить изменения, '
                . 'не закрывая окно (Ctrl + Enter)'); ?>">
        <?php endif; ?>
        <input id="btn_cancel" type="button" <?php
          ?>class="btn btn-default btn-sm button" style="width: 70px;" <?php
          ?>value="<?php echo $T->t('Отмена'); ?>" title="<?php 
          echo $T->t('Закрыть окно без сохранения (Esc)'); 
          ?>" onclick="CloseCardWindow(this)">
      </td>
    </tr>
  </tbody>
</table>

</form>