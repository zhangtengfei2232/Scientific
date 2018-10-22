webpackJsonp([15],{

/***/ 234:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(345)
}
var normalizeComponent = __webpack_require__(82)
/* script */
var __vue_script__ = __webpack_require__(347)
/* template */
var __vue_template__ = __webpack_require__(348)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-76e540af"
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
Component.options.__file = "resources/assets/js/components/expertspeak/addspeak.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-76e540af", Component.options)
  } else {
    hotAPI.reload("data-v-76e540af", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 345:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(346);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(81)("61842a26", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-76e540af\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./addspeak.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-76e540af\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./addspeak.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 346:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(25)(false);
// imports


// module
exports.push([module.i, "\n.content[data-v-76e540af]{\n    width: 80%;\n    display: -webkit-box;\n    display: -ms-flexbox;\n    display: flex;\n    margin-top: 20px;\n    /*margin-left: 130px;*/\n    /*background-color: plum;*/\n}\n/*组件*/\n.el-form[data-v-76e540af]{\n    width:62%;\n    margin-top: 40px;\n    margin-left: 150px;\n}\n", ""]);

// exports


/***/ }),

/***/ 347:
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

/* harmony default export */ __webpack_exports__["default"] = ({
    data: function data() {
        return {
            //                input : '',
            form: {
                le_expert_name: '',
                le_expert_level: '',
                le_report_name: '',
                le_invite_status: '',
                le_invite_unit: '',
                le_time: '',
                delivery: false,
                type: []
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

/***/ 348:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    { staticClass: "content" },
    [
      _c(
        "el-form",
        { ref: "form", attrs: { model: _vm.form, "label-width": "90px" } },
        [
          _c(
            "el-form-item",
            { attrs: { label: "专家姓名" } },
            [
              _c("el-input", {
                attrs: { placeholder: "请输入专家姓名" },
                model: {
                  value: _vm.form.le_expert_name,
                  callback: function($$v) {
                    _vm.$set(_vm.form, "le_expert_name", $$v)
                  },
                  expression: "form.le_expert_name"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { label: "专家级别" } },
            [
              _c(
                "el-select",
                {
                  attrs: { placeholder: "请选择专家级别" },
                  model: {
                    value: _vm.form.le_expert_level,
                    callback: function($$v) {
                      _vm.$set(_vm.form, "le_expert_level", $$v)
                    },
                    expression: "form.le_expert_level"
                  }
                },
                [
                  _c("el-option", { attrs: { label: "院士", value: "1" } }),
                  _vm._v(" "),
                  _c("el-option", { attrs: { label: "博导", value: "2" } }),
                  _vm._v(" "),
                  _c("el-option", {
                    attrs: { label: "国务院学位委员会委员", value: "3" }
                  }),
                  _vm._v(" "),
                  _c("el-option", { attrs: { label: "教授", value: "4" } }),
                  _vm._v(" "),
                  _c("el-option", { attrs: { label: "其他", value: "5" } })
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { label: "报告名称" } },
            [
              _c("el-input", {
                attrs: { placeholder: "请输入报告名称" },
                model: {
                  value: _vm.form.le_report_name,
                  callback: function($$v) {
                    _vm.$set(_vm.form, "le_report_name", $$v)
                  },
                  expression: "form.le_report_name"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { label: "邀请/未邀请" } },
            [
              _c(
                "el-radio-group",
                {
                  model: {
                    value: _vm.form.le_invite_status,
                    callback: function($$v) {
                      _vm.$set(_vm.form, "le_invite_status", $$v)
                    },
                    expression: "form.le_invite_status"
                  }
                },
                [
                  _c("el-radio", { attrs: { label: "邀请" } }),
                  _vm._v(" "),
                  _c("el-radio", { attrs: { label: "未邀请" } })
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { label: "邀请单位" } },
            [
              _c("el-input", {
                attrs: { placeholder: "请输入邀请单位" },
                model: {
                  value: _vm.form.le_invite_unit,
                  callback: function($$v) {
                    _vm.$set(_vm.form, "le_invite_unit", $$v)
                  },
                  expression: "form.le_invite_unit"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { label: "讲学时间" } },
            [
              _c(
                "el-col",
                { attrs: { span: 15 } },
                [
                  _c("el-date-picker", {
                    attrs: { type: "date", placeholder: "选择日期" },
                    model: {
                      value: _vm.form.le_time,
                      callback: function($$v) {
                        _vm.$set(_vm.form, "le_time", $$v)
                      },
                      expression: "form.le_time"
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
            { attrs: { label: "图注" } },
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
            { attrs: { label: "图片" } },
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
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-76e540af", module.exports)
  }
}

/***/ })

});