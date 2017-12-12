<?php
/**
 * Главное меню
 */
?>
<nav class="navbar navbar-default navbar-static-top" role="navigation">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu_elements">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
  </div>
  <div class="collapse navbar-collapse" id="menu_elements">
    <ul class="nav navbar-nav" id="menu" selected_col="0" isLoading="0" ondblclick="ClearItemCacheAndSelect(event);">
    <?php foreach ($data['menu'] as $item) : ?>
      <li is_root="1" class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $item['name']; ?> <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <?php foreach ($item['items'] as $sub_item) : ?>
            <li>
              <a href="#" section="<?php echo $sub_item['section']; ?>"
                col_number="<?php echo $sub_item['col_number']; ?>"
                onclick="<?php echo $sub_item['onclick']; ?>"><?php echo $sub_item['name']; ?></a>
            </li>
          <?php endforeach; ?>
        </ul>
      </li>
    <?php endforeach; ?>
    </ul>
    <ul class="nav navbar-nav navbar-right no-right-margin">
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $T->t('Создать', null, 'Create'); ?> <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li>
            <div class="row dropwidth0<?php echo count($data['new']); ?>">
              <?php foreach ($data['new'] as $item) : ?>
                <ul class="droplist col-md-4">
                  <li class="dropdown-header"><?php echo $item['name']; ?></li>            
                  <?php foreach ($item['items'] as $sub_item) : ?>
                    <li><a href="#" onclick="openCard({source_name: jQuery(this).attr('section')});" section="<?php echo $sub_item['section']; ?>"><?php echo $sub_item['name']; ?></a></li>
                  <?php endforeach; ?>
                </ul>
              <?php endforeach; ?>
            </div>
          </li>
        </ul>
      </li>
    </ul>
  </div>
</nav>