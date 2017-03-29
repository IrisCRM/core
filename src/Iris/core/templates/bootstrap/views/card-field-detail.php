<?php
/**
 * Поле-таблица (вкладка)
 */
?>
<div id="<?php echo $data['grid_code']; ?>" class="card-grid row">
  <div class="col-sm-12">
    <?php getView('grid', $data['grid']); ?>
  </div>
</div>