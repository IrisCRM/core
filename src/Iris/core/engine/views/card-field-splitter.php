<?php
/**
 * Поле-разделитель
 */
?>
<table class="form_table" width=100% border=0<?php 
if (!empty($data['code'])) : ?> id="<?php echo $data['code']; ?>"<?php endif; ?>>
  <tr>
    <td class="form_table" width=20><HR class="form_hr"></td>
    <td class="form_table" width=10><nobr><div class="hr_caption"><?php
      echo $data['caption'];
    ?></div></nobr></td>
    <td class="form_table" ><HR class="form_hr"></td>
  </tr>
</table>