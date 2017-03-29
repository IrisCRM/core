<?php
/**
 * Поле-чекбокс
 */
?>
<div class="checkbox_cont"><input class="checkbox" type="<?php echo $data['type']; 
  ?>" <?php echo $data['template_prefix']; ?>id="<?php echo $data['code']; 
  ?>" <?php echo $data['value'] ? ' checked' : ''; 
  ?> <?php echo $data['attributes']; ?>/><?php 
    echo $data['hidden']; 
  ?></div>