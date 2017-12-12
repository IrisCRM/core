<?php
/**
 * Всплывающий элемент автозавершения
 */
?>
<ul
  id="<?php echo $data['elementId']; ?>"
  class="dropdown-menu"
  style="display: block"
  selectedindex="0"
  hover_flag=0
  onmouseover="SetHoverOrDelete(jQuery(this))"
  onmouseout="this.setAttribute('hover_flag', 0)"
  onclick="ApplyAutoCompleteValue(jQuery(this))"
>
<?php foreach ($data['values'] as $index => $item) : ?>
  <li class="<?php echo $index == 0 ? 'active' : '' ?>">
    <a
      href="#"
      style="white-space: nowrap;"
      value="<?php echo $item['id']; ?>"
      onmouseover="select_auto_item(jQuery(this).parents('[hover_flag]').last(), <?php echo $index; ?>)"
    >
      <?php
        if (iris_strpos($data["searchValue"], '_') === false &&
          iris_strpos($data["searchValue"], '%') === false)
        {
          $finded_pos = iris_strpos(
            iris_strtolower($item['caption']),
            iris_strtolower($data["searchValue"]));
          $display_auto_value = iris_substr(
            $item['caption'],
            $finded_pos,
            iris_strlen($data["searchValue"]));
          echo iris_str_replace(
            (string)$display_auto_value,
            '<mark>' .
              (string)$display_auto_value .
              '</mark>',
            (string)$item['caption']);
        } else {
          echo $item['caption'];
        }
       ?>
    </a>
  </li>
<?php endforeach; ?>
</ul>
