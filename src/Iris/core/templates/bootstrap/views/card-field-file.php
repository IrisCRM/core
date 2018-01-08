<?php
/**
 * Поле-файл
 */

function getGlyphIcon($extension) {
  $glyphShortName = "file";
  $glyphs = [
    // glyph => [ extensions ]
    "film" => [ "avi", "flw", "mkv" ],
    "book" => [ "fb2", "epub" ],
    "picture" => [ "png", "bmp", "jpg", "jpeg", "psd", "gif", "tif" ],
    "cog" => [ "xml", "php", "css", "js", "sql", "exe", "bak", "backup" ],
    "compressed" => [ "7z", "zip", "rar", "tar", "tar.gz" ],
    "font" => [ "ttf" ],
    "music" => [ "mp3", "wav", "ogg" ],
    "text-background" => [ "doc", "docx", "odt", "pdf", "ppt" ],
    "th-list" => [ "xls", "xlsx", "ods", "csv" ],
  ];

  foreach ($glyphs as $glyph => $extensions) {
    if (in_array(strtolower($extension), $extensions)) {
      $glyphShortName = $glyph;
      break;
    }
  }

  return "glyphicon-$glyphShortName";
}

?>
<div class="form-group<?php echo $data['mandatory'] ? ' required' : ''; ?> col-sm-<?php echo $data['fieldwidth']; ?>">
  <?php if (empty($data['hide_label'])) : ?>
    <label for="<?php echo $data['code']; 
      ?>" class="col-sm-<?php echo $data['labelwidth']; ?> no-horizontal-padding control-label<?php 
      echo $data['title'] ? ' card_elem_title"' : '';
      ?>"<?php echo $data['title'] ? ' title="' . $data['title'] . '"' : '';
      ?>><?php echo $data['caption']; ?></label>
  <?php endif; ?>
  <div class="col-sm-<?php echo $data['controlwidth']; ?> no-horizontal-padding">
    <div id="<?php echo $data['item_id']; ?>_fc">
      <input id="<?php echo ($data['value'] ? '#' : '') . $data['code']; 
        ?>" name="<?php echo ($data['value'] ? '#' : '') . $data['code']; 
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
      <div id="<?php echo $data['item_id']; ?>_caption">
        <div class="fileinput_caption pull-left glyphicon <?php echo getGlyphIcon($data['extension']); ?>"></div>
        <a target="_blank" class="fileinput_link" href="<?php 
          echo $data['link']; ?>"><?php 
          echo $data['value']; ?></a>
        <span class="glyphicon glyphicon-remove pull-left fileinput_glyphicon" id="<?php echo $data['item_id']; 
          ?>_clearbtn" onclick="clearFileInput(this)"></span>
      </div>
    <?php else : ?>
      <div id="<?php echo $data['item_id']; ?>_caption">
      </div>
    <?php endif; ?>
    <?php echo $data['hidden']; ?>
  </div>
</div>
