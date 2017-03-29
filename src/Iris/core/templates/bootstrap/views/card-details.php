<?php
/**
 * Список вкладок в карточке
 */
?>
<div class="list-group" type="card_tabs_div" is_loading="0" selected="general">
  <a class="list-group-item card_tab card_tab_selected active" type="card" detail_name="general" onclick="selectCardTab(this)"><?php echo $T->t('Карточка'); ?></a>
  <?php foreach ($data['details'] as $item) : ?>
    <a class="list-group-item card_tab" type="detail" detail_name="<?php echo $item['name']; ?>" sort_column="default" sort_direction="default" onmouseover="" onmouseout="" onclick="selectCardTab(this)"><?php echo $item['caption']; ?></a>
  <?php endforeach; ?>
  <?php if ($data['access']) : ?>
    <a class="list-group-item card_tab" type="detail" detail_name="d_Access" sort_column="default" sort_direction="default" onmouseover="" onmouseout="" onclick="selectCardTab(this)"><?php echo $T->t('Доступ'); ?></a>
  <?php endif; ?>
</div>