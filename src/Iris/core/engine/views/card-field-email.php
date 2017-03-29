<?php
/**
 * Поле-email
 */
?>
<table width=100% cellspacing="0">
  <tbody>
    <tr>
      <td><input class="edtText" style="width: 100%" type="text" <?php echo $data['template_prefix']; ?>id="<?php echo $data['code']; 
        ?>" value="<?php echo $data['value']; 
        ?>" <?php echo $data['attributes']; 
        ?> onFocus="this.className = 'edtText_selected';" onBlur="this.className = 'edtText';"/><?php 
          echo $data['hidden']; 
        ?></td>
      <td width=20><div class="email_img" onclick="mail_to(this)"/></td>
    </tr>
  </tbody>
</table>