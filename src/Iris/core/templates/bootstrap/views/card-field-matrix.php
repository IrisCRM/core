<?php
/**
 * Поле-матрица (вкладка в карточке)
 */
?>
<div class="form_table matrix" <?php echo $data['attributes']; ?>>
  <?php if (count($data['grid']) > 0) :
    $tab_count = count($data['grid'][0]['fields']['tabs']);
    foreach ($data['grid'][0]['fields']['tabs'] as $key => &$tab) : 
      $multiline = count($tab['rows']) > 1 || $tab_count > 1;
      // Если все умещается в одну строку, то нарисуем заголовки колонок
      if (!$multiline) :
        $row = $tab['rows'][0];
        $col_count = count($row['fields']); ?>
        <div class="form_row row">
          <?php for ($i = 0, $s = 0; $i < $col_count; $i++) : ?>
            <div class="col-sm-<?php echo (int)((11 - $s) / ($col_count - $i)); ?>"><?php 
              $s += (int)((11 - $s) / ($col_count - $i));
              echo $row['fields'][$i]['caption']; 
            ?></div>
          <?php endfor; ?>
          <div class="col-sm-1"></div>
        </div>
        <div class="row"><div class="col-sm-12"><hr></div></div>
      <?php endif;
    endforeach;
  endif; ?>

  <?php for ($j = 0; $j < count($data['grid']); $j++) :
    $card = &$data['grid'][$j]; ?>
    <?php /* Закладки карточки */ ?>
    <?php $max_col_count = 0; ?>
    <?php foreach ($card['fields']['tabs'] as $key => &$tab): ?>
      <?php /* Строки карточки */ ?>
      <?php for ($i = 0; $i < count($tab['rows']); $i++) : ?>
        <div class="form_row row<?php 
          echo $multiline ? ' multiline' : '';
          echo $j == count($data['grid']) - 1 ? ' hidden'  : '';
          echo $i == 0 ? ' first' : '';
          echo $i == count($tab['rows']) - 1 ? ' last' : '';
          ?> flexbox-container flexbox-align-center horizontal-gutter" rec_id="<?php echo $card['fields']['id_temp']; ?>">
          <?php /* ID записи */ ?>
          <?php if ($i == 0) : ?>
            <div class="hidden">
              <input type="hidden" class="id" <?php 
                echo $j == count($data['grid']) - 1 ? '_' : ''; ?>id="<?php 
                echo $card['fields']['id_code']; 
                ?>" value="<?php echo $card['fields']['id']; ?>">
            </div>
          <?php endif; ?>
          <?php /* Поля карточки */ ?>
          <?php 
            $col_count = count($tab['rows'][$i]['fields']);
            if ($col_count > $max_col_count) {
              $max_col_count = $col_count;
            }
          ?>
          <?php
            $cnt = count($tab['rows'][$i]['fields']);
            $k = 0;
            $s = 0;
            foreach ($tab['rows'][$i]['fields'] as $index => &$field) : ?>
            <div class="form_table flexbox-item-wide"><?php
              /* Поле карточки */
              $s += (int)((11 - $s) / ($cnt - $k));
              //$field['code'] = '_' . $field['code'];
              $field['colwidth'] = 12 - 2 * $multiline;
              $field['hide_label'] = !$multiline;
              $field['fieldwidth'] = 12;
              $field['labelwidth'] = $multiline ? 6 : 0;
              $field['controlwidth'] = $multiline ? 6 : 12;
              $field['controlindex'] = $index; /* не используется */
              getView('card-field-' . $field['type'], $field);
              $k++;
            ?></div>
          <?php endforeach; ?>
          <div class="form_table menu matrix-delete-button-container">
            <?php if ($i == 0) : ?>
              <button class="btn btn-default btn-sm button button_lookup button_matrix_delete" onclick="deleteCardRow(this);" ><span class="glyphicon glyphicon-remove"></span></input>
            <?php endif; ?>
          </div>
        </div>
      <?php endfor;
    endforeach;
  endfor; ?>
  <div class="form_row row">
    <div class="form_table col-sm-12">
      <div class="form-group">
        <div class="col-sm-12">
          <input class="btn btn-default btn-sm button button_matrix_append" type="button" onclick="addCardRow(this);" value="<?php echo $T->t('Добавить'); ?>">
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12"><hr></div>
  </div>

</div>