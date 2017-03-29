<?php
/**
 * Поле-select
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
  <select class="form-control input-sm edtText" <?php 
    echo $data['template_prefix']; ?> id="<?php echo $data['code']; 
    ?>" <?php echo $data['attributes']; ?>>
    <?php foreach ($data['options'] as $option) : ?>
      <option<?php echo $option['selected'] ? ' selected' : ''; 
      ?> value="<?php echo $option['value']; 
      ?>" <?php echo $option['attributes']; 
      ?>><?php echo $option['caption']; ?></option>
    <?php endforeach; ?>
  </select><?php 
    echo $data['hidden']; 
  ?>
  </div>
</div>