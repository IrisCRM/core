<?php
/**
 * Поле-radio
 */
?>
<div class="radiobtn-cont">
  <div class="radiobtn-values" <?php echo $data['attributes_radio']; 
  ?>>
    <table class="rb-table">
      <tr>
        <?php for ($i = 0, $items = count($data['items']); $i < $items; $i++) : ?>
          <?php
            $rbclass = 'm';
            if ($i == 0) {
              $rbclass = 'f';
            }
            if ($i == $items - 1) {
              $rbclass = 'l';
            }
            $data['items'][$i]['selected'] ? $rbselectedclass = ' rb-selected-' . $rbclass : $rbselectedclass = '';
          ?>
          <td><span onclick="selectRadioButton(this)" class="rbelem-<?php echo $rbclass.$rbselectedclass; 
            ?>" <?php echo $data['items'][$i]['attributes']; 
            ?> value="<?php echo $data['items'][$i]['value']; 
            ?>" selected="<?php echo $data['items'][$i]['selected'] ? 'yes' : 'no'; 
            ?>"><span class="rb-caption"><?php echo $data['items'][$i]['caption']; 
              ?></span></span></td>
        <?php endfor; ?>
      </tr>
    </table>
  </div>
  <select class="edtText" style="width: 100%; display: none" <?php echo $data['template_prefix']; ?>id="<?php echo $data['code']; 
  ?>" <?php echo $data['attributes']; 
  ?> onFocus="this.className = 'edtText_selected';" onBlur="this.className = 'edtText';">
  <?php 
    // Выбрано ли какое-либо значение
    $have = false;
    foreach ($data['options'] as $option) {
      if ($option['selected']) {
        $have = true;
        break;
      }
    }
  ?>
  <?php foreach ($data['options'] as $option) : ?>
    <option<?php echo $option['selected'] || (!$have && $option['value'] == 'null') ? ' selected' : ''; 
    ?> value="<?php echo $option['value']; 
    ?>"><?php echo $option['caption']; ?></option>
  <?php endforeach; ?>
  </select><?php 
    echo $data['hidden']; 
  ?>
</div>