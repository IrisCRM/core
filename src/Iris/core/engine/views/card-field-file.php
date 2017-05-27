<?php
/**
 * Поле-файл
 */
?>
<div id="<?php echo $data['item_id']; 
?>_fc"><input id="<?php echo ($data['value'] ? '#' : '') . $data['code']; 
  ?>" name="<?php echo ($data['value'] ? '#' : '') . $data['code']; 
  ?>" <?php echo $data['attributes']; 
  ?> class="fileinput_originalFileInput" type="file" onchange="ShowSelectedFile(this)" onmouseover="$(this.getAttribute('elem_uid')+'_fakebutton').className = 'fileinput_fakeButton_hover'" onmouseout="$(this.getAttribute('elem_uid')+'_fakebutton').className = 'fileinput_fakeButton'"></div>
<div id="<?php echo $data['item_id']; ?>_fakebutton" class="fileinput_fakeButton"></div>
<div class="fileinput_blocker"></div>
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
  $pos = !empty($extensions[$data['extension']]) ? $extensions[$data['extension']] : null;
  if ($pos == NULL) {
    $pos = '176';
  }
?>
  <div id="<?php echo $data['item_id']; 
  ?>_caption" class="fileinput_caption" style="background: url('<?php echo url($data['template_path']);
  ?>images/fileselect_icons.png') no-repeat 0 -<?php echo $pos; ?>px">
    <table>
      <tbody>
        <tr>
          <td class="fileinput_tdl">
            <a target="_blank" href="<?php echo $data['link']; ?>"><?php echo $data['value']; ?></a>
          </td>
          <td>
            <div id="<?php echo $data['item_id']; 
            ?>_clearbtn" class="fileinput_clearButton" onclick="clearFileInput(this)"></div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
<?php else : ?>
  <div id="<?php echo $data['item_id']; ?>_caption" class="fileinput_caption" style="display: none"></div>
<?php endif; ?>
<?php echo $data['hidden']; ?>