webpackJsonp([10],{

/***/ 231:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(333)
}
var normalizeComponent = __webpack_require__(82)
/* script */
var __vue_script__ = __webpack_require__(335)
/* template */
var __vue_template__ = __webpack_require__(336)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-7e5ff42b"
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/components/joinmeet/addJoinmeet.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-7e5ff42b", Component.options)
  } else {
    hotAPI.reload("data-v-7e5ff42b", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 333:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(334);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(81)("1194d09b", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-7e5ff42b\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./addJoinmeet.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-7e5ff42b\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./addJoinmeet.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 334:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(25)(false);
// imports


// module
exports.push([module.i, "\n.contents[data-v-7e5ff42b]{\n    width: 75%;\n    float: left;\n}\n.add[data-v-7e5ff42b]{\n    width: 73%;\n    margin: 35px 0 0 35px;\n}\n", ""]);

// exports


/***/ }),

/***/ 335:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
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
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  data: function data() {
    return {
      form: {
        join_people: '',
        jo_name: '',
        jo_hold_unit: '',
        jo_take_unit: '',
        jo_level: '',
        jo_time: '',
        jo_place: '',
        jo_art_num: '',
        jo_is_invite: '',
        jo_title: ''
      }
    };
  },

  methods: {
    onSubmit: function onSubmit() {
      console.log('submit!');
    }
  }
});

/***/ }),

/***/ 336:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "contents" }, [
    _c(
      "div",
      { staticClass: "add" },
      [
        _c(
          "el-form",
          { ref: "form", attrs: { model: _vm.form, "label-width": "200px" } },
          [
            _c(
              "el-form-item",
              { attrs: { label: "参会人" } },
              [
                _c("el-input", {
                  model: {
                    value: _vm.form.join_people,
                    callback: function($$v) {
                      _vm.$set(_vm.form, "join_people", $$v)
                    },
                    expression: "form.join_people"
                  }
                })
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "el-form-item",
              { attrs: { label: "学术会议名称" } },
              [
                _c("el-input", {
                  model: {
                    value: _vm.form.jo_name,
                    callback: function($$v) {
                      _vm.$set(_vm.form, "jo_name", $$v)
                    },
                    expression: "form.jo_name"
                  }
                })
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "el-form-item",
              { attrs: { label: "主办单位" } },
              [
                _c("el-input", {
                  model: {
                    value: _vm.form.jo_hold_unit,
                    callback: function($$v) {
                      _vm.$set(_vm.form, "jo_hold_unit", $$v)
                    },
                    expression: "form.jo_hold_unit"
                  }
                })
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "el-form-item",
              { attrs: { label: "承办单位" } },
              [
                _c("el-input", {
                  model: {
                    value: _vm.form.jo_take_unit,
                    callback: function($$v) {
                      _vm.$set(_vm.form, "jo_take_unit", $$v)
                    },
                    expression: "form.jo_take_unit"
                  }
                })
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "el-form-item",
              { attrs: { label: "会议级别" } },
              [
                _c(
                  "el-select",
                  {
                    attrs: { placeholder: "请选择类别" },
                    model: {
                      value: _vm.form.jo_level,
                      callback: function($$v) {
                        _vm.$set(_vm.form, "jo_level", $$v)
                      },
                      expression: "form.jo_level"
                    }
                  },
                  [
                    _c("el-option", { attrs: { label: "省级", value: "1" } }),
                    _vm._v(" "),
                    _c("el-option", { attrs: { label: "大区级", value: "2" } }),
                    _vm._v(" "),
                    _c("el-option", { attrs: { label: "国家级", value: "3" } }),
                    _vm._v(" "),
                    _c("el-option", {
                      attrs: { label: "国际会议", value: "4" }
                    })
                  ],
                  1
                )
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "el-form-item",
              { attrs: { label: "会议时间" } },
              [
                _c(
                  "el-col",
                  { attrs: { span: 15 } },
                  [
                    _c("el-date-picker", {
                      staticStyle: { width: "100%" },
                      attrs: { type: "date", placeholder: "选择日期" },
                      model: {
                        value: _vm.form.jo_time,
                        callback: function($$v) {
                          _vm.$set(_vm.form, "jo_time", $$v)
                        },
                        expression: "form.jo_time"
                      }
                    })
                  ],
                  1
                )
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "el-form-item",
              { attrs: { label: "会议地点" } },
              [
                _c("el-input", {
                  model: {
                    value: _vm.form.jo_place,
                    callback: function($$v) {
                      _vm.$set(_vm.form, "jo_place", $$v)
                    },
                    expression: "form.jo_place"
                  }
                })
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "el-form-item",
              { attrs: { label: "提交论文数" } },
              [
                _c("el-input", {
                  model: {
                    value: _vm.form.jo_art_num,
                    callback: function($$v) {
                      _vm.$set(_vm.form, "jo_art_num", $$v)
                    },
                    expression: "form.jo_art_num"
                  }
                })
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "el-form-item",
              { attrs: { label: "是否被邀大会或分会场报告" } },
              [
                _c(
                  "el-radio-group",
                  {
                    model: {
                      value: _vm.form.jo_is_invite,
                      callback: function($$v) {
                        _vm.$set(_vm.form, "jo_is_invite", $$v)
                      },
                      expression: "form.jo_is_invite"
                    }
                  },
                  [
                    _c(
                      "el-radio",
                      { staticStyle: { margin: "10px" }, attrs: { label: 1 } },
                      [_vm._v("是")]
                    ),
                    _vm._v(" "),
                    _c(
                      "el-radio",
                      { staticStyle: { margin: "10px" }, attrs: { label: 2 } },
                      [_vm._v("否")]
                    )
                  ],
                  1
                )
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "el-form-item",
              { attrs: { label: "报告题目" } },
              [
                _c("el-input", {
                  model: {
                    value: _vm.form.jo_title,
                    callback: function($$v) {
                      _vm.$set(_vm.form, "jo_title", $$v)
                    },
                    expression: "form.jo_title"
                  }
                })
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "el-form-item",
              { attrs: { label: "会议图注" } },
              [
                _c(
                  "el-upload",
                  {
                    staticClass: "upload-demo",
                    attrs: { drag: "", action: "#", multiple: "" }
                  },
                  [
                    _c("i", { staticClass: "el-icon-upload" }),
                    _vm._v(" "),
                    _c("div", { staticClass: "el-upload__text" }, [
                      _vm._v("将文件拖到此处，或"),
                      _c("em", [_vm._v("点击上传")])
                    ])
                  ]
                )
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "el-form-item",
              { attrs: { label: "餐会图注" } },
              [
                _c(
                  "el-upload",
                  {
                    staticClass: "upload-demo",
                    attrs: { drag: "", action: "#", multiple: "" }
                  },
                  [
                    _c("i", { staticClass: "el-icon-upload" }),
                    _vm._v(" "),
                    _c("div", { staticClass: "el-upload__text" }, [
                      _vm._v("将文件拖到此处，或"),
                      _c("em", [_vm._v("点击上传")])
                    ])
                  ]
                )
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "el-form-item",
              [
                _c(
                  "el-button",
                  { attrs: { type: "primary" }, on: { click: _vm.onSubmit } },
                  [_vm._v("立即创建")]
                ),
                _vm._v(" "),
                _c("el-button", [_vm._v("取消")])
              ],
              1
            )
          ],
          1
        )
      ],
      1
    )
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-7e5ff42b", module.exports)
  }
}

/***/ })

});