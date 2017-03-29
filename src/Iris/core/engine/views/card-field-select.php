<?php
/**
 * Поле-select
 */
?>
<select class="edtText" style="width: 100%" <?php echo $data['template_prefix']; ?>id="<?php echo $data['code']; 
?>" <?php echo $data['attributes']; 
?> onFocus="this.className = 'edtText_selected';" onBlur="this.className = 'edtText';">
<?php foreach ($data['options'] as $option) : ?>
  <option<?php echo $option['selected'] ? ' selected' : ''; 
  ?> value="<?php echo $option['value']; 
  ?>" <?php echo $option['attributes']; 
  ?>><?php echo $option['caption']; ?></option>
<?php endforeach; ?>
</select><?php 
  echo $data['hidden']; 
?>