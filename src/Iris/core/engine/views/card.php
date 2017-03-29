<?php
/**
 * Карточка
 */
?>
<div onclick="Windows.focus(get_window_id(this))">
  <?php getView('card-header', $data); ?>

  <div class="card_body_div"><?php
    if (!$data['show_details']) {
      getView('card-form', $data['fields']);
    }
    else { ?>
      <table class="card_body_table" style="width: 100%">
        <tbody>
          <tr>
            <td class="tabs_cont" style="width: 150px"><?php getView('card-details', $data['details']); ?></td>
            <td class="tabs_card_divider">
              <div class="tabs_card_divider_button tabs_card_divider_min" onclick="changeCardTabsVisible(this)"></div>
            </td>
            <td class="card_content" type="card">
              <div type="card_cont"><?php getView('card-form', $data['fields']); ?></div>
              <div type="detail_cont" style="display: none; height: 100%"></div>
              <div class="card_shadow" type="shadow" style="display: none"></div>
            </td>
          </tr>
        </tbody>
      </table>
    <?php } ?>
  </div>
</div>