<?php
/**
 * Поле-кнопка
 */
?>
<table style="width: 100%; table-layout: fixed">
  <tbody>
    <tr>
      <td align="<?php echo !empty($data['align']) ? $data['align'] : 'left'; 
        ?>"><input class="button" style="width: <?php 
          echo $data['width'] ? $data['width'] : '100%'; 
          ?>" type="<?php echo $data['type']; 
          ?>" <?php echo $data['template_prefix']; 
          ?>id="<?php echo $data['code']; 
          ?>" value="<?php echo $data['caption']; 
          ?>" <?php echo $data['attributes']; 
          ?><?php if (!empty($data['onclick'])) : 
            ?> onclick="<?php echo $data['onclick']; ?>"<?php 
          endif; ?>/></td>
    </tr>
  </tbody>
</table>