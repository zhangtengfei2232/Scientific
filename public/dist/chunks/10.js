webpackJsonp([10],{

/***/ 207:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(224)
}
var normalizeComponent = __webpack_require__(80)
/* script */
var __vue_script__ = __webpack_require__(226)
/* template */
var __vue_template__ = __webpack_require__(227)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = null
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
Component.options.__file = "resources/assets/js/components/article/selfInfor.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-41511f38", Component.options)
  } else {
    hotAPI.reload("data-v-41511f38", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 224:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(225);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(79)("adf25412", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-41511f38\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./selfInfor.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-41511f38\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./selfInfor.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 225:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(48)(false);
// imports


// module
exports.push([module.i, "\n.information{\n       width: 75%;\n       float: left;\n}\n.add{\n       width: 80%;\n       margin: 35px 0 0 35px;\n}\n", ""]);

// exports


/***/ }),

/***/ 226:
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

/* harmony default export */ __webpack_exports__["default"] = ({
    data: function data() {
        return {
            ArticleSelfData: {},
            form: {
                author: '1',
                art_all_author: '1',
                title: '2',
                publication_name: '3',
                publication_num: '4',
                num_words: '456',
                periodical_cate: '',
                belong_project: 'xgxy',
                art_cate_research: '',
                art_sub_category: '',
                art_integral: '',
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
        getArticleSelfData: function getArticleSelfData() {
            var self = this;
            var art_id = self.$route.params.paper_id;
            axios.get("selectartical", art_id).then(function (response) {
                var data = response.data;
                //console.log(data);
                if (data.code == 0) {
                    self.ArticleSelfData = data.datas;
                    console.log(data.datas);
                } else {
                    self.$notify({
                        type: 'error',
                        message: data.msg,
                        duration: 2000
                    });
                }
            });
        },
        onSubmit: function onSubmit() {
            console.log('submit!');
        }
    },
    mounted: function mounted() {
        this.getArticleSelfData();
    }
});

/***/ }),

/***/ 227:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _c("div", { staticClass: "table" }, [
      _c("div", { staticClass: "information" }, [
        _c(
          "div",
          { staticClass: "add" },
          [
            _c(
              "el-form",
              {
                ref: "form",
                attrs: { model: _vm.form, "label-width": "200px" }
              },
              [
                _c(
                  "el-form-item",
                  { attrs: { label: "第一作者（通讯录作者）" } },
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
                  { attrs: { label: "全部作者" } },
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
                  { attrs: { label: "论文题目" } },
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
                  { attrs: { label: "发表刊物名称" } },
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
                  { attrs: { label: "刊号" } },
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
                  { attrs: { label: "年，卷，期" } },
                  [
                    _c(
                      "el-col",
                      { attrs: { span: 11 } },
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
                  { attrs: { label: "字数" } },
                  [
                    _c("el-input", {
                      model: {
                        value: _vm.form.num_words,
                        callback: function($$v) {
                          _vm.$set(_vm.form, "num_words", $$v)
                        },
                        expression: "form.num_words"
                      }
                    })
                  ],
                  1
                ),
                _vm._v(" "),
                _c(
                  "el-form-item",
                  { attrs: { label: "期刊级别" } },
                  [
                    _c(
                      "el-radio-group",
                      {
                        model: {
                          value: _vm.form.periodical_cate,
                          callback: function($$v) {
                            _vm.$set(_vm.form, "periodical_cate", $$v)
                          },
                          expression: "form.periodical_cate"
                        }
                      },
                      [
                        _c("el-radio", { attrs: { label: 1 } }, [
                          _vm._v("CSCD")
                        ]),
                        _vm._v(" "),
                        _c("el-radio", { attrs: { label: 2 } }, [
                          _vm._v("核心")
                        ]),
                        _vm._v(" "),
                        _c("el-radio", { attrs: { label: 3 } }, [
                          _vm._v("一般CN")
                        ]),
                        _vm._v(" "),
                        _c("el-radio", { attrs: { label: 4 } }, [
                          _vm._v("国外出版外文刊")
                        ]),
                        _vm._v(" "),
                        _c("el-radio", { attrs: { label: 5 } }, [
                          _vm._v("其他")
                        ])
                      ],
                      1
                    )
                  ],
                  1
                ),
                _vm._v(" "),
                _c(
                  "el-form-item",
                  { attrs: { label: "所属项目" } },
                  [
                    _c("el-input", {
                      model: {
                        value: _vm.form.belong_project,
                        callback: function($$v) {
                          _vm.$set(_vm.form, "belong_project", $$v)
                        },
                        expression: "form.belong_project"
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
                          value: _vm.form.art_cate_research,
                          callback: function($$v) {
                            _vm.$set(_vm.form, "art_cate_research", $$v)
                          },
                          expression: "form.art_cate_research"
                        }
                      },
                      [
                        _c("el-option", { attrs: { label: "1", value: "1" } }),
                        _vm._v(" "),
                        _c("el-option", { attrs: { label: "2", value: "2" } })
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
                          value: _vm.form.art_sub_category,
                          callback: function($$v) {
                            _vm.$set(_vm.form, "art_sub_category", $$v)
                          },
                          expression: "form.art_sub_category"
                        }
                      },
                      [
                        _c("el-option", {
                          attrs: { label: "逻辑学", value: "nongxue" }
                        }),
                        _vm._v(" "),
                        _c("el-option", {
                          attrs: { label: "宗教学", value: "nongxue" }
                        }),
                        _vm._v(" "),
                        _c("el-option", {
                          attrs: { label: "语言学", value: "nongxue" }
                        }),
                        _vm._v(" "),
                        _c("el-option", {
                          attrs: { label: "中国文学", value: "nongxue" }
                        }),
                        _vm._v(" "),
                        _c("el-option", {
                          attrs: { label: "外国文学", value: "nongxue" }
                        }),
                        _vm._v(" "),
                        _c("el-option", {
                          attrs: { label: "艺术学", value: "nongxue" }
                        }),
                        _vm._v(" "),
                        _c("el-option", {
                          attrs: { label: "历史学", value: "nongxue" }
                        }),
                        _vm._v(" "),
                        _c("el-option", {
                          attrs: { label: "考古学", value: "nongxue" }
                        }),
                        _vm._v(" "),
                        _c("el-option", {
                          attrs: { label: "经济学", value: "nongxue" }
                        }),
                        _vm._v(" "),
                        _c("el-option", {
                          attrs: { label: "政治学", value: "nongxue" }
                        }),
                        _vm._v(" "),
                        _c("el-option", {
                          attrs: { label: "法学", value: "nongxue" }
                        }),
                        _vm._v(" "),
                        _c("el-option", {
                          attrs: { label: "农学", value: "nongxue" }
                        }),
                        _vm._v(" "),
                        _c("el-option", {
                          attrs: { label: "作物学", value: "zuowuxue" }
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
                  { attrs: { label: "学校认定刊物级别" } },
                  [
                    _c("el-input", {
                      model: {
                        value: _vm.form.name,
                        callback: function($$v) {
                          _vm.$set(_vm.form, "name", $$v)
                        },
                        expression: "form.name"
                      }
                    })
                  ],
                  1
                ),
                _vm._v(" "),
                _c(
                  "el-form-item",
                  { attrs: { label: "论文全文PDF上传" } },
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
                      {
                        attrs: { type: "primary" },
                        on: { click: _vm.onSubmit }
                      },
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
    ])
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-41511f38", module.exports)
  }
}

/***/ })

});