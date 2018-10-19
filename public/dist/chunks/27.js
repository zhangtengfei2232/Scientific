webpackJsonp([27],{

/***/ 245:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(287)
}
var normalizeComponent = __webpack_require__(82)
/* script */
var __vue_script__ = __webpack_require__(289)
/* template */
var __vue_template__ = __webpack_require__(290)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-3ae9def6"
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
Component.options.__file = "resources/assets/js/components/award/addAward.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-3ae9def6", Component.options)
  } else {
    hotAPI.reload("data-v-3ae9def6", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 287:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(288);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(81)("79a117d1", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-3ae9def6\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./addAward.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-3ae9def6\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./addAward.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 288:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(25)(false);
// imports


// module
exports.push([module.i, "\n.contents[data-v-3ae9def6]{\n    width: 75%;\n    float: left;\n}\n.add[data-v-3ae9def6]{\n    width: 73%;\n    margin: 35px 0 0 35px;\n}\n", ""]);

// exports


/***/ }),

/***/ 289:
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

/* harmony default export */ __webpack_exports__["default"] = ({
  data: function data() {
    return {
      input: '',
      form: {
        author: '',
        art_all_author: '',
        title: '',
        publication_name: '',
        publication_num: '',
        num_words: '',
        periodical_cate: '',
        belong_project: '',
        art_cate_research: '',
        art_sub_category: '',
        art_integral: '',
        name: '',
        region: '',
        date1: '',
        date2: '',
        delivery: false,
        type: [],
        resource: '',
        desc: ''
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

/***/ 290:
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
              { attrs: { label: "第一获奖人" } },
              [
                _c("el-input", {
                  model: {
                    value: _vm.form.author,
                    callback: function($$v) {
                      _vm.$set(_vm.form, "author", $$v)
                    },
                    expression: "form.author"
                  }
                })
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "el-form-item",
              { attrs: { label: "全部获奖人" } },
              [
                _c("el-input", {
                  model: {
                    value: _vm.form.art_all_author,
                    callback: function($$v) {
                      _vm.$set(_vm.form, "art_all_author", $$v)
                    },
                    expression: "form.art_all_author"
                  }
                })
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "el-form-item",
              { attrs: { label: "获奖成果名称" } },
              [
                _c("el-input", {
                  model: {
                    value: _vm.form.title,
                    callback: function($$v) {
                      _vm.$set(_vm.form, "title", $$v)
                    },
                    expression: "form.title"
                  }
                })
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "el-form-item",
              { attrs: { label: "奖励名称" } },
              [
                _c("el-input", {
                  model: {
                    value: _vm.form.publication_name,
                    callback: function($$v) {
                      _vm.$set(_vm.form, "publication_name", $$v)
                    },
                    expression: "form.publication_name"
                  }
                })
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "el-form-item",
              { attrs: { label: "成果形式" } },
              [
                _c(
                  "el-select",
                  {
                    attrs: { placeholder: "请选择类别" },
                    model: {
                      value: _vm.form.art_cate_research,
                      callback: function($$v) {
                        _vm.$set(_vm.form, "art_cate_research", $$v)
                      },
                      expression: "form.art_cate_research"
                    }
                  },
                  [
                    _c("el-option", { attrs: { label: "论文", value: "1" } }),
                    _vm._v(" "),
                    _c("el-option", {
                      attrs: { label: "研究报告", value: "2" }
                    }),
                    _vm._v(" "),
                    _c("el-option", { attrs: { label: "新技术", value: "3" } }),
                    _vm._v(" "),
                    _c("el-option", { attrs: { label: "新工艺", value: "4" } }),
                    _vm._v(" "),
                    _c("el-option", { attrs: { label: "课件", value: "1" } }),
                    _vm._v(" "),
                    _c("el-option", { attrs: { label: "新产品", value: "2" } }),
                    _vm._v(" "),
                    _c("el-option", { attrs: { label: "专著", value: "3" } }),
                    _vm._v(" "),
                    _c("el-option", { attrs: { label: "编著", value: "4" } }),
                    _vm._v(" "),
                    _c("el-option", {
                      attrs: { label: "计算机软件", value: "3" }
                    }),
                    _vm._v(" "),
                    _c("el-option", { attrs: { label: "教材", value: "4" } }),
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
              { attrs: { label: "等级" } },
              [
                _c(
                  "el-select",
                  {
                    attrs: { placeholder: "请选择类别" },
                    model: {
                      value: _vm.form.art_cate_research,
                      callback: function($$v) {
                        _vm.$set(_vm.form, "art_cate_research", $$v)
                      },
                      expression: "form.art_cate_research"
                    }
                  },
                  [
                    _c("el-option", { attrs: { label: "一等奖", value: "1" } }),
                    _vm._v(" "),
                    _c("el-option", { attrs: { label: "二等奖", value: "2" } }),
                    _vm._v(" "),
                    _c("el-option", { attrs: { label: "三等奖", value: "3" } })
                  ],
                  1
                )
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "el-form-item",
              { attrs: { label: "奖励级别" } },
              [
                _c(
                  "el-select",
                  {
                    attrs: { placeholder: "请选择类别" },
                    model: {
                      value: _vm.form.art_cate_research,
                      callback: function($$v) {
                        _vm.$set(_vm.form, "art_cate_research", $$v)
                      },
                      expression: "form.art_cate_research"
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
              { attrs: { label: "授奖单位" } },
              [
                _c("el-input", {
                  model: {
                    value: _vm.form.publication_num,
                    callback: function($$v) {
                      _vm.$set(_vm.form, "publication_num", $$v)
                    },
                    expression: "form.publication_num"
                  }
                })
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "el-form-item",
              { attrs: { label: "授奖时间" } },
              [
                _c(
                  "el-col",
                  { attrs: { span: 15 } },
                  [
                    _c("el-date-picker", {
                      staticStyle: { width: "100%" },
                      attrs: { type: "date", placeholder: "选择日期" },
                      model: {
                        value: _vm.form.date1,
                        callback: function($$v) {
                          _vm.$set(_vm.form, "date1", $$v)
                        },
                        expression: "form.date1"
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
              { attrs: { label: "证书编号" } },
              [
                _c("el-input", {
                  model: {
                    value: _vm.form.publication_num,
                    callback: function($$v) {
                      _vm.$set(_vm.form, "publication_num", $$v)
                    },
                    expression: "form.publication_num"
                  }
                })
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "el-form-item",
              { attrs: { label: "我校名次" } },
              [
                _c("el-input", {
                  model: {
                    value: _vm.form.publication_num,
                    callback: function($$v) {
                      _vm.$set(_vm.form, "publication_num", $$v)
                    },
                    expression: "form.publication_num"
                  }
                })
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
                    value: _vm.form.art_integral,
                    callback: function($$v) {
                      _vm.$set(_vm.form, "art_integral", $$v)
                    },
                    expression: "form.art_integral"
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
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-3ae9def6", module.exports)
  }
}

/***/ })

});