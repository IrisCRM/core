<?php
/**
 * Поле-email
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
<div class="input-group input-group-sm">
  <input class="form-control edtText" style="width: 100%" type="text" <?php echo $data['template_prefix']; ?>id="<?php echo $data['code']; 
    ?>" value="<?php echo $data['value']; 
    ?>" <?php echo $data['attributes']; 
    ?>/><?php 
    echo $data['hidden']; 
  ?>
  <span class="input-group-btn">
    <button class="btn btn-default btn-sm button button_lookup" <?php 
      echo $data['template_prefix']; ?> onclick="mail_to(this)">
      <span class="glyphicon glyphicon-envelope"></span>
    </button>
  </span>
</div>
  </div>
</div>