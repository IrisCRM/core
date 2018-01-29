<?php
/**
 * Панель поиска customgrid
 */
?>
<div class="panel panel-default grid_search no-bottom-margin">
  <div class="panel-body no-padding">
    <!-- disable submit by enter with onsubmit attr -->
    <form role="form" onsubmit="return false;">
      <?php /* Список полей грида */ ?>

      <div class="flexbox-container">

        <div
          class="flexbox-container flexbox-justify-center flexbox-align-center"
        >
          <div
            <?php if (isset($data['title'])) : ?>
              class="search-title"
              title="<?php echo $data['title'] ?>"
            <?php endif; ?>
          >
            <?php echo $data['caption'];?>
          </div>
        </div>

        <div class="flexbox-item-gap"></div>

        <?php /* Поле "Поиск" */ ?>
        <div class="flexbox-item-wide">
          <input
            type="text"
            data-role="searchinput"
            class="form-control input-sm search_value"
            value="<?php echo $data['searchValue']; ?>"
          />
        </div>
        <div class="flexbox-item-gap"></div>
        <?php /* Кнопки "Поиск" и "Сброс" */ ?>
        <div class="flexbox-container">
          <div>
            <input
              type="button"
              data-role="search"
              class="btn btn-block btn-default btn-primary btn-sm"
              value="<?php echo $T->t('Поиск'); ?>"
            />
          </div>
          <div class="flexbox-item-gap"></div>
          <div>
            <input
              type="button"
              data-role="clear"
              class="btn btn-block btn-default btn-sm"
              value="<?php echo $T->t('Сброс'); ?>"
            />
          </div>
        </div>

      </div>

    </form>
  </div>
</div>