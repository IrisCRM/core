<?php
/**
 * Поле-разделитель
 */
?>
<div class="form-group">
  <div class="col-sm-<?php echo 2 + $data['colwidth']; ?> iris-column-spacer">
    <div class="input-group input-group-sm">
      <span class="spacer"<?php 
        if (!empty($data['code'])) : ?> id="<?php echo $data['code']; ?>"<?php 
        endif; ?>>&nbsp;</span>
    </div>
  </div>
</div>