<?php
/**
 * Заголовок карточки
 */
?>
<div class="card_header_div<?php 
  echo $data['children'] ? ' children' : '';
  echo $data['section'] ? ' card_header_div_'.$data['section'] : '';
  echo !$data['show_header'] ? ' hidden' : ''; ?>">
  <table class="card_header_table">
    <tr class="card_header_top_row">
      <td rowspan="3" class="card_icon_td<?php 
        echo $data['section'] ? ' card_icon_td_'.$data['section'] : ''; ?>"></td>
      <td class="card_top_buttons_panel"><div class="card_top_buttons_div"></div></td>
      <td rowspan="3" class="card_right_spacer"></td>
    </tr>
    <tr class="card_header_middle_row">
      <td><span class="card_caption_window"><?php 
        echo $data['title']; ?></span><span class="card_caption_value"><?php 
        echo $data['name'];?></span></td>
    </tr>
    <tr class="card_header_bottom_row">
      <td class="card_bottom_buttons_panel"><div class="card_bottom_buttons_div"></div></td>
    </tr>
  </table>
</div>