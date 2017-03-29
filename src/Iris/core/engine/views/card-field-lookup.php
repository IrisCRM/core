<?php
/**
 * Поле-lookup
 */
?>
<table width=100% cellspacing="0">
  <tbody>
    <tr>
      <td>
        <input <?php echo $data['template_prefix']; ?>id="<?php echo $data['code']; 
        ?>" class="edtText<?php echo $data['disabled'] ? ' edtText_disabled' : ''; 
        ?>" style="width: 100%" type="text" value ="<?php echo $data['value']; 
        ?>" onKeyUp="DrawAutoComplete(this, event)" <?php echo $data['disabled'] ? ' readonly' : ''; 
        ?> <?php echo $data['attributes']; 
        ?> onFocus="this.className = 'edtText_selected';" onBlur="this.className = 'edtText'; TryToCloseAutoCompleteElem(this);"><?php 
          echo $data['hidden']; ?>
      </td>
      <?php if (!$data['disabled'] && empty($data['is_filter'])) : ?>
      <td width=20>
        <input type="button" class="button button_lookup" <?php echo $data['template_prefix']; ?>id="<?php echo $data['code']; 
        ?>_btn" value="..." onclick="lookup_onclick(this, event)" title="<?php
          echo $T->t('Удерживайте Ctrl, чтобы открыть карточку'); ?>">
      </td>
      <?php endif; ?>
    </tr>
  </tbody>
</table>
