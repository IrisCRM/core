<?php
/**
 * Поле-кнопка
 */
?>
<div class="form-group<?php echo $data['mandatory'] ? ' required' : ''; ?>">
  <div class="col-sm-<?php echo $data['colwidth']; ?>">
    <input class="btn btn-default btn-sm button" style="width: <?php 
      echo $data['width'] ? $data['width'] : '100%'; 
      ?>" type="<?php echo $data['type']; 
      ?>" <?php echo $data['template_prefix']; ?>id="<?php echo $data['code']; 
      ?>" value="<?php echo $data['caption']; 
      ?>" <?php echo $data['attributes']; ?>/>
  </div>
</div>