<?php
/**
 * Поле-кнопка
 */
?>
<div class="form-group<?php echo $data['mandatory'] ? ' required' : ''; ?> col-sm-<?php echo $data['fieldwidth']; ?>">
  <div class="col-sm-<?php echo $data['controlwidth']; ?> no-horizontal-padding">
    <input class="btn btn-default btn-sm button" style="width: <?php 
      echo $data['width'] ? $data['width'] : '100%'; 
      ?>" type="<?php echo $data['type']; 
      ?>" <?php echo $data['template_prefix']; ?>id="<?php echo $data['code']; 
      ?>" value="<?php echo $data['caption']; 
      ?>" <?php echo $data['attributes']; ?>
      <?php if (!empty($data['onclick'])) : 
            ?> onclick="<?php echo $data['onclick']; ?>"<?php 
          endif; ?>/>
  </div>
</div>