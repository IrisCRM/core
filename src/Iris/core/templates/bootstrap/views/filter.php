<?php
/**
 * Фильтры раздела
 */
?>
<?php if ($data['level'] == 0) : ?>
<div id="filter" class="filter-root list-group" selected_class="active" onclick="ApplyFilterToGrid(event);">
<?php else : ?>
<div class="list-group">
<?php endif; ?>
<?php foreach ($data['items'] as $item) : ?>
  <a class="filter-item list-group-item<?php echo $item['is_default'] ? ' active' : '';
    echo !empty($item['items']) ? ' section' : '';
    echo !empty($item['class']) ? ' ' . $item['class'] : '';
    ?>" checked="<?php echo $item['is_default'] ? '1' : '0'; 
    ?>" filter_number="<?php echo $item['number']; 
    ?>"<?php echo !empty($item['value']) ? ' filter_value="' . $item['value'] . '"' : '';
    ?><?php echo !empty($item['title']) ? ' title="' . $item['title'] . '"' : '';
    ?><?php echo !empty($item['sort_column']) ? 
      ' sort_column="' . $item['sort_column'] . '"' 
      . ' sort_direction="' . $item['sort_direction'] . '"' : '';
    ?>><?php echo $item['caption']; ?>
    <?php if (!empty($item['field'])) : 
      $item['field']['colwidth'] = 0;
      $item['field']['fieldwidth'] = 0;
      $item['field']['labelwidth'] = 0;
      $item['field']['controlwidth'] = 0;
      $item['field']['controlindex'] = 0; /* не используется */
      $item['field']['hide_label'] = 1;
      if ($item['field']['type']) {
        // now we use lookup button in filters again (because grid_wnd opening is fixed)
        // $item['field']['hide_button'] = 1;
      }
      echo '<br>'; 
      getView('card-field-' . $item['field']['type'], $item['field']); 
      endif; ?>
  </a>
  <?php if (!empty($item['items'])) getView('filter', $item); ?>
<?php endforeach; ?>
</div>