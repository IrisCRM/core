<?php
/**
 * Список вкладок в карточке
 */
?>
<div type="card_tabs_div" is_loading="0" selected="general">
  <div class="card_tab card_tab_selected" type="card" detail_name="general" onclick="selectCardTab(this)"><?php echo $T->t('Карточка'); ?></div>
  <?php foreach ($data['details'] as $item) : ?>
    <div class="card_tab" type="detail" detail_name="<?php echo $item['name']; ?>" sort_column="default" sort_direction="default" onmouseover="" onmouseout="" onclick="selectCardTab(this)"><?php echo $item['caption']; ?></div>
  <?php endforeach; ?>
  <?php if ($data['access']) : ?>
    <div class="card_tab" type="detail" detail_name="d_Access" sort_column="default" sort_direction="default" onmouseover="" onmouseout="" onclick="selectCardTab(this)"><?php echo $T->t('Доступ'); ?></div>
  <?php endif; ?>
</div>