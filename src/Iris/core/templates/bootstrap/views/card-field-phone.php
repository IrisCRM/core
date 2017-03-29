<?php
/**
 * Поле-строка
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
  <input class="form-control edtText" style="width: 100%" type="text" <?php 
    echo $data['template_prefix']; ?> id="<?php echo $data['code']; 
    ?>" value="<?php echo $data['value']; 
    ?>" <?php echo $data['attributes']; 
    ?> onBlur="FormatPhoneNumber(this);"/><?php
    echo $data['hidden']; 
  ?>
  <?php if ($data['code_ext'] != '') : ?>
    <span class="input-group-addon ext">
      <input class="form-control input-sm edtText" style="width: 100%" type="text" <?php echo $data['template_prefix']; ?>id="<?php echo $data['code_ext']; 
      ?>" value="<?php echo $data['value_ext']; 
      ?>" placeholder="<?php echo $T->t('доб', null, 'Card'); ?>" <?php 
        echo $data['attributes_ext']; 
      ?> onBlur="FormatPhoneNumber(this);"/><?php 
        echo $data['hidden_ext']; 
      ?>
    </span>
  <?php endif; ?>
  <span class="input-group-btn">
    <button class="btn btn-default btn-sm button button_lookup" <?php 
      echo $data['template_prefix']; ?> id_primary="<?php 
      echo $data['code']; ?>" onclick="call_to(this)">
      <span class="glyphicon glyphicon-earphone"></span>
    </button>
  </span>
</div>
  </div>
</div>