<?php
/**
 * Поле-разделитель
 */
?>
<div class="form-group">
  <div class="col-sm-<?php echo 2+$data['colwidth']; ?>">
  <h4 <?php 
    if (!empty($data['code'])) : ?> id="<?php echo $data['code']; ?>"<?php 
    endif; ?> class="col-sm-<?php echo 2+$data['colwidth']; ?>"><?php 
    echo $data['caption']; ?></h4>
    </div>
</div>