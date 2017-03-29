<?php
/**
 * Поле-url
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
      <td width=20><div class="url_img" onclick="open_url(this)"/></td>
    </tr>
  </tbody>
</table>