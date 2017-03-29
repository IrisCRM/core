<?php
/**
 * Поле-чекбокс
 */
?>
<div class="checkbox col-sm-<?php echo 2 + $data['colwidth']; 
  echo $data['mandatory'] ? ' required' : ''; ?>">
  <?php if (empty($data['hide_label'])) : ?>
    <label for="<?php echo $data['code']; 
      ?>" <?php echo $data['title'] ? ' title="' . $data['title'] . '"' : '';
      ?>><?php echo $data['caption']; ?></label>
  <?php endif; ?>
    <input type="checkbox" <?php 
      echo $data['template_prefix']; ?> id="<?php echo $data['code']; 
      ?>" <?php echo $data['value'] ? ' checked' : ''; 
      ?> <?php echo $data['attributes']; 
      ?>/>
    <?php echo $data['hidden']; ?>
</div>