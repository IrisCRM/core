<?php
/**
 * Поле-файл
 */
?>
<div class="form-group<?php echo $data['mandatory'] ? ' required' : ''; ?>">
  <?php if (empty($data['hide_label'])) : ?>
    <label for="<?php echo $data['code']; 
      ?>" class="col-sm-2 control-label<?php 
      echo $data['title'] ? ' card_elem_title"' : '';
      ?>"<?php echo $data['title'] ? ' title="' . $data['title'] . '"' : '';
      ?>><?php echo $data['caption']; ?></label>
  <?php endif; ?>
  <div class="col-sm-<?php echo $data['colwidth']; ?>">
    <div id="<?php echo $data['item_id']; ?>_fc">
      <input id="<?php echo ($data['value'] ? '' : '') . $data['code']; 
        ?>" name="<?php echo ($data['value'] ? '' : '') . $data['code']; 
        ?>" <?php echo $data['attributes']; 
        ?> class="fileinput_originalFileInput" type="file" onchange="ShowSelectedFile(this)">
    </div>
    <div class="pull-left">
      <input type="button" class="btn btn-default btn-sm button" id="_<?php 
        echo $data['item_id']; ?>_fakebutton" value="<?php 
        echo $T->t('Выбрать'); 
        ?>..." onclick="jQuery(this).parent().prev().children('input').click()">
    </div>
    <?php if ($data['value']) : ?>
      <?php 
        $extensions = array(
          'doc' => '0',
          'docx' => '0',
          'bmp' => '16',
          'jpg' => '32',
          'jpeg' => '32',
          'png' => '48',
          'gif' => '64',
          'psd' => '80',
          'mp3' => '96',
          'wav' => '96',
          'ogg' => '96',
          'avi' => '112',
          'wmv' => '112',
          'flv' => '112',
          'pdf' => '128',
          'exe' => '144',
          'txt' => '160',
        );
        $pos = $extensions[$data['extension']];
        if ($pos == NULL) {
          $pos = '176';
        }
      ?>
      <div id="<?php echo $data['item_id']; 
        ?>_caption" class="fileinput_caption" style="background: url('<?php 
        echo $data['template_path']; 
        ?>images/fileselect_icons.png') no-repeat 0 -<?php echo $pos; ?>px">
        <a target="_blank" class="fileinput_link" href="<?php 
          echo $data['link']; ?>"><?php 
          echo $data['value']; ?></a>
        <span class="glyphicon glyphicon-remove poll-left" id="<?php echo $data['item_id']; 
          ?>_clearbtn" onclick="clearFileInput(this)"></span>
      </div>
    <?php else : ?>
      <div class="fileinput_caption" style="display: none" id="<?php 
        echo $data['item_id']; ?>_caption"></div>
    <?php endif; ?>
    <?php echo $data['hidden']; ?>
  </div>
</div>
