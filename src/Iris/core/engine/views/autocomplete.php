<?php
/**
 * Всплывающий элемент автозавершения
 */
?>
<table
  id="<?php echo $data['elementId']; ?>"
  class="autocomplete"
  style="width: <?php echo $data['elementWidth']; ?>px"
  selectedindex="0"
  hover_flag=0
  onmouseover="SetHoverOrDelete(jQuery(this))"
  onmouseout="this.setAttribute('hover_flag', 0)"
  onclick="ApplyAutoCompleteValue(jQuery(this))"
>
  <tbody>
    <?php foreach ($data['values'] as $index => $item) : ?>
      <tr class="<?php echo $index == 0 ? 'active' : '' ?>">
        <td
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
                '<span class="autocomplete-entry">' .
                  (string)$display_auto_value .
                  '</span>',
                (string)$item['caption']);
            } else {
              echo $item['caption'];
            }
           ?>
        </td>
      </tr>
    <?php endforeach; ?>

  </tbody>
</table>
