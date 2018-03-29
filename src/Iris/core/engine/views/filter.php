<?php
/**
 * Фильтры раздела
 */
?>
<?php if ($data['level'] == 0) : ?>
<ul class="filter-root filter_unselected" selected_class="filter_selected" 
    unselected_class="filter_unselected" onclick="ApplyFilterToGrid(event);">
<?php else : ?>
<ul>
<?php endif; ?>
<?php foreach ($data['items'] as $item) : ?>
  <li class="filter-item <?php echo $item['is_default'] ? 'filter_selected' : 'filter_unselected'; 
    echo !empty($item['class']) ? ' ' . $item['class'] : '';
    ?>" checked="<?php echo $item['is_default'] ? '1' : '0'; 
    ?>" filter_number="<?php echo $item['number']; 
    ?>"<?php echo !empty($item['value']) ? ' filter_value="' . $item['value'] . '"' : '';
    ?><?php echo !empty($item['title']) ? ' title="' . $item['title'] . '"' : '';
    ?><?php echo !empty($item['sort_column']) ? ' sort_column="' . $item['sort_column'] . '" sort_direction="' . $item['sort_direction'] . '"' : '';
    ?>><font class="filter_elem" style="<?php echo $item['style']; ?>"><?php 
    echo $item['caption']; ?></font>
    <?php if (!empty($item['field'])) : 
      echo '<br>'; 
      // now we use lookup button in filters again (because grid_wnd opening is fixed)
      // $item['field']['is_filter'] = true; 
      getView('card-field-' . $item['field']['type'], $item['field']); 
    endif; ?>
  </li>
  <?php if (!empty($item['items'])) : getView('filter', $item); endif; ?>
<?php endforeach; ?>
</ul>