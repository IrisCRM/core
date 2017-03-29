<?php
/**
 * Поле-строка
 */
?>
<table width=100% cellspacing="0">
  <tbody>
    <tr>
      <td>
        <table width=100% cellspacing="0">
          <tbody>
            <tr>
              <td>
                <input class="edtText" style="width: 100%" type="text" <?php echo $data['template_prefix']; ?> id="<?php echo $data['code']; 
                  ?>" value="<?php echo $data['value']; 
                  ?>" <?php echo $data['attributes']; 
                  ?> onFocus="this.className = 'edtText_selected';" onBlur="this.className = 'edtText'; FormatPhoneNumber(this);"/><?php
                    echo $data['hidden']; 
                  ?>
              </td>
              <?php if ($data['code_ext'] != '') : ?>
                <td class="form_table phone_td_phone"><span class="card_elem_caption<?php 
                  echo $data['mandatory_ext'] ? ' card_elem_mandatory': ''; 
                ?>"><?php echo $T->t('доб', null, 'Card'); ?></span></td>                
                <td class="phone_td_addl">
                  <input class="edtText" style="width: 100%" type="text" <?php echo $data['template_prefix']; ?> id="<?php echo $data['code_ext']; 
                  ?>" value="<?php echo $data['value_ext']; 
                  ?>" <?php echo $data['attributes_ext']; 
                  ?> onFocus="this.className = 'edtText_selected';" onBlur="this.className = 'edtText'; FormatPhoneNumber(this);"/><?php 
                    echo $data['hidden_ext']; 
                  ?>
                </td>
              <?php endif; ?>
            </tr>
          </tbody>
        </table>
      </td>
      <td width=21>
        <div class="phone_img" id_primary="<?php echo $data['code']; ?>" onclick="call_to(this)"/>
      </td>
    </tr>
  </tbody>
</table>