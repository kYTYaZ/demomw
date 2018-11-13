/*!
 * vue-number-input v0.5.2
 * https://fengyuanchen.github.io/vue-number-input
 *
 * Copyright 2018-present Chen Fengyuan
 * Released under the MIT license
 *
 * Date: 2018-08-05T04:49:16.090Z
 */

'use strict';

var _extends = Object.assign || function (target) {
  for (var i = 1; i < arguments.length; i++) {
    var source = arguments[i];

    for (var key in source) {
      if (Object.prototype.hasOwnProperty.call(source, key)) {
        target[key] = source[key];
      }
    }
  }

  return target;
};

//
//
//
//
//
//
//
//
//
//
//
//
//

var isNaN = Number.isNaN || window.isNaN;
var REGEXP_NUMBER = /^-?(?:\d+|\d+\.\d+|\.\d+)(?:[eE][-+]?\d+)?$/;
var normalizeDecimalNumber = function normalizeDecimalNumber(value) {
  return parseFloat(value.toFixed(10));
};

var script = {
  name: 'number-input',

  data: function data() {
    return {
      currentValue: NaN
    };
  },


  model: {
    event: 'change'
  },

  props: {
    center: Boolean,
    controls: Boolean,
    disabled: Boolean,

    inputtable: {
      type: Boolean,
      default: true
    },

    inline: Boolean,

    max: {
      type: Number,
      default: Infinity
    },

    min: {
      type: Number,
      default: -Infinity
    },

    name: String,
    placeholder: String,
    readonly: Boolean,
    rounded: Boolean,
    size: String,

    step: {
      type: Number,
      default: 1
    },

    value: Number
  },

  computed: {
    /**
     * Indicate if the value is increasable.
     * @returns {boolean} Return `true` if it is decreasable, else `false`.
     */
    increasable: function increasable() {
      var num = this.currentValue;

      return isNaN(num) || num < this.max;
    },


    /**
     * Indicate if the value is decreasable.
     * @returns {boolean} Return `true` if it is decreasable, else `false`.
     */
    decreasable: function decreasable() {
      var num = this.currentValue;

      return isNaN(num) || num > this.min;
    },


    /**
     * Filter listeners
     * @returns {Object} Return filtered listeners.
     */
    listeners: function listeners() {
      var listeners = _extends({}, this.$listeners);

      delete listeners.change;

      return listeners;
    }
  },

  methods: {
    /**
     * Change event handler.
     * @param {string} value - The new value.
     */
    change: function change(event) {
      this.setValue(Math.min(this.max, Math.max(this.min, event.target.value)));
    },


    /**
     * Paste event handler.
     * @param {Event} event - Event object.
     */
    paste: function paste(event) {
      if (!REGEXP_NUMBER.test(event.clipboardData.getData('text'))) {
        event.preventDefault();
      }
    },


    /**
     * Decrease the value.
     */
    decrease: function decrease() {
      if (this.decreasable) {
        var currentValue = this.currentValue;


        if (isNaN(currentValue)) {
          currentValue = 0;
        }

        this.setValue(Math.min(this.max, Math.max(this.min, normalizeDecimalNumber(currentValue - this.step))));
      }
    },


    /**
     * Increase the value.
     */
    increase: function increase() {
      if (this.increasable) {
        var currentValue = this.currentValue;


        if (isNaN(currentValue)) {
          currentValue = 0;
        }

        this.setValue(Math.min(this.max, Math.max(this.min, normalizeDecimalNumber(currentValue + this.step))));
      }
    },


    /**
     * Set new value and dispatch change event.
     * @param {number} value - The new value to set.
     */
    setValue: function setValue(value) {
      var _this = this;

      var oldValue = this.currentValue;
      var newValue = this.rounded ? Math.round(value) : value;

      if (this.min <= this.max) {
        newValue = Math.min(this.max, Math.max(this.min, newValue));
      }

      this.currentValue = newValue;
      this.$emit('change', newValue, oldValue);
      this.$nextTick(function () {
        // Change the input value when it is mounted
        if (_this.$el) {
          _this.$refs.input.value = newValue;
        }
      });
    }
  },

  watch: {
    value: function value(newValue) {
      this.setValue(newValue);
    }
  },

  created: function created() {
    this.setValue(this.value);
  }
};

/* script */
var __vue_script__ = script;

/* template */
var __vue_render__ = function __vue_render__() {
  var _vm = this;var _h = _vm.$createElement;var _c = _vm._self._c || _h;return _c('div', _vm._g({ staticClass: "number-input", class: (_obj = {
      'number-input--inline': _vm.inline,
      'number-input--center': _vm.center,
      'number-input--controls': _vm.controls
    }, _obj["number-input--" + _vm.size] = _vm.size, _obj) }, _vm.listeners), [_vm.controls ? _c('button', { staticClass: "number-input__button number-input__button--minus", attrs: { "type": "button", "disabled": _vm.disabled || _vm.readonly || !_vm.decreasable }, on: { "click": _vm.decrease } }) : _vm._e(), _vm._v(" "), _c('input', { ref: "input", staticClass: "number-input__input", attrs: { "type": "number", "name": _vm.name, "min": _vm.min, "max": _vm.max, "step": _vm.step, "readonly": _vm.readonly || !_vm.inputtable, "disabled": _vm.disabled || !_vm.decreasable && !_vm.increasable, "placeholder": _vm.placeholder, "autocomplete": "off" }, domProps: { "value": _vm.currentValue }, on: { "change": _vm.change, "paste": _vm.paste } }), _vm._v(" "), _vm.controls ? _c('button', { staticClass: "number-input__button number-input__button--plus", attrs: { "type": "button", "disabled": _vm.disabled || _vm.readonly || !_vm.increasable }, on: { "click": _vm.increase } }) : _vm._e()]);
  var _obj;
};
var __vue_staticRenderFns__ = [];

/* style */
var __vue_inject_styles__ = function __vue_inject_styles__(inject) {
  if (!inject) return;
  inject("data-v-607416cd_0", { source: "\n.number-input[data-v-607416cd]{display:block;max-width:100%;overflow:hidden;position:relative\n}\n.number-input__button[data-v-607416cd]{background-color:transparent;border:0;border-radius:.25rem;bottom:.0625rem;position:absolute;top:.0625rem;width:2.5rem\n}\n.number-input__button[data-v-607416cd]:focus{outline:0\n}\n.number-input__button[data-v-607416cd]:hover::after,.number-input__button[data-v-607416cd]:hover::before{background-color:#0074d9\n}\n.number-input__button[data-v-607416cd]:disabled::after,.number-input__button[data-v-607416cd]:disabled::before{background-color:#ddd\n}\n.number-input__button[data-v-607416cd]::after,.number-input__button[data-v-607416cd]::before{background-color:#111;content:\"\";left:50%;position:absolute;top:50%;transform:translate(-50%,-50%);transition:background-color .15s\n}\n.number-input__button[data-v-607416cd]::before{height:.0625rem;width:50%\n}\n.number-input__button[data-v-607416cd]::after{height:50%;width:.0625rem\n}\n.number-input__button--minus[data-v-607416cd]{border-right:.0625rem solid #ddd;border-bottom-right-radius:0;border-top-right-radius:0;left:.0625rem\n}\n.number-input__button--minus[data-v-607416cd]::after{visibility:hidden\n}\n.number-input__button--plus[data-v-607416cd]{border-left:.0625rem solid #ddd;border-bottom-left-radius:0;border-top-left-radius:0;right:.0625rem\n}\n.number-input__input[data-v-607416cd]{border-radius:.25rem;border:1px solid #ddd;display:block;font-size:1rem;line-height:1.5;max-width:100%;min-height:1.5rem;min-width:3rem;padding:.4375rem .875rem;transition:border-color .15s;width:100%\n}\n.number-input__input[data-v-607416cd]::-webkit-inner-spin-button,.number-input__input[data-v-607416cd]::-webkit-outer-spin-button{appearance:none\n}\n.number-input__input[data-v-607416cd]:focus{border-color:#0074d9;outline:0\n}\n.number-input__input[readonly][data-v-607416cd]{background-color:#f8f8f8\n}\n.number-input__input[data-v-607416cd]:disabled{background-color:#f8f8f8;opacity:.65\n}\n.number-input--inline[data-v-607416cd]{display:inline-block\n}\n.number-input--inline>input[data-v-607416cd]{display:inline-block;width:12.5rem\n}\n.number-input--center>input[data-v-607416cd]{text-align:center\n}\n.number-input--controls>input[data-v-607416cd]{padding-left:3.375rem;padding-right:3.375rem\n}\n.number-input--small>input[data-v-607416cd]{border-radius:.1875rem;font-size:.875rem;padding:.25rem .5rem\n}\n.number-input--small.number-input--inline>input[data-v-607416cd]{width:10rem\n}\n.number-input--small.number-input--controls>button[data-v-607416cd]{width:2rem\n}\n.number-input--small.number-input--controls>input[data-v-607416cd]{padding-left:2.5rem;padding-right:2.5rem\n}\n.number-input--large>input[data-v-607416cd]{border-radius:.3125rem;font-size:1.25rem;padding:.5rem 1rem\n}\n.number-input--large.number-input--inline>input[data-v-607416cd]{width:15rem\n}\n.number-input--large.number-input--controls>button[data-v-607416cd]{width:3rem\n}\n.number-input--large.number-input--controls>input[data-v-607416cd]{padding-left:4rem;padding-right:4rem\n}", map: undefined, media: undefined });
};
/* scoped */
var __vue_scope_id__ = "data-v-607416cd";
/* module identifier */
var __vue_module_identifier__ = undefined;
/* functional template */
var __vue_is_functional_template__ = false;
/* component normalizer */
function __vue_normalize__(template, style, script$$1, scope, functional, moduleIdentifier, createInjector, createInjectorSSR) {
  var component = (typeof script$$1 === 'function' ? script$$1.options : script$$1) || {};

  // For security concerns, we use only base name in production mode.
  component.__file = "index.vue";

  if (!component.render) {
    component.render = template.render;
    component.staticRenderFns = template.staticRenderFns;
    component._compiled = true;

    if (functional) component.functional = true;
  }

  component._scopeId = scope;

  {
    var hook = void 0;
    if (style) {
      hook = function hook(context) {
        style.call(this, createInjector(context));
      };
    }

    if (hook !== undefined) {
      if (component.functional) {
        // register for functional component in vue file
        var originalRender = component.render;
        component.render = function renderWithStyleInjection(h, context) {
          hook.call(context);
          return originalRender(h, context);
        };
      } else {
        // inject component registration as beforeCreate hook
        var existing = component.beforeCreate;
        component.beforeCreate = existing ? [].concat(existing, hook) : [hook];
      }
    }
  }

  return component;
}
/* style inject */
function __vue_create_injector__() {
  var head = document.head || document.getElementsByTagName('head')[0];
  var styles = __vue_create_injector__.styles || (__vue_create_injector__.styles = {});
  var isOldIE = typeof navigator !== 'undefined' && /msie [6-9]\\b/.test(navigator.userAgent.toLowerCase());

  return function addStyle(id, css) {
    if (document.querySelector('style[data-vue-ssr-id~="' + id + '"]')) return; // SSR styles are present.

    var group = isOldIE ? css.media || 'default' : id;
    var style = styles[group] || (styles[group] = { ids: [], parts: [], element: undefined });

    if (!style.ids.includes(id)) {
      var code = css.source;
      var index = style.ids.length;

      style.ids.push(id);

      if (css.map) {
        // https://developer.chrome.com/devtools/docs/javascript-debugging
        // this makes source maps inside style tags work properly in Chrome
        code += '\n/*# sourceURL=' + css.map.sources[0] + ' */';
        // http://stackoverflow.com/a/26603875
        code += '\n/*# sourceMappingURL=data:application/json;base64,' + btoa(unescape(encodeURIComponent(JSON.stringify(css.map)))) + ' */';
      }

      if (isOldIE) {
        style.element = style.element || document.querySelector('style[data-group=' + group + ']');
      }

      if (!style.element) {
        var el = style.element = document.createElement('style');
        el.type = 'text/css';

        if (css.media) el.setAttribute('media', css.media);
        if (isOldIE) {
          el.setAttribute('data-group', group);
          el.setAttribute('data-next-index', '0');
        }

        head.appendChild(el);
      }

      if (isOldIE) {
        index = parseInt(style.element.getAttribute('data-next-index'));
        style.element.setAttribute('data-next-index', index + 1);
      }

      if (style.element.styleSheet) {
        style.parts.push(code);
        style.element.styleSheet.cssText = style.parts.filter(Boolean).join('\n');
      } else {
        var textNode = document.createTextNode(code);
        var nodes = style.element.childNodes;
        if (nodes[index]) style.element.removeChild(nodes[index]);
        if (nodes.length) style.element.insertBefore(textNode, nodes[index]);else style.element.appendChild(textNode);
      }
    }
  };
}
/* style inject SSR */

var index = __vue_normalize__({ render: __vue_render__, staticRenderFns: __vue_staticRenderFns__ }, __vue_inject_styles__, __vue_script__, __vue_scope_id__, __vue_is_functional_template__, __vue_module_identifier__, __vue_create_injector__, undefined);

module.exports = index;
