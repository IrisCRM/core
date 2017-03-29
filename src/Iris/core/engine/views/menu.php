<?php
/**
 * Главное меню
 */
?>
<ul id="menu" class="menu" selected_col="0" isLoading="0" ondblclick="ClearItemCacheAndSelect(event);">
<?php
  $module_count = 0;
  // Количество модулей с доступными разделами
  foreach ($data['menu'] as $item) {
    if (!empty($item['items'])) {
      $module_count++;
    }
  }
?>
<?php foreach ($data['menu'] as $item) : ?>
  <?php if (!empty($item['items'])) : ?>
    <?php if ($module_count > 1) : ?>
      <li is_root="1">
        <a class="sub" href="#"><?php echo $T->t($item['name'], null, 'Menu'); ?></a>
        <ul>
    <?php endif; ?>
    <?php foreach ($item['items'] as $sub_item) : ?>
      <li<?php echo $sub_item['islast'] ? ' class="last"' : ''; ?>>
        <a href="#" section="<?php echo $sub_item['section']; ?>"
          col_number="<?php echo $sub_item['col_number']; ?>"
          onclick="<?php echo $sub_item['onclick']; ?>"><?php echo $sub_item['name']; ?></a>
      </li>
    <?php endforeach; ?>
    <?php if ($module_count > 1) : ?>
        </ul>
      </li>
    <?php endif; ?>
  <?php endif; ?>
<?php endforeach; ?>
</ul>
<?php if (!empty($data['new'])) : ?>
  <select class="edtText menu-fastcreate-select" onchange="openCard({source_name: this.options[this.options.selectedIndex].value});this.selectedIndex = 0;">
    <option value=""><?php echo $T->t('Создать', null, 'Create'); ?>&hellip;</option>
    <?php foreach ($data['new'] as $item) : ?>
      <?php foreach ($item['items'] as $sub_item) : ?>
        <option value="<?php echo $sub_item['section']; ?>"><?php echo $sub_item['name']; ?></option>
      <?php endforeach; ?>
    <?php endforeach; ?>
  </select>
<?php endif; ?>
