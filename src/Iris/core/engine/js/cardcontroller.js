/**
 * Родительский "класс" для карточек.
 * На каждую карточку (для каждой записи) должен создаваться отдельный 
 * экземпляр контроллера.
 */
var IrisCardController = IrisController.extend({

  render: function() {},

  /**
   * Обработчики в формате 'event selector': 'handlerName'
   *
   * @example <caption>Обычное поле</caption>
   * events: {
   *   'field:edit #Name': 'onChangeName'
   * }
   *
   * @example <caption>Поле matrix</caption>
   * events: {
   *   'field:edit #Date__d_Contact_Date_Matrix': 'onChangeDateMatrix'
   * }
   */
  events: {},

  /**
   * Включены ли обработчики изменения поля в случае изменения поля программно
   */
  autoEditEventsEnabled: true,

  /**
   * Получить поле по названию поля
   *
   * @param {string} id Код поля
   *
   * @param {Object} [event] Событие. Этот параметр необходимо заполнять
   * только в случае получения поля matrix.
   *
   * @return {jQuery} Найденное поле
   *
   * @example <caption>Обычное поле</caption>
   * var code = this.getField('TaskStateID')
   *     .find('[value=' + this.fieldValue('TaskStateID') + ']').attr('code');
   *
   * @example <caption>Поле matrix</caption>
   * irisControllers.classes.c_Contact = IrisCardController.extend({
   *   events: {
   *     'field:edit #Date__d_Contact_Date_Matrix': 'myEvent'
   *   },
   *  
   *   myEvent: function(event) {
   *     console.log(this.getField('Date', event).val());
   *   }
   * });
   *
   */
  getField: function(id, event) {
    if (event == undefined) {
      return this.$el.find('#' + id);
    }
    // Для полей matrix
    if (event.target != undefined) {
      var field_id = event.target.id;
      var parts = field_id.substring(1).split('__');
      var rec_id = parts[1];
      var detailCode = parts[2];
      return this.$el.find('#_' + id + '__' + rec_id + '__' + detailCode);
    }
    //if (event.code != undefined && event.id != undefined) {
      //return this.$el.find('#_' + id + '__' + event.id + '__' + event.code);
    //}
  },

  /**
   * Получить поля matrix
   *
   * По коду вкладки и названию поля возвращает массив найденных полей.
   * Количество элементов равно количеству строк в matrix. Поля возвращаются
   * в порядке их следования на форме.
   *
   * @param {string} detailCode Код вкладки
   *
   * @param {string} id Код поля
   *
   * @return {jQuery[]} Поля
   *
   * @example
   * var fields = this.getFields('d_Contact_Date_Matrix', 'Date');
   * _.each(fields, function(elem) {
   *   console.log(elem.val());
   * });
   */
  getFields: function(detailCode, id) {
    var detail = this.$el.find('.matrix[detail_code="' + detailCode + '"]');
    var fields = detail.find('.edtText, .edtText_selected, .edtText_empty, .edtText_invalid_data, .button, .id');
    var result = {};

    fields.each(function() {
      var elem = jQuery(this);
      if (elem.attr('id')) {
        var parts = elem.attr('id').substring(1).split('__');
        var fieldName = parts[0];
        var record_id = parts[1];
        if (fieldName == id) {
          result[record_id] = elem;
        }
      }
    });

    return result;
  },

  /**
   * Получить или установить значение поля по названию поля
   *
   * @param {string} id Код поля
   *
   * @param {string} [value] Значение поля. Если параметр
   * не передан, то метод вернет текущее значение поля.
   *
   * @param {Object} [event] Событие. Его необходимо передавать только 
   * для поля matrix. Если метод вызывается для matrix, то
   * можно аргумент event передавать вторым по счету, вместо value.
   *
   * @return {string|this} Значение поля, если метод используется
   * для получения значения поля. this, если присваивается знаечние.
   *
   * @example <caption>Для обычного поля</caption>
   * // Поле Name = Иванов Иван
   * this.fieldValue('Name', 'Иванов Иван');
   * // Вывод: Иванов Иван
   * console.log(this.fieldValue('Name'));
   *
   * @example <caption>Для matrix</caption>
   * events: {
   *   'field:edit #Date__d_Contact_Date_Matrix': 'myEvent'
   * },
   * myEvent: function(event) {
   *   console.log(this.fieldValue('Date', event));
   * }
   */
  fieldValue: function(id, value, event) {
    if (event == undefined && value != undefined && value.target != undefined) {
      return this.fieldValue(id, undefined, value);
    }

    if (event == undefined) {
      var field = this.getField(id);
      if (!field) {
        return undefined;
      }

      var type = field.attr('elem_type');
      // Wysiwyg редактор
      if (field.attr('is_wysiwyg') == 'yes') {
        if (value != undefined) {
          CKEDITOR.instances[field.attr('actualelement')].setData(value);
          this.triggerAutoEditEvents(field);
          return this;
        }
        else {
          if (CKEDITOR.instances[field.attr('actualelement')].checkDirty() == true) {
            // значение из ckeditor
            return CKEDITOR.instances[field.attr('actualelement')].getData();
          }
          else {
            // Если значение не менялось, то возьмем его из textarea    
            return field.val();
          }
        }
      }
      // Поле с номером телефона
      if (type == 'phone') {
        if (value != undefined) {
          return this.setPhoneFieldValue(field, value);
        }
        else {
          return field.attr('phone_value');
        }
      }
      // Для чекбокса возвращаем значение домена
      else if (type == 'checkbox') {
        if (value !== undefined) {
          if (value == true || value == '1' || value == 1) {
            // field.attr('checked', value);
            // attr checked work incorrect (1 -> 0 -> 1 not working)
            field.prop('checked', true);
          }
          else {
            // field.removeAttr('checked');
            field.prop('checked', false);
          }
          this.triggerAutoEditEvents(field);
          return this;
        }
        else {
          var domain_json = JSON.parse(field.attr('domain_json'));
          var on_index = parseInt(field.attr('checked_index'), 10);
          var value_index = 0;
          if ((!field.prop('checked') && on_index == 0) || (field.prop('checked') && on_index == 1)) {
            value_index = 1;
          }
          return domain_json.domain_values[value_index];
        }
      }
      // Для lookup поля значение в атрибуте lookup_value
      else if (type == 'lookup') {
        if (value !== undefined) {
          if (value && value.Value !== undefined) {
            field.val(value.Caption);
            field.attr('original_value', value.Caption);
            field.attr('lookup_value', value.Value);
          }
          else {
            field.attr('lookup_value', value);
            if (value == null) {
              field.val(null);
              field.attr('original_value', null);
            }
          }
          this.triggerAutoEditEvents(field);
          return this;
        }
        else {
          return field.attr('lookup_value');
        }
      }
      // Для остальных полей
      else {
        if (value != undefined) {
          field.val(value);
          if (field.attr('is_radio') == 'yes') {
            // TODO: переписать на jQuery (встроить в этот объект)
            refreshRadioButtonValue(field);
          }
          this.triggerAutoEditEvents(field);
          return this;
        }
        else {
          return field.val();
        }
      }
    }

    // Для полей matrix
    var field_id = event.target.id;
    var parts = field_id.substring(1).split('__');
    var rec_id = parts[1];
    var detailCode = parts[2];
    //return this.$el.find('#_' + id + '__' + rec_id + '__' + detailCode);
    return this.fieldValue('_' + id + '__' + rec_id + '__' + detailCode, value);
  },

  /**
   * Получить или установить отображаемое значение поля. Имеет смысл для
   * lookup-полей.
   *
   * @param {string} id Код поля
   *
   * @param {string} [displayValue] Отображаемое значение поля. Если параметр
   * не передан, то метод вернет текущее значение поля.
   *
   * @param {Object} [event] Событие. Его необходимо передавать только 
   * для поля matrix. Если метод вызывается для matrix, то
   * можно аргумент event передавать вторым по счету, вместо value.
   *
   * @return {string|this} Отображаемое значение поля, если метод используется
   * для получения значения поля. this, если присваивается знаечние.
   *
   * @example <caption>Для обычного поля</caption>
   * // Поле Name = Иванов Иван
   * this.fieldDisplayValue('OwnerID', 'Иванов Иван');
   * // Вывод: Иванов Иван
   * console.log(this.fieldDisplayValue('OwnerID'));
   *
   * @example <caption>Для matrix</caption>
   * events: {
   *   'field:edit #Date__d_Contact_Date_Matrix': 'myEvent'
   * },
   * myEvent: function(event) {
   *   console.log(this.fieldDisplayValue('ProductID', event));
   * }
   */
  fieldDisplayValue: function(id, displayValue, event) {
    if (event == undefined && displayValue != undefined && 
        displayValue.target != undefined) {
      return this.fieldDisplayValue(id, undefined, displayValue);
    }

    var field = this.getField(id, event);
    var type = field.attr('elem_type');
    if (type == 'lookup') {
      if (displayValue == undefined) {
        return field.val();
      }
      else {
        field.val(displayValue);
        field.attr('original_value', displayValue);
        return this;
      }
    }
    if (type == 'select') {
      var field = this.getField(id);
      if (displayValue == undefined) {
        return field.find(':selected').text();
      }
      else {
        field.find(':selected').text(displayValue);
        return this;
      }
    }
    return this.fieldValue(id, displayValue);
  },

  /**
   * Присвоить значение полю с телефонным номером. При присваивании выполняется
   * форматирование номера к формату "xx xxx xxx-xx-xx". Если присваивается
   * значение полю с дополнительным номером, формат номера будет "xxxx".
   *
   * @param {jQuery} field Поле
   *
   * @param {string} value Телефонный номер
   *
   * @return {this}
   *
   * @example
   * // Поле Phone1 = 7 925 555-55-55
   * this.setPhoneFieldValue(this.getField('Phone1'), '+79255555555');
   */
  setPhoneFieldValue: function(field, value) {
    var cleanDigits = value.replace(/\D/g, "");
    field.attr('phone_value', cleanDigits);
    
    if (field.attr('is_addl') == 'Y') {
      field.val(cleanDigits);
      this.triggerAutoEditEvents(field);
      return this; // для добавочного не форматируем
    }

    var formattedNumber = '';
    var nn = 0;
    for (var i = cleanDigits.length - 1; i >= 0; i--) {
      if (i < cleanDigits.length - 1) {
        if ((nn == 2) || (nn == 4)) {
          formattedNumber = '-' + formattedNumber;
        }
        if ((nn == 7) || (nn == 10)) {
          formattedNumber = ' ' + formattedNumber;
        }
      }
      nn++;
      formattedNumber = cleanDigits.charAt(i) + formattedNumber;
    }
    field.val(formattedNumber);
    this.triggerAutoEditEvents(field);
    return this;
  },

  /**
   * Получить или установить значение параметра карточки
   *
   * @param {string} id Код параметра
   *
   * @param {string} [value] Значение параметра. Если
   * не указан, то метод вернет текущее значение параметра.
   *
   * @param {Object} [event] Событие. Его необходимо передавать только 
   * для matrix. Если метод вызывается для параметра matrix,
   * то можно аргумент event передавать вторым по счету, вместо value.
   *
   * @return {string|this} Значение параметра, если метод используется
   * для получения значения. this, если присваивается знаечние.
   *
   * @example
   * // Если карточку открыли не в режиме добавления новой записи
   * if (this.parameter('mode') != 'insert') {
   *   // ..
   * }
   */
  parameter: function(id, value, event) {
    return this.fieldValue('_' + id, value, event);
  },

  /**
   * Получить или установить название поля
   *
   * @param {string} id Код поля
   *
   * @param {string} [value] Значение поля. Если параметр
   * не передан, то метод вернет текущее значение поля.
   *
   * @param {Object} [event] Событие. Его необходимо передавать только 
   * для поля matrix. Если метод вызывается для matrix, то
   * можно аргумент event передавать вторым по счету, вместо value.
   *
   * @return {string|this} Значение поля, если метод используется
   * для получения названия поля. this, если присваивается название.
   */
  fieldLabel: function(id, value, event) {
    if (event == undefined && value != undefined && 
        value.target != undefined) {
      return this.fieldLabel(id, undefined, value);
    }

    var label = this.getFieldLabel(id, event);

    if (value !== undefined) {
      return label.html(value);
    } else {
      return label.html();
    }
  },

  /**
   * Получить элемент надпись (label) поля по названию поля
   *
   * @param {string} id Код поля
   *
   * @param {Object} [event] Событие. Его необходимо передавать только 
   * для поля matrix. Если метод вызывается для matrix, то
   * можно аргумент event передавать вторым по счету, вместо value.
   *
   * @return {this}
   */
  getFieldLabel: function(id, event) {
    if (g_vars.template == 'bootstrap') {
      return this._getFieldLabelBootstrap(id, event);
    }

    return this._getFieldLabelLegacy(id, event);
  },

  _getFieldLabelBootstrap: function(id, event) {
    var field = this.getField(id, event);

    return field.parents('.form-group').children('label');
  },

  _getFieldLabelLegacy: function(id, event) {
    return this.getField(id, event).
      parents('.form_table').prev().find('span');
  },

  /**
   * Получить или установить значение атрибута поля.
   *
   * Некоторые особенности
   * * В случае изменения атрибута required (или mandatory), изменяется
   * и css-класс заголовка поля.
   * * В случае изменения readonly для lookup-поля, меняется доступ к 
   * кнопке "...".
   * * В случае установки readonly для select-поля, поле становится disabled.
   *
   * @param {string} id Код поля
   *
   * @param {string} property Название атрибута
   *
   * @param {string} [value] Значение атрибута поля. Если параметр
   * не передан, то метод вернет текущее значение поля.
   *
   * @param {Object} [event] Событие. Его необходимо передавать только 
   * для поля matrix. Если метод вызывается для получения значения matrix, то
   * можно аргумент event передавать третьим по счету, вместо value.
   *
   * @return {string|this} Значение атрибута, если метод используется
   * для получения значения. this, если присваивается знаечние.
   *
   * @example
   * // Делаем поле CreateID недоступным для изменения
   * this.fieldProperty('CreateID', 'readonly', true);
   */
  fieldProperty: function(id, property, value, event) {
    if (event == undefined && value != undefined && 
        value.target != undefined) {
      return this.fieldProperty(id, property, undefined, value);
    }

    if (property == 'required') {
      return this.fieldProperty(id, 'mandatory', value);
    }

    var field = this.getField(id, event);
    if (value == undefined) {
      return field.attr(property);
    }
    else {
      if (property == 'mandatory') {
        var caption;
        var className = 'card_elem_mandatory';
        if (g_vars.template == 'bootstrap') {
          className = 'required';
          caption = field.parents('.form-group');
        }
        else {
          caption = field.parents('td.form_table').prev().find('span');
        }
        if (value == 'yes' || value == true || value == 'true' || value == 1) {
          value = 'yes';
          caption.addClass(className);
        }
        else {
          value = 'no';
          caption.removeClass(className);
        }
      }
      else if (property == 'readonly') {
        var type = field.attr('elem_type');
        if (type == 'lookup') {
          if (value == true) {
            // allow "..." button clickable
            // this.getField(id + '_btn').attr('disabled', true);
          }
          else {
            this.getField(id + '_btn').removeAttr('disabled');
          }
        }
        else if (type == 'checkbox') {
            if (value == true) {
                this.getField(id).attr('disabled', 'disabled');
            }
            else {
                this.getField(id).removeAttr('disabled');
            }
        } else {
          if (value == true) {
            this.getField(id).attr(property, property);
          }
          else {
            this.getField(id).removeAttr(property);
          }
        }
      }
      if (type == 'select' || type == 'button') {
        field.attr('disabled', value);
      }
      else {
        field.attr(property, value);
      }
      return this;
    }
  },

  /**
   * Удалить атрибут у поля
   *
   * @param {string} id Код поля
   *
   * @param {string} property Название атрибута
   *
   * @param {Object} [event] Событие. Его необходимо передавать только 
   * для поля matrix.
   */
  fieldRemoveProperty: function(id, property, event) {
    this.getField(id, event).removeAttr(property);
  },

  /**
   * Получить или установить значение атрибута вида data-<атрибут>.
   *
   * @param {string} id Код поля
   *
   * @param {string} property Название атрибута
   *
   * @param {string} [value] Значение атрибута поля. Если параметр
   * не передан, то метод вернет текущее значение поля.
   *
   * @param {Object} [event] Событие. Его необходимо передавать только 
   * для поля matrix. Если метод вызывается для получения значения matrix, то
   * можно аргумент event передавать третьим по счету, вместо value.
   *
   * @return {string|this} Значение атрибута, если метод используется
   * для получения значения. this, если присваивается знаечние.
   *
   * @example
   * // Для поля Name значение атрибута data-mydata = myvalue.
   * this.fieldData('Name', 'mydata', 'myvalue');
   */
  fieldData: function(id, property, value, event) {
    return this.fieldProperty(id, 'data-' + property, value, event);
  },

  /**
   * Получить тип поля
   *
   * @param {string} id Код поля
   *
   * @param {Object} [event] Событие. Этот параметр необходимо заполнять
   * только в случае получения поля matrix.
   *
   * @return {string} Тип поля (значение атрибута elem_type).
   */
  fieldType: function(id, event) {
    return this.getField(id, event).attr('elem_type');
  },

  /**
   * Зависимость полей-справочников
   *
   * Работает только для lookup-lookup и select-select.
   * В случае select-select может быть немколько зависимых полей 
   * для одного master.
   *
   * TODO: Реализовать также связи для lookup-select, select-lookup
   *
   * TODO: Реализация с filter_where нецелесообразна
   *
   * @param masterFieldName Код основного поля
   *
   * @param dependentFieldName Код поля, значение в котором надо фильтровать
   *
   * @param [parentFieldName] Название поля в таблице, по которому 
   * надо фильтровать значения.
   *
   * @example
   * onChangeAccountID: function () {
   *   this.updateName(); 
   *   // Поле Контакт зависит от поля Компания
   *   this.bindFields('AccountID', 'ContactID');
   * },
   * onOpen: function () {
   *   this.getField('Number').attr('readonly', 'readonly');
   *   // Поле Контакт зависит от поля Компания
   *   this.bindFields('AccountID', 'ContactID');
   *   this.onChangePaymentTypeID();
   * }
   */
  bindFields: function(masterFieldName, dependentFieldName, parentFieldName) {
    var master_type = this.fieldType(masterFieldName);
    if (master_type == 'lookup') {
      this._bindLookupFields(masterFieldName, dependentFieldName, parentFieldName);
    }
    else {
      this._bindSelectFields(masterFieldName, dependentFieldName);
    }
  },

  // Связать lookup-поля
  _bindLookupFields: function(masterFieldName, dependentFieldName, parentFieldName) {
    if (parentFieldName == undefined) {
      parentFieldName = masterFieldName;
    }
    var masterId = this.fieldValue(masterFieldName);
    if (masterId == '') {
      this.fieldRemoveProperty(dependentFieldName, 'filter_where');
    }
    else {
      this.fieldProperty(dependentFieldName, 'filter_where', 
          "T0." + parentFieldName + " = '" + masterId + "'");
    }
  },

  // Связать select-поля
  _bindSelectFields: function(masterFieldName, dependentFieldName) {
    var dependent = this.getField(dependentFieldName);
    var master = this.getField(masterFieldName);

    // Создаем json из option, если еще не сделали это
    if (!this.fieldData(dependentFieldName, 'options')) {
      var options = [];
      dependent.find('option').each(function() {
        var option = jQuery(this);
        var attributes = [];
        var attrs = option.get(0).attributes;
        _.each(attrs, function (attr) {
          if (attr.nodeName.toLowerCase() != 'selected') {
            attributes.push([attr.nodeName, attr.nodeValue]);
          }
        });
        options.push([option.attr(masterFieldName.toLowerCase()), option.html(), 
            option.val(), attributes]);
      });
      this.fieldData(dependentFieldName, 'options', JSON.stringify(options));
    }

    if (!this.fieldData(masterFieldName, 'dependent')) {
      this.fieldData(masterFieldName, 'dependent', 
          JSON.stringify([dependentFieldName]));
    }
    else {
      var data = JSON.parse(this.fieldData(masterFieldName, 'dependent'));
      if (_.indexOf(data, dependentFieldName) == -1) {
        data.push(dependentFieldName);
        this.fieldData(masterFieldName, 'dependent', JSON.stringify(data));
      }
    }

    var self = this;
    master.on('field:edited', function () {
      self._filterDependentSelect(masterFieldName);
    });
    this.triggerAutoEditEvents(master);
  },

  // Фильтрация зависимого select
  _filterDependentSelect: function(masterId) {
    var master = this.getField(masterId);
    var masterValue = this.fieldValue(masterId);

    var dependents = JSON.parse(this.fieldData(masterId, 'dependent'));
    var self = this;

    // По всем зависимым полям
    _.each(dependents, function(dependentId) {
      var dependent = self.getField(dependentId);
      var dependentValue = self.fieldValue(dependentId);
      var options = JSON.parse(self.fieldData(dependentId, 'options'));
      // Удаляем список option
      dependent.empty();
      // Добавляем option для выбранного master
      _.each(options, function(option) {
        if ((!option[0]) || (option[0] == masterValue.toLowerCase())) {
          var params = '';
          _.each(option[3], function(attr) {
            params += ' ' + attr[0] + '="' + attr[1] + '"';
          });
          var selectOption = dependent.append(jQuery('<option value="' + 
              option[2] + '"' + params + '>' + option[1] + '</option>'));
          _.each(option[3], function(attr) {
            selectOption.attr(attr[0], attr[1]);
          });
        }
      });

      // При открытии карточки - выберем значение, которое уже установлено
      if (!self.fieldData(dependentId, 'inited')) {
        dependent.find('[value=' + dependentValue + ']')
            .attr('selected', 'selected');
        self.fieldData(dependentId, 'inited', true);
      }
      else {
        dependent.find('option:first').attr('selected', 'selected');
      }
    });

    return;
  },

  /**
   * Стандартный обработчик для случая, когда обработкой события изменения поля
   * занимается сервер.
   *
   * Этот обработчик отправляет запрос для вызова серверного
   * onBeforePost<Код поля>(), который должен быть расположен в файле 
   * с префиксом s\_ для раздела или ds\_ для вкладки.
   * Обработчик целесообразно использовать для редактируемой таблицы.
   *
   * @param {Object} event Событие
   * @param {array} [params] Параметры. Возможные ключи:
   * * rewriteValues = true - Требуется перезаписывать ранее установленные значения
   * * letClearValues = true - Если новое значение null, очищать ли старое значение
   * * disableEvents = false - Отменить обработчики при присвоении новых знаений
   * * onApply - Обработчик, который должен вызываться после присвоения
   *
   * @example <caption>Назначение обработчика изменения поля</caption>
   * events: {
   *   'change #Price, #Count, #UnitID, #Discount': 'onChangeEvent',
   *   'lookup:changed #ProductID': 'onChangeEvent'
   * }
   *
   * @example <caption>Пример обработчика на PHP</caption>
   * public function onBeforePostPrice($parameters) {
   *     list ($count, $price, $discount) = 
   *             $this->getActualValue($parameters['old_data'], 
   *             $parameters['new_data'], array('count', 'price', 'discount'));
   *
   *     $parameters['new_data'] = FieldValueFormat('Amount', 
   *             ((100 - $discount) * $count * $price) / 100, null, 
   *             $parameters['new_data']);
   *
   *     return $parameters['new_data'];
   * }
   */
  onChangeEvent: function(event, params) {
    if (params == undefined) {
      params = {};
    }
    var _params = _.clone(params);
    if (_params) {
      if (_params.rewriteValues == undefined) {
        _params.rewriteValues = true;
      }
      if (_params.letClearValues == undefined) {
        _params.letClearValues = true;
      }
    }
    this.serverEvent('onBeforePost', event.target.id, _params);
  },

  /**
   * Вызвать событие на сервере (в файле с s\_ для раздела или ds\_ 
   * для вкладки).
   *
   * Будет выполнена попытка вызова серверного обработчика, 
   * название которого образовано формулой eventName + fieldName
   *
   * @param {string} eventName вызываемое событие
   *
   * @param {string} [fieldName] Изменяемое поле
   */
  serverEvent: function(eventName, fieldName, params) {
    // На данный момент поддерживается только onBeforePost
    var self = this;

    var className = this.baseClassName;
    if (className == undefined) {
      className = this.getField('_code').val();
    }
    if (className.substring(0, 1) == 'c' || className.substring(0, 1) == 'g') {
      className = 's' + className.substring(1);
    }
    else
    if (className.substring(0, 2) == 'dc' || className.substring(0, 1) == 'dg') {
      className = className.substring(0, 1) + 's' + className.substring(2);
    }

    var sectionName = this.sectionName;
    if (sectionName == undefined) {
      sectionName = this.parameter('source_name');
    }
    // Для вкладок отбросим последнюю часть названия (ds_Project_Product -> ds_Project)
    if (className && className.substring(0, 1) == 'd') {
      if (sectionName && sectionName.lastIndexOf('_')) {
        sectionName = sectionName.substring(0, sectionName.lastIndexOf('_'));
      }
    }

    this.lock();
    var result = this.request({
      section: sectionName,
      'class': className, 
      method: eventName + fieldName, 
      parameters: {
        //id: self.getField('_id').val(), //TODO: deprecated
        //value: value, //TODO: deprecated
        old_data: this._getFieldValues(),
        new_data: this._getFieldValues([fieldName])
      }, 
      onSuccess: function(transport) {
        var res = transport.responseText.evalJSON();
        if (res == null) {
          return false;
        }

        self.setFields(res.data, params);
        self.unlock();
      }
    });
    if (!result) {
      this.unlock();
    }
  },

  /**
   * Присвоение значений/свойств полям.
   *
   * @param {array} data Значения полей и атрибутов в формате набора полей
   *
   * @param {array} [params] Параметры. Возможные ключи:
   * * rewriteValues - Требуется перезаписывать ранее установленные значения
   * * letClearValues - Если новое значение null, очищать ли старое значение
   * * disableEvents - Отменить обработчики при присвоении новых знаений
   * * onApply - Обработчик, который должен вызываться после присвоения
   * новых значений
   */
  setFields: function(data, params, event) {
    var self = this;
    var _params = _.clone(params);
    if (_params == undefined) {
      _params = {};
    }
    if (_params.rewriteValues == undefined) {
      _params.rewriteValues = false;
    }
    if (_params.letClearValues == undefined) {
      _params.letClearValues = false;
    }
    if (_params.disableEvents == undefined) {
      _params.disableEvents = false;
    }

    var enableStatus = this.autoEditEventsEnabled;
    if (_params.disableEvents) {
      this.autoEditEventsEnabled = false;
    }

    // Присвоение значений
    if (data && data.FieldValues) {
      _.each(data.FieldValues, function(fieldValue) {
        var currentValue = self.fieldValue(fieldValue.Name, event);
        var currentType = self.fieldType(fieldValue.Name, event);
        if (currentType == 'lookup') {
          if (currentValue == ''
              || (_params.rewriteValues && fieldValue.Value != '')
              || (_params.letClearValues && currentValue == '')
          ) {
            // обработчики onBeforePost могут возвращать значения lookup без Caption
            if (fieldValue.Value !== currentValue) {
              self.fieldValue(fieldValue.Name, fieldValue, event);
            }
          }
        }
        else {
          if ((currentValue == '') || (currentValue == undefined)
              || (_params.rewriteValues && fieldValue.Value != '')
              || (_params.letClearValues && fieldValue.Value == '')
              || (currentType == 'checkbox' && currentValue == 0)
              || (currentType == 'select' && currentValue == 'null')) {
            self.fieldValue(fieldValue.Name, fieldValue.Value, event);
          }
        }
      });
    }

    // Присвоение свойств
    if (data && data.Attributes) {
      _.each(data.Attributes, function(fieldAttribute) {
        self.fieldProperty(fieldAttribute.FieldName, 
            fieldAttribute.AttributeName, fieldAttribute.AttributeValue, event);
      });
    }

    if (_params.onApply) {
      _params.onApply(data);
    }

    if (_params.disableEvents) {
      self.autoEditEventsEnabled = enableStatus;
    }
  },

  // Получить значения полей из карточки
  // @param [fieldNames] Array Список названий полей, которые требуется вернуть.
  // Если не передан, то возвращает все значения.
  _getFieldValues: function(fieldNames) {
    if (fieldNames == undefined) {
      fieldNames = [];
    }
    var fieldValuesArray = GetFieldValues($(this.el.id).down('form'));
    var fieldValues = {
      FieldValues: []
    };
    for (var i = 0; i < fieldValuesArray.length; i++) {
      if (
          fieldNames.length == 0 ||
          fieldNames.indexOf(fieldValuesArray[i][0]) >= 0
      ) {
        fieldValues.FieldValues.push({
          Name: fieldValuesArray[i][0],
          Value: fieldValuesArray[i][1]
        });
      }
    }
    return fieldValues;
  },

  /**
   * Показать/скрыть поле
   *
   * @param {string} id Код поля
   *
   * @param {bool} [show=true] Показать или скрыть поле
   */
  showField: function(id, show, event) {
    var field = this.getField(id, event);
    var method = g_vars.template == 'bootstrap' ?
      '_showFieldBootstrap' : '_showFieldLegacy'

    if (show == undefined) {
      show = true;
    }

    this[method](field, show);
  },

  _showFieldLegacy: function(field, isShow) {
    var td = field.parents('td.form_table');
    var tr = td.parent();
    if (isShow) {
      td.show();
      td.prev().show();
      tr.show();
    }
    else {
      td.hide();
      td.prev().hide();
      if (tr.find('td:visible').length == 0) {
        tr.hide();
      }
    }
  },

  _showFieldBootstrap: function(field, isShow) {
    var method = isShow ? 'show' : 'hide';
    var fieldContainer = field.closest(".form-group");

    // Сам контейнер не скрывается, чтобы оставить видимое место под элементом
    // если скрыть контейнер поля, расположенного слева, то правое поле
    // переместиться на место левого (так сейчас в classic)
    // Поэтому, чтобы поля не прыгали скрываются все элементы внутри контейнера
    fieldContainer.children()[method]();
  },

  /**
   * Скрыть поле
   *
   * @param {string} id Код поля
   */
  hideField: function(id, event) {
    this.showField(id, false, event);
  },

  /**
   * Показать/скрыть закладку на карточке
   */
  showTab: function (p_tabnumber, p_visible) {
    if (typeof(p_visible) == 'undefined') {
      p_visible = true;
    }
    if (p_visible) {
      this.$el.find(card_tab_selector + ':eq(' + p_tabnumber + ')').show();
    }
    else {
      this.$el.find(card_tab_selector + ':eq(' + p_tabnumber + ')').hide();
    }
  },
  /**
   * Скрыть закладку
   */
  hideTab: function (p_tabnumber) {
    this.showTab(p_tabnumber, false);
  },


  /**
   * Вызвать событие изменения поля, если это разрешено
   *
   * @param {jQuery} field Поле, которое изменилось программно
   */
  triggerAutoEditEvents: function(field) {
    if (this.autoEditEventsEnabled) {
      field.trigger('field:edited');
    }
  },

  /**
   * Запретить сохранять карточку (нажимать на ОК)
   *
   * @param {bool} [on] true - заблокировать. false - разблокировать.
   * По умолчанию true.
   */
  lock: function(on) {
    if (on == true || on == undefined) {
      var form = this.$el.find('form');
      var lockLevel = form.data('lock');
      if (isNaN(lockLevel)) {
        lockLevel = 0;
      }
      lockLevel++;
      form.data('lock', lockLevel);
    }
    else {
      unlock();
    }
  },

  /**
   * Разрешить сохранять карточку (нажимать на ОК)
   */
  unlock: function() {
    var form = this.$el.find('form');
    var lockLevel = form.data('lock');
    if (isNaN(lockLevel)) {
      lockLevel = 0;
    }
    lockLevel--;
    form.data('lock', lockLevel);
  },

  /**
   * Добавить кнопку к полю
   *
   * @param {string} data Параметры, возможные ключи
   * * fieldId Идентификатор поля, к которому добавляется кнопка
   * * Другие ключи для пердставления
   */
  addButtonForField: function(data) {
    var field = this.getField(data.fieldId);
    if (g_vars.template == 'bootstrap') {
      data.field = field.parent().html();
      var view = _.template(jQuery('#field-ext-button').html(), {data: data});
      field.parent().html(view);
      field = this.getField(data.fieldId);
      // Если 2 кнопки, то извлечем содержимое второй и вставим перед первой
      if (field.parent().children('span').length > 1) {
        field.next().children().before(
            field.parent().children().last('span').children());
        field.parent().children().last('span').remove();
        field.parent().unwrap();
      }
    }
    else {
      var view = _.template(jQuery('#field-ext-button').html(), {data: data});
      field.parent().after(view);
    }
  },

  /**
   * Убрать из карточки строку matrix
   *
   * При сохранении карточки не будет выполнена операция удаления этой строки
   *
   * @param {string} id Идентификатор удаляемой записи
   *
   * @example <caption>Удаление одной строчки</caption>
   * this.removeMatrixRow(id);
   */
  removeMatrixRow: function(id) {
    this.$el.find('[rec_id="' + id + '"]').remove();
  },

  /**
   * Удалить из карточки строку matrix
   *
   * При сохранении карточки будет выполнена операция удаления этой строки
   *
   * @param {string} id Идентификатор удаляемой записи
   *
   * @example <caption>Удаление одной строчки</caption>
   * this.removeMatrixRow(id);
   */
  deleteMatrixRow: function(id) {
    var item = this.$el.find('[rec_id="' + id + '"]')
        .find('.button_matrix_delete')[0];
    deleteCardRow(item);
  },

  /**
   * Добавить в карточке строку matrix
   *
   * При сохранении карточки не будет выполнена операция удаления этой строки
   *
   * @param {string} params Параметры, возможные ключи
   * * id - Идентификатор добавляемой записи
   * * code - Код вкладки
   * * values - Не обязательный параметр. Значения полей по умолчанию в формате
   *   набора полей
   *
   * @example <caption>Добавление одной строчки</caption>
   * this.appendMatrixRow({
   *   code: 'd_Contact_Date_Matrix',
   *   values: {
   *     FieldValues: [{
   *       Name: 'ContactDateTypeID',
   *       Value: 'e6512060-b644-43b0-a743-65fc479697e2'
   *     }]
   *   }
   * });
   */
  appendMatrixRow: function(params) {
    if (params == undefined || params.code == undefined) {
      return false;
    }
    if (params.id == undefined) {
      params.id = this.guid();
    }

    var detail = this.$el.find('[detail_code="' + params.code + '"]');
    if (detail.length == 0) {
      return false;
    }

    addCardRow(detail.first().find('.button_matrix_append')[0], params.id);

    var event = {
      target: {
        id: '_f__' + params.id + '__' + params.code
      }
    };

    if (params.values != undefined) {
      this.setFields(params.values, {
        rewriteValues: true,
        letClearValues: true,
        disableEvents: true
      }, event);
    }

    if (params.onAppend) {
      params.onAppend(event);
    }
    return true;
  }

});
