webpackJsonp([23],{

/***/ 236:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(353)
}
var normalizeComponent = __webpack_require__(82)
/* script */
var __vue_script__ = __webpack_require__(355)
/* template */
var __vue_template__ = __webpack_require__(356)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-f5b56c8c"
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
Component.options.__file = "resources/assets/js/components/assumepost/addutygroup.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-f5b56c8c", Component.options)
  } else {
    hotAPI.reload("data-v-f5b56c8c", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 353:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(354);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(81)("236151a1", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-f5b56c8c\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./addutygroup.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-f5b56c8c\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./addutygroup.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 354:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(25)(false);
// imports


// module
exports.push([module.i, "\n.content[data-v-f5b56c8c]{\n    width: 80%;\n    display: -webkit-box;\n    display: -ms-flexbox;\n    display: flex;\n    margin-top: 20px;\n    /*margin-left: 130px;*/\n    /*background-color: plum;*/\n}\n/*组件*/\n.el-form[data-v-f5b56c8c]{\n    width:62%;\n    margin-top: 40px;\n    margin-left: 150px;\n}\n", ""]);

// exports


/***/ }),

/***/ 355:
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
            //                expertname:'',
            //                age:'',
            //                groupname:'',
            //                work:'',
            form: {
                du_academic: '',
                du_education: '',
                du_degree: '',
                du_age: '',
                du_name: '',
                du_duty: '',
                du_year_num: '',
                data1: '',
                date2: '',
                delivery: false,
                type: [],
                desc: ''
                //                    radio: '1'
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

/***/ 356:
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
        { ref: "form", attrs: { model: _vm.form, "label-width": "125px" } },
        [
          _c(
            "el-form-item",
            { attrs: { label: "姓名" } },
            [
              _c("el-input", {
                attrs: { placeholder: "请输入姓名" },
                model: {
                  value: _vm.form.expertname,
                  callback: function($$v) {
                    _vm.$set(_vm.form, "expertname", $$v)
                  },
                  expression: "form.expertname"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { label: "职称" } },
            [
              _c(
                "el-select",
                {
                  attrs: { placeholder: "请选择职称" },
                  model: {
                    value: _vm.form.du_academic,
                    callback: function($$v) {
                      _vm.$set(_vm.form, "du_academic", $$v)
                    },
                    expression: "form.du_academic"
                  }
                },
                [
                  _c("el-option", { attrs: { label: "教授", value: "1" } }),
                  _vm._v(" "),
                  _c("el-option", { attrs: { label: "副教授", value: "2" } }),
                  _vm._v(" "),
                  _c("el-option", { attrs: { label: "讲师", value: "3" } }),
                  _vm._v(" "),
                  _c("el-option", { attrs: { label: "助教", value: "4" } }),
                  _vm._v(" "),
                  _c("el-option", {
                    attrs: { label: "高级实验师", value: "5" }
                  }),
                  _vm._v(" "),
                  _c("el-option", { attrs: { label: "实验师", value: "6" } }),
                  _vm._v(" "),
                  _c("el-option", {
                    attrs: { label: "助理实验师", value: "7" }
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
            { attrs: { label: "学历" } },
            [
              _c(
                "el-select",
                {
                  attrs: { placeholder: "请选择学历" },
                  model: {
                    value: _vm.form.du_education,
                    callback: function($$v) {
                      _vm.$set(_vm.form, "du_education", $$v)
                    },
                    expression: "form.du_education"
                  }
                },
                [
                  _c("el-option", { attrs: { label: "大专", value: "1" } }),
                  _vm._v(" "),
                  _c("el-option", { attrs: { label: "研究生", value: "2" } }),
                  _vm._v(" "),
                  _c("el-option", { attrs: { label: "本科", value: "3" } })
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { label: "学位" } },
            [
              _c(
                "el-select",
                {
                  attrs: { placeholder: "请选择学位" },
                  model: {
                    value: _vm.form.du_degree,
                    callback: function($$v) {
                      _vm.$set(_vm.form, "du_degree", $$v)
                    },
                    expression: "form.du_degree"
                  }
                },
                [
                  _c("el-option", { attrs: { label: "硕士", value: "1" } }),
                  _vm._v(" "),
                  _c("el-option", { attrs: { label: "博士", value: "2" } }),
                  _vm._v(" "),
                  _c("el-option", { attrs: { label: "学士", value: "3" } })
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { label: "年龄" } },
            [
              _c("el-input", {
                attrs: { placeholder: "请输入您的年龄(数字)" },
                model: {
                  value: _vm.form.du_age,
                  callback: function($$v) {
                    _vm.$set(_vm.form, "du_age", $$v)
                  },
                  expression: "form.du_age"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { label: "担任学术团体名称" } },
            [
              _c("el-input", {
                staticStyle: { width: "400px" },
                attrs: { placeholder: "请输入担任学术团体名称" },
                model: {
                  value: _vm.form.du_name,
                  callback: function($$v) {
                    _vm.$set(_vm.form, "du_name", $$v)
                  },
                  expression: "form.du_name"
                }
              }),
              _vm._v(" "),
              _c(
                "el-select",
                {
                  staticStyle: { width: "200px" },
                  attrs: { placeholder: "担任学术团体级别" },
                  model: {
                    value: _vm.form.level,
                    callback: function($$v) {
                      _vm.$set(_vm.form, "level", $$v)
                    },
                    expression: "form.level"
                  }
                },
                [
                  _c("el-option", { attrs: { label: "省级", value: "1" } }),
                  _vm._v(" "),
                  _c("el-option", { attrs: { label: "国家级", value: "2" } }),
                  _vm._v(" "),
                  _c("el-option", { attrs: { label: "国际级", value: "3" } })
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { label: "所任职务" } },
            [
              _c("el-input", {
                attrs: { placeholder: "请输入所任职务" },
                model: {
                  value: _vm.form.du_duty,
                  callback: function($$v) {
                    _vm.$set(_vm.form, "du_duty", $$v)
                  },
                  expression: "form.du_duty"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { label: "担任职务年限" } },
            [
              _c("el-date-picker", {
                attrs: { type: "date", placeholder: "选择日期" },
                model: {
                  value: _vm.form.data1,
                  callback: function($$v) {
                    _vm.$set(_vm.form, "data1", $$v)
                  },
                  expression: "form.data1"
                }
              }),
              _vm._v(" "),
              _c("span", [_vm._v("-")]),
              _vm._v(" "),
              _c("el-date-picker", {
                attrs: { type: "date", placeholder: "选择日期" },
                model: {
                  value: _vm.form.data2,
                  callback: function($$v) {
                    _vm.$set(_vm.form, "data2", $$v)
                  },
                  expression: "form.data2"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { label: "备注" } },
            [
              _c("el-input", {
                attrs: { type: "textarea" },
                model: {
                  value: _vm.form.desc,
                  callback: function($$v) {
                    _vm.$set(_vm.form, "desc", $$v)
                  },
                  expression: "form.desc"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { label: "证书图片" } },
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
    require("vue-hot-reload-api")      .rerender("data-v-f5b56c8c", module.exports)
  }
}

/***/ })

});