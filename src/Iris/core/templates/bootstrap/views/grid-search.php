<?php
/**
 * Панель поиска
 */
?>
<div class="panel panel-default grid_search">
  <div class="panel-body">
    <form role="form">
      <?php /* Список полей грида */ ?>
      <div class="col-sm-2">
        <select class="form-control input-sm" onchange="RefreshSearchOperators(this)" types_and_operators="<?php echo addslashes($data['types']); ?>">
        <?php foreach ($data['fields'] as $elem) : ?>
          <option col_type="<?php echo $elem['type']; ?>" <?php echo $elem['selected'] ? 'selected ' : ''; ?> value="<?php echo $elem['value']; ?>" field_number="<?php echo $elem['field_number']; ?>"><?php echo $elem['caption']; ?></option>
        <?php endforeach; ?>
        </select>
      </div>
      <?php /* Выбор режима */ ?>
      <div class="col-sm-2">
        <select class="form-control input-sm">
        <?php foreach ($data['conditions'] as $elem) : ?>
          <option <?php echo $elem['selected'] ? 'selected ' : ''; ?> value="<?php echo $elem['value']; ?>"><?php echo $elem['caption']; ?></option>
        <?php endforeach; ?>
        </select>
      </div>
      <?php /* Поле "Поиск" */ ?>
      <div class="col-sm-6">
        <input type="text" class="form-control input-sm search_value" onkeyup="if (event.keyCode == 13) { ApplySearch(this, '<?php echo $data['grid_id']; ?>'); event.cancelBubble = true; }" value="<?php echo $data['value']; ?>"/>
      </div>
      <?php /* Кнопки "Поиск" и "Сброс" */ ?>
      <div class="col-sm-2 text-right">
        <input type="button" class="btn btn-default btn-sm" onclick="ApplySearch(this, '<?php echo $data['grid_id']; ?>');" value="<?php echo $T->t('Поиск'); ?>"/>
        <input type="button" class="btn btn-default btn-sm" onclick="ClearSearch('<?php echo $data['grid_id']; ?>');" value="<?php echo $T->t('Сброс'); ?>"/>
      </div>
    </form>
  </div>
</div>