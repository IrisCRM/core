<?php
/**
 * Поле-таблица (вкладка)
 */
?>
<table id="<?php echo $data['grid_code']; ?>" style="width: 100%; table-layout: fixed" class="card-grid">
  <tbody>
    <tr>
      <td>
        <?php getView('grid', $data['grid']); ?>
      </td>
    </tr>
  </tbody>
</table>