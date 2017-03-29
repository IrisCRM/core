<?php
/**
 * Поле-lookup
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
  <input <?php echo $data['template_prefix']; ?>id="<?php echo $data['code']; 
  ?>" class="form-control edtText<?php echo $data['disabled'] ? ' edtText_disabled' : ''; 
  ?>" type="text" value ="<?php echo $data['value']; 
  ?>" onKeyUp="DrawAutoComplete(this, event)" <?php echo $data['disabled'] ? ' readonly' : ''; 
  ?> <?php echo $data['attributes']; ?>><?php 
    echo $data['hidden']; ?>
    <?php if (!$data['disabled']) : ?>
      <span class="input-group-btn">
        <button class="btn btn-default btn-sm button button_lookup" <?php 
          echo $data['template_prefix']; ?> onclick="lookup_onclick(this, event)" title="<?php
          echo $T->t('Удерживайте Ctrl, чтобы открыть карточку'); ?>" <?php 
          echo $data['template_prefix']; ?> id="<?php echo $data['code']; ?>_btn">
          <span class="glyphicon glyphicon-list"></span>
        </button>
      </span>
    <?php endif; ?>
  </div>
</div>
</div>