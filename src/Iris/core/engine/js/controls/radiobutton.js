// ----------------------------------------------------------
// функции для элемента radiobutton
// создан: miv, 03.01.2010
// ----------------------------------------------------------

// функция выбора значения в radiobutton (только для ядра)
function selectRadioButton(element, p_nochange_select) {
  if ('bootstrap' == g_vars.template) {
    var elemValue = jQuery(element).children().data('value');
    var div = jQuery(element).parents('.radiobtn-values');
    var active = div.children('.active');
    var select = jQuery(element).parents('.radiobtn-values').next('select');

    if (p_nochange_select == 1) {
      if (active.length) {
        active.removeClass('active');
      }
      jQuery(element).addClass('active')
      return;
    }

    div.children('label').each(function(idx, item) {
      var label = jQuery(item);
      var input = label.children();
      if (input.data('value') == elemValue) {
        /*
        if (elemValue == select.val()) {
          label.removeClass('active');
          input.removeAttr('checked');
          select.val('');
        }
        else {
          label.addClass('active');
          input.attr('checked', 'checked');
          select.val(elemValue);
        }
        */
        if (!label.hasClass('active')) {
          select.val(elemValue);
          jQuery(select).trigger("field:edit");
          jQuery(select).trigger("field:edited");
        }
        else {
          // TODO: давать возможност снимать значение для списков, имеющих null (have_null)
          label.removeClass('active');
          // select.val('null');
        }
      }
      else {
        label.removeClass('active');
        input.removeAttr('checked');
      }
    });
    return;
  }

  // старая логика (не bootstrap)
  var rb_elem = $(element);

  // if (rb_elem.hasClassName('radiobtn-values') == true) {
  //   return;
  // }

  // if (rb_elem.hasClassName('rb-caption') == true) {
  //   rb_elem = rb_elem.up();
  // }
  // контейнер, хранящий элементы radiobutton
  var rb_values_cont = rb_elem.up('div.radiobtn-values');
  rb_values_cont.up('div.radiobtn-cont').removeClassName('rb_empty');

  // если у элемента нет пустого значения в списке и нажали 
  // на выбранный элемент, то выйдем
  if ((rb_values_cont.getAttribute('have_null') == 'no') && 
      (rb_elem.getAttribute('selected') == "yes")) {
    return;
  }

  // снимем текущее значение
  var selected_elem = rb_values_cont.down('span[selected="yes"]');
  if (selected_elem != undefined) {
    selected_elem.toggleClassName('rb-selected-' + 
        selected_elem.getAttribute('pos'));
    selected_elem.setAttribute('selected', 'no');
  }

  var rb_new_value = 'null';
  if (rb_elem != selected_elem) {
    // выберем нажатое значение
    rb_elem.toggleClassName('rb-selected-' + rb_elem.getAttribute('pos'));
    rb_elem.setAttribute('selected', 'yes');
    rb_new_value = rb_elem.getAttribute('value');
  }

  if (p_nochange_select == 1) {
    return; // если запустили в режиме
  }
  
  // установим select
  var select = rb_values_cont.up('div.radiobtn-cont').down('select');
  for (var i = 0; i < select.options.length; i++) {
    if (select.options[i].value == rb_new_value) {
      //select.selectedIndex = i;
      //select.options[i].selected = true;
      jQuery(select).val(rb_new_value);
      // вызовем фиктивное событие смены radiobutton
      $(select).fire("radiobutton:changed");
      jQuery(select).trigger("radiobutton:changed");
      jQuery(select).trigger("field:edit");
      jQuery(select).trigger("field:edited");
      break;
    }
  }
}
// Синхронизирует информацию между скрытым select и мультичекбоксом.
// После вызова функции, значение select не меняется, а мультичекбокс начинает показывать то, что указано в select
// функция вернет true, если удалось синхронизировать значение radiobutton или false, если синхронизация не удалась
function refreshRadioButtonValue(select_field) {
    var rb_cont = select_field.prev();
    var value = select_field.val();
    var selectedItemSelector = g_vars.template === 'bootstrap' ?
      'label.active' : 'span[selected="yes"]';
    // если в select указали пустое значение, то снимем текущее значение у radiobutton
    if (value == 'null') {
        selectRadioButton(rb_cont.find(selectedItemSelector).get(0), 1);
        return true;
    }
    // "нажмем" на тот элемент radiobutton, значение которого совпадает с select
    var item = g_vars.template === 'bootstrap' ?
      rb_cont.find("input[data-value='" + value + "']").parent().get(0) :
      rb_cont.find("span[value='" + value + "']").get(0);
    selectRadioButton(item, 1);

    return false; // еслине удалось синхронизировать radiobutton то вернем false
}
