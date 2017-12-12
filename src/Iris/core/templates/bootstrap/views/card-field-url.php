<?php
/**
 * Поле-url
 */
?>
<div class="form-group<?php echo $data['mandatory'] ? ' required' : ''; ?> col-sm-<?php echo $data['fieldwidth']; ?> no-horizontal-padding">
  <?php if (empty($data['hide_label'])) : ?>
    <label for="<?php echo $data['code']; 
      ?>" class="col-sm-<?php echo $data['labelwidth']; ?> no-<?php echo $data['controlindex'] > 0 ? "horizontal" : "right"; ?>-padding control-label<?php 
      echo $data['title'] ? ' card_elem_title"' : '';
      ?>"<?php echo $data['title'] ? ' title="' . $data['title'] . '"' : '';
      ?>><?php echo $data['caption']; ?></label>
  <?php endif; ?>
  <div class="col-sm-<?php echo $data['controlwidth']; ?> no-left-padding">
<div class="input-group input-group-sm">
  <input class="form-control edtText" style="width: 100%" type="text" <?php echo $data['template_prefix']; ?>id="<?php echo $data['code']; 
    ?>" value="<?php echo $data['value']; 
    ?>" <?php echo $data['attributes']; 
    ?>/><?php 
    echo $data['hidden']; 
  ?>
  <span class="input-group-btn">
    <button class="btn btn-default btn-sm button button_lookup" <?php 
      ?> onclick="open_url(this)">
      <span class="glyphicon glyphicon-link"></span>
    </button>
  </span>
</div>
  </div>
</div>