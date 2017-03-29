<?php
/**
 * Панель поиска
 */
?>
<table class="grid_search" width="100%">
<tbody>
<tr>
<?php /* Список полей грида */ ?>
<td style="width: 20%;">
  <select style="width: 100%;" class="edtText" onchange="RefreshSearchOperators(this)" types_and_operators="<?php echo addslashes($data['types']); ?>">
  <?php foreach ($data['fields'] as $elem) : ?>
    <option col_type="<?php echo $elem['type']; ?>" <?php echo $elem['selected'] ? 'selected ' : ''; ?> value="<?php echo $elem['value']; ?>" field_number="<?php echo $elem['field_number']; ?>"><?php echo $elem['caption']; ?></option>
  <?php endforeach; ?>
  </select>
</td>
<?php /* Выбор режима */ ?>
<td style="width: 100px;">
  <select style="width: 100%;" class="edtText">
  <?php foreach ($data['conditions'] as $elem) : ?>
    <option <?php echo $elem['selected'] ? 'selected ' : ''; ?> value="<?php echo $elem['value']; ?>"><?php echo $elem['caption']; ?></option>
  <?php endforeach; ?>
  </select>
</td>
<?php /* Поле "Поиск" */ ?>
<td>
  <input type="text" class="edtText search_value" style="width: 100%; overflow: hidden;" onkeyup="if (event.keyCode == 13) { ApplySearch(this, '<?php echo $data['grid_id']; ?>'); event.cancelBubble = true; }" value="<?php echo $data['value']; ?>"/>
</td>
<?php /* Кнопки "Поиск" и "Сброс" */ ?>
<td class="grid_search_buttons_cont">
<input type="button" class="button grid_search_button_find" onclick="ApplySearch(this, '<?php echo $data['grid_id']; ?>');" value="<?php echo $T->t('Поиск'); ?>"/>
<input type="button" class="button grid_search_button_clear" onclick="ClearSearch('<?php echo $data['grid_id']; ?>');" value="<?php echo $T->t('Сброс'); ?>"/>
</td>
</tr>
</tbody>
</table>
