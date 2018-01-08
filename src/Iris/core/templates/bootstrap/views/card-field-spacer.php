<?php
/**
 * Поле-разделитель
 */
?>
<div class="form-group col-sm-<?php echo $data['fieldwidth']; ?>">
  <div class="col-sm-12 iris-column-spacer">
    <div class="input-group input-group-sm">
      <span class="spacer"<?php 
        if (!empty($data['code'])) : ?> id="<?php echo $data['code']; ?>"<?php 
        endif; ?>>&nbsp;</span>
    </div>
  </div>
</div>