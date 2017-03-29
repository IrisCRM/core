<?php
/**
 * Поле-матрица (вкладка в карточке)
 */
?>
<table class="form_table matrix" width="100%" cellspacing=0 <?php echo $data['attributes']; ?>>
  <tbody>
    <?php if (count($data['grid']) > 0) :
      $tab_count = count($data['grid'][0]['fields']['tabs']);
      foreach ($data['grid'][0]['fields']['tabs'] as $key => &$tab) : 
        $multiline = count($tab['rows']) > 1 || $tab_count > 1;
        if (!$multiline) :
          $row = $tab['rows'][0];
          $col_count = count($row['fields']); ?>
          <tr class="form_row">
            <?php foreach ($row['fields'] as &$field) : ?>
              <th class="form_table" colspan=2 width="<?php echo 100 / $col_count; ?>%"><?php 
                echo $field['caption']; 
              ?></th>
            <?php endforeach; ?>
            <th></th>
          </tr>
          <tr><td colspan="<?php echo $col_count * 2 + 1; ?>"><hr></td></tr>
        <?php endif;
      endforeach;
    endif; ?>
    <?php for ($j = 0; $j < count($data['grid']); $j++) : $card = &$data['grid'][$j]; ?>
      <?php /* Закладки карточки */ ?>
      <?php $max_col_count = 0; ?>
      <?php foreach ($card['fields']['tabs'] as $key => &$tab): ?>
        <?php /* Строки карточки */ ?>
        <?php for ($i = 0; $i < count($tab['rows']); $i++) : ?>
          <tr class="form_row<?php echo $multiline ? ' multiline' : '';
            echo $j == count($data['grid']) - 1 ? ' hidden' : '';
            echo $i == 0 ? ' first' : '';
            echo $i == count($tab['rows']) - 1 ? ' last' : '';
            ?>" rec_id="<?php echo $card['fields']['id_temp']; ?>">
            <?php /* ID записи */ ?>
            <?php if ($i == 0) : ?>
              <td class="hidden">
                <input type="hidden" class="id" <?php echo $j == count($data['grid']) - 1 ? '_' : ''; ?>id="<?php echo $card['fields']['id_code']; 
                  ?>" value="<?php echo $card['fields']['id']; ?>">
              </td>
            <?php endif; ?>
            <?php /* Поля карточки */ ?>
            <?php 
              $col_count = count($tab['rows'][$i]['fields']);
              if ($col_count > $max_col_count) {
                $max_col_count = $col_count;
              }
            ?>
            <?php foreach ($tab['rows'][$i]['fields'] as &$field) : ?>
              <?php if ($multiline && $field['type'] != 'splitter' && $field['type'] != 'button' && $field['type'] != 'detail' && $field['type'] != 'matrix') : ?>
                <td class="form_table" align="left" width="1%"><nobr><span class="card_elem_caption<?php
                  echo $field['mandatory'] ? ' card_elem_mandatory' : ''; 
                ?><?php echo $field['title'] ? ' card_elem_title"' : ''; 
                ?>"<?php echo $field['title'] ? ' title="' . $field['title'] . '"' : ''; 
                ?>><?php echo $field['caption']; 
                ?><br></span></nobr></td>
              <?php endif; ?>
                <td class="form_table" colspan=<?php echo $field['size'] * 2 - (!$multiline || $field['type'] == 'splitter' || $field['type'] == 'button' || $field['type'] == 'detail' || $field['type'] == 'matrix' ? 0 : 1); 
                ?> width="<?php echo 100 / $col_count - 1; ?>%"><?php
                  /* Поле карточки */
                  //$field['code'] = '_' . $field['code'];
                  getView('card-field-' . $field['type'], $field);
                ?></td>
            <?php endforeach; ?>
            <?php if ($i == 0) : ?>
              <td class="form_table menu" rowspan="<?php echo count($tab['rows']); ?>">
                <input class="button button_lookup button_matrix_delete" type="button" onclick="deleteCardRow(this);" value="X">
              </td>
            <?php endif; ?>
          </tr>
        <?php endfor;
      endforeach;
    endfor; ?>
    <tr class="form_row">
      <td class="form_table" colspan="<?php echo $max_col_count * 2 + 1; ?>">
        <input class="button button_matrix_append" style="padding-left: 5px; padding-right: 5px; margin: 0;" type="button" onclick="addCardRow(this);" value="<?php echo $T->t('Добавить'); ?>">
      </td>
    </tr>
    <tr><td colspan="<?php echo $max_col_count * 2 + 1; ?>"><hr></td></tr>
  </tbody>
</table>