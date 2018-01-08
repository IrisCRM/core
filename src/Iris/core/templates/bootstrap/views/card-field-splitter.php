<?php
/**
 * Поле-разделитель
 */
?>
<div class="form-group horizontal-gutter">
  <div class="col-sm-<?php echo $data['fieldwidth']; ?> flexbox-container flexbox-align-center no-horizontal-padding">
    <div class="splitter-start-container"><hr class="splitter"></div>
    <div>
      <span <?php 
      if (!empty($data['code'])) : ?> id="<?php echo $data['code']; ?>"<?php 
      endif; ?> class="splitter-caption"><?php 
      echo $data['caption']; ?></span>
    </div>
    <div class="flexbox-item-wide splitter-end-container"><hr class="splitter"></div>
  </div>
</div>