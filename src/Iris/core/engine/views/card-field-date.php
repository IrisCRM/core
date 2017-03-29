<?php
/**
 * Поле-дата
 */
?>
<table width=100% cellspacing="0">
  <tbody>
    <tr>    
      <td><input class="edtText" style="width: 100%" type="text" <?php echo $data['template_prefix']; ?>id="<?php echo $data['code']; 
        ?>" maxlength="<?php echo $data['maxlength']; 
        ?>" value="<?php echo $data['value']; 
        ?>" <?php echo $data['attributes']; 
        ?> onFocus="this.className = 'edtText_selected';" onBlur="this.className = 'edtText';"/><?php 
          echo $data['hidden']; 
        ?></td>
      <td width=20>
        <div onclick="new CalendarDateSelect(jQuery(this).parent().parent().find('input')[0], { time: <?php 
          echo $data['with_time'] ? 'true' : 'false'; ?>, buttons: <?php 
          echo $data['with_time'] ? 'true' : 'false'; ?>, embedded: false, year_range: 10 } );" class="calendar_img"/>
      </td>   
    </tr>
  </tbody>
</table>