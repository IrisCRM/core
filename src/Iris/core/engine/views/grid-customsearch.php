<?php
/**
 * Панель поиска customgrid
 */
?>
<table class="grid_search" width="100%">
<tbody>
<tr>
<?php /* Список полей грида */ ?>
<td style="width: 20%;">
  <div
    <?php if (isset($data['title'])) : ?>
      class="search-title"
      title="<?php echo $data['title'] ?>"
    <?php endif; ?>
  >
    <?php echo $data['caption'];?>
  </div>
</td>
<?php /* Поле "Поиск" */ ?>
<td>
  <input
    type="text"
    data-role="searchinput"
    class="edtText search_value"
    style="width: 100%; overflow: hidden;"
    value="<?php echo $data['searchValue']; ?>"
  />
</td>
<?php /* Кнопки "Поиск" и "Сброс" */ ?>
<td class="grid_search_buttons_cont">
<input
  type="button"
  data-role="search"
  class="button grid_search_button_find"
  value="<?php echo $T->t('Поиск'); ?>"
/>
<input
  type="button"
  data-role="clear"
  class="button grid_search_button_clear"
  value="<?php echo $T->t('Сброс'); ?>"
/>
</td>
</tr>
</tbody>
</table>
