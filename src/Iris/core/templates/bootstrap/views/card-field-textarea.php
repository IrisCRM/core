<?php
/**
 * Поле-текст
 */
?>
<div class="form-group<?php echo $data['mandatory'] ? ' required' : ''; ?>">
  <?php if (empty($data['hide_label'])) : ?>
    <label for="<?php echo $data['code']; 
      ?>" class="col-sm-2 control-label<?php 
      echo $data['title'] ? ' card_elem_title"' : '';
      ?>"<?php echo $data['title'] ? ' title="' . $data['title'] . '"' : '';
      ?>><?php echo $data['caption']; ?></label>
  <?php endif; ?>
  <div class="col-sm-<?php echo $data['colwidth']; ?>">
    <textarea class="form-control input-sm edtText" style="width: 100%" type="<?php echo $data['type']; 
      ?>" <?php echo $data['template_prefix']; ?>id="<?php echo $data['code']; 
      ?>" rows="<?php echo $data['rows']; 
      ?>" <?php echo $data['attributes']; 
      ?>><?php echo $data['value']; ?></textarea><?php 
      echo $data['hidden']; 
    ?>
  </div>
</div>