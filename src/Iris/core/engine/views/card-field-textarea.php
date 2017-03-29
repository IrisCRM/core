<?php
/**
 * Поле-текст
 */
?>
<table style="width: 100%; table-layout: fixed">
  <tbody>
    <tr>
      <td><textarea class="edtText" style="width: 100%" type="<?php echo $data['type']; 
        ?>" <?php echo $data['template_prefix']; ?>id="<?php echo $data['code']; 
        ?>" rows="<?php echo $data['rows']; 
        ?>" <?php echo $data['attributes']; 
        ?> onFocus="this.className = 'edtText_selected';" onBlur="this.className = 'edtText';"/><?php 
          echo $data['value']; 
        ?></textarea><?php 
          echo $data['hidden']; 
        ?></td>
    </tr>
  </tbody>
</table>