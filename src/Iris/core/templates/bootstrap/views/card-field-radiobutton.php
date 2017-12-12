<?php
/**
 * Поле-radio
 */
?>
<div class="form-group<?php echo $data['mandatory'] ? ' required' : ''; ?> col-sm-<?php echo $data['fieldwidth']; ?> no-horizontal-padding">
  <?php if (empty($data['hide_label'])) : ?>
    <label for="<?php echo $data['code']; 
      ?>" class="col-sm-<?php echo $data['labelwidth']; ?> no-<?php echo $data['controlindex'] > 0 ? "horizontal" : "right"; ?>-padding control-label<?php 
      echo $data['title'] ? ' card_elem_title"' : '';
      ?>"<?php echo $data['title'] ? ' title="' . $data['title'] . '"' : '';
      ?>><?php echo $data['caption']; ?></label>
  <?php endif; ?>
  <div class="col-sm-<?php echo $data['controlwidth']; ?> no-left-padding flexbox-container flexbox-justify-center">

    <?php 
      // Get previous value
      $previous = '';
      foreach ($data['items'] as &$item) {
        if ($item['selected']) {
          $previous = $item['value'];
          break;
        }
      }
    ?>
    <div class="btn-group radiobtn-values" <?php 
      echo $data['attributes_radio'];
      ?> data-toggle="buttons">

      <?php foreach ($data['items'] as &$item) : ?>
        <label class="btn btn-default btn-sm<?php 
            echo $item['selected'] ? ' active' : '';
          ?>" onclick="selectRadioButton(this)">
          <input type="checkbox" name="options" data-value="<?php 
            echo $item['value']; ?>"<?php 
            echo $item['selected'] ? ' checked' : '';
            ?>><?php echo $item['caption']; ?>
        </label>
      <?php endforeach; ?>

    </div>

    <select style="display: none" data-previous="<?php echo $previous;
      ?>" <?php 
      echo $data['template_prefix']; ?>id="<?php echo $data['code']; 
      ?>" <?php echo $data['attributes']; ?>>
      <?php 
        // Выбрано ли какое-либо значение
        $have = false;
        foreach ($data['options'] as &$option) {
          if ($option['selected']) {
            $have = true;
            break;
          }
        }
      ?>
      <?php foreach ($data['options'] as &$option) : ?>
        <option<?php 
          echo $option['selected'] || (!$have && $option['value'] == 'null') ? 
            ' selected' : ''; 
          ?> value="<?php echo $option['value']; 
          ?>"><?php echo $option['caption']; ?></option>
      <?php endforeach; ?>
    </select><?php 
      echo $data['hidden']; 
    ?>

  </div>
</div>