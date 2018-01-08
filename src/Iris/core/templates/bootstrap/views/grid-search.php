<?php
/**
 * Панель поиска
 */
?>
<div class="panel panel-default grid_search no-bottom-margin">
  <div class="panel-body no-padding">
    <!-- disable submit by enter with onsubmit attr -->
    <form role="form" onsubmit="return false;">
      <?php /* Список полей грида */ ?>

      <div class="flexbox-container">

      <div>
        <select class="form-control input-sm" onchange="RefreshSearchOperators(this)" types_and_operators="<?php echo addslashes($data['types']); ?>">
        <?php foreach ($data['fields'] as $elem) : ?>
          <option col_type="<?php echo $elem['type']; ?>" <?php echo $elem['selected'] ? 'selected ' : ''; ?> value="<?php echo $elem['value']; ?>" field_number="<?php echo $elem['field_number']; ?>"><?php echo $elem['caption']; ?></option>
        <?php endforeach; ?>
        </select>
      </div>
      <div class="flexbox-item-gap"></div>
      <?php /* Выбор режима */ ?>
      <div>
        <select class="form-control input-sm">
        <?php foreach ($data['conditions'] as $elem) : ?>
          <option <?php echo $elem['selected'] ? 'selected ' : ''; ?> value="<?php echo $elem['value']; ?>"><?php echo $elem['caption']; ?></option>
        <?php endforeach; ?>
        </select>
      </div>
      <div class="flexbox-item-gap"></div>
      <?php /* Поле "Поиск" */ ?>
      <div class="flexbox-item-wide">
        <input type="text" class="form-control input-sm search_value" onkeyup="if (event.keyCode == 13) { ApplySearch(this, '<?php echo $data['grid_id']; ?>'); event.cancelBubble = true; }" value="<?php echo $data['value']; ?>"/>
      </div>
      <div class="flexbox-item-gap"></div>
      <?php /* Кнопки "Поиск" и "Сброс" */ ?>
      <div class="flexbox-container">
        <div>
          <input type="button" class="btn btn-block btn-default btn-sm" onclick="ApplySearch(this, '<?php echo $data['grid_id']; ?>');" value="<?php echo $T->t('Поиск'); ?>"/>
        </div>
        <div class="flexbox-item-gap"></div>
        <div>
          <input type="button" class="btn btn-block btn-default btn-sm" onclick="ClearSearch('<?php echo $data['grid_id']; ?>');" value="<?php echo $T->t('Сброс'); ?>"/>
        </div>
      </div>

      </div>

    </form>
  </div>
</div>