/**
 * Родительский "класс" для таблиц
 */
var IrisGridController = IrisController.extend({

  render: function () {},

  events: {},

  /**
   * Отображает итоги внизу таблицы
   *
   * @param {string} [windowId=$(this.el.id)] Id таблицы.
   */
  showTotal: function(windowId) {
    var l_grid;
    if (windowId == undefined) {
      l_grid = $(this.el.id); // получаем грид 
    }
    else {
      l_grid = $(windowId);
    }

    // Обернем строку с итогами в table, чтобы добавить справа под скроллом колонку
    var data = {
      id: l_grid.getAttribute('id'),
      scrollbar_width: g_vars.scrollbar_width,
      items: []
    }
    
    // По всем колонкам таблицы
    for (var i=0; i<l_grid.rows[0].cells.length; i++) {
      // По всем переданным параметром колонкам
      if ($(l_grid.rows[0].cells[i]).hasAttribute('total_value')) {
        data.items.push({
          width: $(l_grid.rows[0].cells[i]).getWidth(),
          total: $(l_grid.rows[0].cells[i]).getAttribute('total_value')
        });
      }
    }
    if (data.items.length == 0) {
      return;
    }

    if ($(l_grid.getAttribute('id')+'_summary')) {
      jQuery('#' + l_grid.getAttribute('id')+'_summary').replaceWith(
          _.template(jQuery('#grid-summary').html(), {data: data}));
    }
    else {
      var parentContainer = l_grid.up('div[conttype="outer"]').up();
      var old_height = $(parentContainer).getHeight();
      var div_outer = l_grid.up('div[conttype="outer"]');
      jQuery('#' + windowId).parents('div[conttype="outer"]').append(_.template(
        jQuery('#grid-summary').html(), {data: data}));
      var new_height = $(parentContainer).getHeight();
      
      //После вставки обновим высоту грида
      var elems_height = 0;
      for (var i=0; i<$(parentContainer).children.length; i++) {
        //try на тот случай, если попадется лишний перевод строки, который зачтется за childnode
        try {
          if ('outer' != parentContainer.children[i].getAttribute('conttype')) { 
            elems_height += $(parentContainer.children[i]).getHeight();
          }
        } 
        catch(e) {}
      }
      //Компенсируем высоту parentContainer, она меняется везде кроме chrome и firefox после добавления строки summary
      elems_height += new_height-old_height;
      div_outer.setAttribute('elems_height', elems_height);
      updateGridHeight(l_grid);
      updateGridWidth(l_grid);
    }
  },

  /**
   * Отобразить кнопку для печати ПФ
   *
   * @param {string} [caption="Печать..."] Надпись на кнопке
   * 
   * @param {Array} [params] Параметры отображения ПФ. Возможные ключи
   * * method - метод, который будет вызван на сервере для отрисовки ПФ. 
   *   По умолчанию renderPrintFormButton
   * * onDraw - Обработчик, который будет вызван после отрисовки ПФ.
   */
  drawPrintFormButton: function(caption, params) {
    var p_grid_id = this.el.id;
    if (caption == undefined) {
      caption = T.t('Печать') + '&hellip;';
    }
    if (params == undefined) {
      params = {};
    }
    if (params['method'] == undefined) {
      params['method'] = 'renderPrintFormButton';
    }

    var btn_id = 'el' + (Math.random() + "").slice(3);

    Transport.request({
      section: this.sectionName,
      'class': this.baseClassName,
      method: params['method'],
      parameters: {
        'code': btn_id,
        'onclick': "irisControllers.getController('" + this.baseClassName + "', '" + 
          this.el.id + "')._onClickPrintButton(this)"
      },
      onSuccess: function(transport) {
        var data = transport.responseText.evalJSON().data;
        g_InsertUserButtons(p_grid_id, data.button, undefined, 'pf_button');
        if (params.onDraw != undefined) {
          params.onDraw();
        }
      }
    });

  },

  _onClickPrintButton: function(button) {
    // ID записи, для которой надо напечатать форму
    var record_id = this.getSelectedId();

    var self = this;

    this.customGrid({
      method: 'renderSelectPrintFormDialog',
      onSelect: function(pf_id) {
        if (pf_id && record_id) {
          window.open(g_path + 
              '/printform.php?_func=render&record_id=' + record_id +
              '&id=' + pf_id);
        }
      }
    });
  },

  /**
   * Получить Id выбранной записи
   */
  getSelectedId: function() {
    var row_number = this.$el.attr('selectedrow');
    if (row_number == -1 || row_number == undefined) {
      return null;
    }
    return this.$el.find('tr:eq(' + row_number + ')').attr('rec_id');
  }

});
