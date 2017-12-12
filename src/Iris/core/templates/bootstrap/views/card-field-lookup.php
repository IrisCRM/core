<?php
/**
 * Поле-lookup
 */
?>
<?php /* reset relative position via position-static class for correntc autocomplete display */ ?>
<div class="form-group<?php echo $data['mandatory'] ? ' required' : ''; ?> col-sm-<?php echo $data['fieldwidth']; ?> no-horizontal-padding position-static">
  <?php if (empty($data['hide_label'])) : ?>
    <label for="<?php echo $data['code']; 
      ?>" class="col-sm-<?php echo $data['labelwidth']; ?> no-<?php echo $data['controlindex'] > 0 ? "horizontal" : "right"; ?>-padding control-label<?php 
      echo $data['title'] ? ' card_elem_title"' : '';
      ?>"<?php echo $data['title'] ? ' title="' . $data['title'] . '"' : '';
      ?>><?php echo $data['caption']; ?></label>
  <?php endif; ?>
<?php /* reset relative position via position-static class for correntc autocomplete display */ ?>
  <div class="col-sm-<?php echo $data['controlwidth']; ?> no-left-padding position-static">
<?php /* reset relative position via position-static class for correntc autocomplete display */ ?>
<div class="<?php echo empty($data['hide_button']) ? "input-group input-group-sm " : ""?>position-static"><?php /* position-initial used for correct display autocomplete in editable grids */ ?>
  <input <?php echo $data['template_prefix']; ?>id="<?php echo $data['code']; 
  ?>" class="form-control edtText<?php echo $data['disabled'] ? ' edtText_disabled' : ''; 
  ?>" type="text" value ="<?php echo $data['value']; 
  ?>" onKeyUp="DrawAutoComplete(this, event)" <?php echo $data['disabled'] ? ' readonly' : ''; 
  ?> <?php echo $data['attributes']; ?> onBlur="TryToCloseAutoCompleteElem(this);"><?php 
    echo $data['hidden']; ?>
    <?php if (!$data['disabled'] && empty($data['hide_button'])) : ?>
      <span class="input-group-btn">
        <button class="btn btn-default btn-sm button button_lookup" <?php 
          ?> onclick="lookup_onclick(this, event)" title="<?php
          echo $T->t('Удерживайте Ctrl, чтобы открыть карточку'); ?>" <?php 
          echo $data['template_prefix']; ?>id="<?php echo $data['code']; ?>_btn">
          <span class="glyphicon glyphicon-list"></span>
        </button>
      </span>
    <?php endif; ?>
  </div>
</div>
</div>