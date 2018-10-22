webpackJsonp([18],{

/***/ 216:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(273)
}
var normalizeComponent = __webpack_require__(82)
/* script */
var __vue_script__ = __webpack_require__(275)
/* template */
var __vue_template__ = __webpack_require__(276)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-61c4ccca"
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
Component.options.__file = "resources/assets/js/components/book/addBook.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-61c4ccca", Component.options)
  } else {
    hotAPI.reload("data-v-61c4ccca", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 273:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(274);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(81)("48984856", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-61c4ccca\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./addBook.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-61c4ccca\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./addBook.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 274:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(25)(false);
// imports


// module
exports.push([module.i, "\n.contents[data-v-61c4ccca]{\n    width: 75%;\n    float: left;\n}\n.add[data-v-61c4ccca]{\n    width: 73%;\n    margin: 35px 0 0 35px;\n}\n", ""]);

// exports


/***/ }),

/***/ 275:
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
        op_first_author: '',
        op_all_author: '',
        op_name: '',
        op_form_write: '',
        op_publish: '',
        op_publish_time: '',
        op_number: '',
        op_total_words: '',
        op_self_words: '',
        op_cate_work: '',
        op_integral: '',
        op_cate_research: '',
        op_sub_category: '',
        op_remarks: ''
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

/***/ 276:
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
              { attrs: { label: "第一作者（或主编）" } },
              [
                _c("el-input", {
                  model: {
                    value: _vm.form.op_first_author,
                    callback: function($$v) {
                      _vm.$set(_vm.form, "op_first_author", $$v)
                    },
                    expression: "form.op_first_author"
                  }
                })
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "el-form-item",
              { attrs: { label: "全部作者" } },
              [
                _c("el-input", {
                  model: {
                    value: _vm.form.op_all_author,
                    callback: function($$v) {
                      _vm.$set(_vm.form, "op_all_author", $$v)
                    },
                    expression: "form.op_all_author"
                  }
                })
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "el-form-item",
              { attrs: { label: "著作名称" } },
              [
                _c("el-input", {
                  model: {
                    value: _vm.form.op_name,
                    callback: function($$v) {
                      _vm.$set(_vm.form, "op_name", $$v)
                    },
                    expression: "form.op_name"
                  }
                })
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "el-form-item",
              { attrs: { label: "编著形式" } },
              [
                _c(
                  "el-select",
                  {
                    attrs: { placeholder: "请选择类别" },
                    model: {
                      value: _vm.form.op_form_write,
                      callback: function($$v) {
                        _vm.$set(_vm.form, "op_form_write", $$v)
                      },
                      expression: "form.op_form_write"
                    }
                  },
                  [
                    _c("el-option", { attrs: { label: "主编", value: "1" } }),
                    _vm._v(" "),
                    _c("el-option", { attrs: { label: "副主编", value: "2" } }),
                    _vm._v(" "),
                    _c("el-option", { attrs: { label: "参编", value: "3" } }),
                    _vm._v(" "),
                    _c("el-option", { attrs: { label: "编著", value: "4" } }),
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
              { attrs: { label: "出版社" } },
              [
                _c("el-input", {
                  model: {
                    value: _vm.form.op_publish,
                    callback: function($$v) {
                      _vm.$set(_vm.form, "op_publish", $$v)
                    },
                    expression: "form.op_publish"
                  }
                })
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "el-form-item",
              { attrs: { label: "出版时间" } },
              [
                _c(
                  "el-col",
                  { attrs: { span: 15 } },
                  [
                    _c("el-date-picker", {
                      staticStyle: { width: "100%" },
                      attrs: { type: "date", placeholder: "选择日期" },
                      model: {
                        value: _vm.form.op_publish_time,
                        callback: function($$v) {
                          _vm.$set(_vm.form, "op_publish_time", $$v)
                        },
                        expression: "form.op_publish_time"
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
              { attrs: { label: "书号" } },
              [
                _c("el-input", {
                  model: {
                    value: _vm.form.op_number,
                    callback: function($$v) {
                      _vm.$set(_vm.form, "op_number", $$v)
                    },
                    expression: "form.op_number"
                  }
                })
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "el-form-item",
              { attrs: { label: "总字数（千字）" } },
              [
                _c("el-input", {
                  model: {
                    value: _vm.form.op_total_words,
                    callback: function($$v) {
                      _vm.$set(_vm.form, "op_total_words", $$v)
                    },
                    expression: "form.op_total_words"
                  }
                })
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "el-form-item",
              { attrs: { label: "本人字数（千字）" } },
              [
                _c("el-input", {
                  model: {
                    value: _vm.form.op_self_words,
                    callback: function($$v) {
                      _vm.$set(_vm.form, "op_self_words", $$v)
                    },
                    expression: "form.op_self_words"
                  }
                })
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "el-form-item",
              { attrs: { label: "著作类别" } },
              [
                _c(
                  "el-select",
                  {
                    attrs: { placeholder: "请选择类别" },
                    model: {
                      value: _vm.form.op_cate_work,
                      callback: function($$v) {
                        _vm.$set(_vm.form, "op_cate_work", $$v)
                      },
                      expression: "form.op_cate_work"
                    }
                  },
                  [
                    _c("el-option", { attrs: { label: "专著", value: "1" } }),
                    _vm._v(" "),
                    _c("el-option", { attrs: { label: "教科书", value: "2" } }),
                    _vm._v(" "),
                    _c("el-option", { attrs: { label: "译著", value: "3" } }),
                    _vm._v(" "),
                    _c("el-option", { attrs: { label: "编著", value: "4" } }),
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
              { attrs: { label: "积分" } },
              [
                _c("el-input", {
                  model: {
                    value: _vm.form.op_integral,
                    callback: function($$v) {
                      _vm.$set(_vm.form, "op_integral", $$v)
                    },
                    expression: "form.op_integral"
                  }
                })
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "el-form-item",
              { attrs: { label: "研究类别" } },
              [
                _c(
                  "el-select",
                  {
                    attrs: { placeholder: "请选择类别" },
                    model: {
                      value: _vm.form.op_cate_research,
                      callback: function($$v) {
                        _vm.$set(_vm.form, "op_cate_research", $$v)
                      },
                      expression: "form.op_cate_research"
                    }
                  },
                  [
                    _c("el-option", {
                      attrs: { label: "基础研究", value: "1" }
                    }),
                    _vm._v(" "),
                    _c("el-option", {
                      attrs: { label: "应用研究", value: "2" }
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
              { attrs: { label: "学科门类" } },
              [
                _c(
                  "el-select",
                  {
                    attrs: { placeholder: "请选择学科门类" },
                    model: {
                      value: _vm.form.op_sub_category,
                      callback: function($$v) {
                        _vm.$set(_vm.form, "op_sub_category", $$v)
                      },
                      expression: "form.op_sub_category"
                    }
                  },
                  [
                    _c("el-option", { attrs: { label: "理学", value: "1" } }),
                    _vm._v(" "),
                    _c("el-option", { attrs: { label: "工学", value: "2" } }),
                    _vm._v(" "),
                    _c("el-option", { attrs: { label: "农学", value: "3" } }),
                    _vm._v(" "),
                    _c("el-option", { attrs: { label: "医学", value: "4" } }),
                    _vm._v(" "),
                    _c("el-option", { attrs: { label: "管理学", value: "5" } }),
                    _vm._v(" "),
                    _c("el-option", {
                      attrs: { label: "马克思主义", value: "6" }
                    }),
                    _vm._v(" "),
                    _c("el-option", { attrs: { label: "哲学", value: "7" } }),
                    _vm._v(" "),
                    _c("el-option", { attrs: { label: "逻辑学", value: "8" } }),
                    _vm._v(" "),
                    _c("el-option", { attrs: { label: "宗教学", value: "9" } }),
                    _vm._v(" "),
                    _c("el-option", {
                      attrs: { label: "语言学", value: "10" }
                    }),
                    _vm._v(" "),
                    _c("el-option", {
                      attrs: { label: "中国文学", value: "11" }
                    }),
                    _vm._v(" "),
                    _c("el-option", {
                      attrs: { label: "外国文学", value: "12" }
                    }),
                    _vm._v(" "),
                    _c("el-option", {
                      attrs: { label: "艺术学", value: "13" }
                    }),
                    _vm._v(" "),
                    _c("el-option", {
                      attrs: { label: "历史学", value: "14" }
                    }),
                    _vm._v(" "),
                    _c("el-option", {
                      attrs: { label: "考古学", value: "15" }
                    }),
                    _vm._v(" "),
                    _c("el-option", {
                      attrs: { label: "经济学", value: "16" }
                    }),
                    _vm._v(" "),
                    _c("el-option", {
                      attrs: { label: "政治学", value: "17" }
                    }),
                    _vm._v(" "),
                    _c("el-option", { attrs: { label: "法学", value: "18" } })
                  ],
                  1
                )
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
                    value: _vm.form.op_remarks,
                    callback: function($$v) {
                      _vm.$set(_vm.form, "op_remarks", $$v)
                    },
                    expression: "form.op_remarks"
                  }
                })
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "el-form-item",
              { attrs: { label: "著作封面及版权页图片" } },
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
    require("vue-hot-reload-api")      .rerender("data-v-61c4ccca", module.exports)
  }
}

/***/ })

});