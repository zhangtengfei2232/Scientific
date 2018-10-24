webpackJsonp([4],{

/***/ 213:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(258)
}
var normalizeComponent = __webpack_require__(82)
/* script */
var __vue_script__ = __webpack_require__(260)
/* template */
var __vue_template__ = __webpack_require__(261)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-50401b45"
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
Component.options.__file = "resources/assets/js/components/project/addProject.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-50401b45", Component.options)
  } else {
    hotAPI.reload("data-v-50401b45", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 258:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(259);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(81)("ea4b57ba", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-50401b45\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./addProject.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-50401b45\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./addProject.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 259:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(25)(false);
// imports


// module
exports.push([module.i, "\n.contents[data-v-50401b45]{\n    width: 75%;\n    float: left;\n}\n.add[data-v-50401b45]{\n    width: 73%;\n    margin: 35px 0 0 35px;\n}\n", ""]);

// exports


/***/ }),

/***/ 260:
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

/* harmony default export */ __webpack_exports__["default"] = ({
    data: function data() {
        return {
            input: '',
            form: {
                pro_host: '',
                pro_all_author: '',
                entry_name: '',
                project_category: '',
                approval_unit: '',
                approval_funds: '',
                account_outlay: '',
                pro_cate_research: '',
                pro_sub_category: '',
                form_cooperate: '',
                social_eco_goal: '',
                na_eco_industry: '',
                pro_integral: '',
                pro_remarks: '',
                project_year: ''
            }
        };
    },

    methods: {
        onSubmit: function onSubmit(form) {
            if (form.pro_host == '') {
                this.$message.error('主持人不能为空');
            } else if (form.pro_all_author == '') {
                this.$message.error('所有参加人不能为空');
            } else if (form.title == '') {
                this.$message.error('项目名称不能为空');
            } else if (form.publication_name == '') {
                this.$message.error('项目类别不能为空');
            } else if (form.publication_num == '') {
                this.$message.error('批准单位不能为空');
            } else if (year1 == '') {
                this.$message.error('批准经费不能为空');
            } else if (year2 == '') {
                this.$message.error('当年到账经费不能为空');
            } else if (year3 == '') {
                this.$message.error('研究类别不能为空');
            } else if (year4 == '') {
                this.$message.error('学科门类不能为空');
            } else if (year5 == '') {
                this.$message.error('合作形式不能为空');
            } else if (form.num_words == '') {
                this.$message.error('社会经济目标不能为空');
            } else if (form.periodical_cate == '') {
                this.$message.error('服务的国民经济行业不能为空');
            } else if (form.belong_project == '') {
                this.$message.error('积分不能为空');
            } else if (form.art_cate_research == '') {
                this.$message.error('备注不能为空');
            } else if (form.art_sub_category == '') {
                this.$message.error('项目年份不能为空');
            } else {
                this.addProjectData(form);
            }
        },
        addProjectData: function addProjectData(form) {
            var self = this;
            axios.get("", form).then(function (response) {
                var data = response.data;
                if (data.code == 0) {} else {
                    self.$notify({
                        type: 'error',
                        message: data.msg,
                        duration: 2000
                    });
                }
            });
        }
    }
});

/***/ }),

/***/ 261:
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
              { attrs: { label: "主持人" } },
              [
                _c("el-input", {
                  model: {
                    value: _vm.form.pro_host,
                    callback: function($$v) {
                      _vm.$set(_vm.form, "pro_host", $$v)
                    },
                    expression: "form.pro_host"
                  }
                })
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "el-form-item",
              { attrs: { label: "所有参加人" } },
              [
                _c("el-input", {
                  model: {
                    value: _vm.form.pro_all_author,
                    callback: function($$v) {
                      _vm.$set(_vm.form, "pro_all_author", $$v)
                    },
                    expression: "form.pro_all_author"
                  }
                })
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "el-form-item",
              { attrs: { label: "项目名称" } },
              [
                _c("el-input", {
                  model: {
                    value: _vm.form.entry_name,
                    callback: function($$v) {
                      _vm.$set(_vm.form, "entry_name", $$v)
                    },
                    expression: "form.entry_name"
                  }
                })
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "el-form-item",
              { attrs: { label: "项目类别" } },
              [
                _c("el-input", {
                  model: {
                    value: _vm.form.project_category,
                    callback: function($$v) {
                      _vm.$set(_vm.form, "project_category", $$v)
                    },
                    expression: "form.project_category"
                  }
                })
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "el-form-item",
              { attrs: { label: "批准单位" } },
              [
                _c("el-input", {
                  model: {
                    value: _vm.form.approval_unit,
                    callback: function($$v) {
                      _vm.$set(_vm.form, "approval_unit", $$v)
                    },
                    expression: "form.approval_unit"
                  }
                })
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "el-form-item",
              { attrs: { label: "批准经费" } },
              [
                _c("el-input", {
                  model: {
                    value: _vm.form.approval_funds,
                    callback: function($$v) {
                      _vm.$set(_vm.form, "approval_funds", $$v)
                    },
                    expression: "form.approval_funds"
                  }
                })
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "el-form-item",
              { attrs: { label: "当年到账经费" } },
              [
                _c("el-input", {
                  model: {
                    value: _vm.form.account_outlay,
                    callback: function($$v) {
                      _vm.$set(_vm.form, "account_outlay", $$v)
                    },
                    expression: "form.account_outlay"
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
                      value: _vm.form.pro_cate_research,
                      callback: function($$v) {
                        _vm.$set(_vm.form, "pro_cate_research", $$v)
                      },
                      expression: "form.pro_cate_research"
                    }
                  },
                  [
                    _c("el-option", {
                      attrs: { label: "基础研究", value: "1" }
                    }),
                    _vm._v(" "),
                    _c("el-option", {
                      attrs: { label: "实验与发展", value: "2" }
                    }),
                    _vm._v(" "),
                    _c("el-option", {
                      attrs: { label: "应用研究", value: "3" }
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
                      value: _vm.form.pro_sub_category,
                      callback: function($$v) {
                        _vm.$set(_vm.form, "pro_sub_category", $$v)
                      },
                      expression: "form.pro_sub_category"
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
              { attrs: { label: "合作形式" } },
              [
                _c(
                  "el-select",
                  {
                    attrs: { placeholder: "请选择类别" },
                    model: {
                      value: _vm.form.form_cooperate,
                      callback: function($$v) {
                        _vm.$set(_vm.form, "form_cooperate", $$v)
                      },
                      expression: "form.form_cooperate"
                    }
                  },
                  [
                    _c("el-option", {
                      attrs: { label: "与境外机构合作", value: "1" }
                    }),
                    _vm._v(" "),
                    _c("el-option", {
                      attrs: { label: "与国内高校合作", value: "2" }
                    }),
                    _vm._v(" "),
                    _c("el-option", {
                      attrs: { label: "与国内独立研究机构合作", value: "3" }
                    }),
                    _vm._v(" "),
                    _c("el-option", {
                      attrs: { label: "与境内注册外商独资企业合作", value: "4" }
                    }),
                    _vm._v(" "),
                    _c("el-option", {
                      attrs: { label: "与境内注册其他企业合作", value: "5" }
                    }),
                    _vm._v(" "),
                    _c("el-option", { attrs: { label: "其他", value: "6" } })
                  ],
                  1
                )
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "el-form-item",
              { attrs: { label: "社会经济目标" } },
              [
                _c("el-input", {
                  model: {
                    value: _vm.form.social_eco_goal,
                    callback: function($$v) {
                      _vm.$set(_vm.form, "social_eco_goal", $$v)
                    },
                    expression: "form.social_eco_goal"
                  }
                })
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "el-form-item",
              { attrs: { label: "服务的国民经济行业" } },
              [
                _c("el-input", {
                  model: {
                    value: _vm.form.na_eco_industry,
                    callback: function($$v) {
                      _vm.$set(_vm.form, "na_eco_industry", $$v)
                    },
                    expression: "form.na_eco_industry"
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
                    value: _vm.form.pro_integral,
                    callback: function($$v) {
                      _vm.$set(_vm.form, "pro_integral", $$v)
                    },
                    expression: "form.pro_integral"
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
                    value: _vm.form.pro_remarks,
                    callback: function($$v) {
                      _vm.$set(_vm.form, "pro_remarks", $$v)
                    },
                    expression: "form.pro_remarks"
                  }
                })
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "el-form-item",
              { attrs: { label: "项目合同书封面图片" } },
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
              { attrs: { label: "项目年份" } },
              [
                _c(
                  "el-col",
                  { attrs: { span: 15 } },
                  [
                    _c("el-date-picker", {
                      staticStyle: { width: "100%" },
                      attrs: { type: "date", placeholder: "选择日期" },
                      model: {
                        value: _vm.form.project_year,
                        callback: function($$v) {
                          _vm.$set(_vm.form, "project_year", $$v)
                        },
                        expression: "form.project_year"
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
              [
                _c(
                  "el-button",
                  {
                    attrs: { type: "primary" },
                    on: {
                      click: function($event) {
                        _vm.onSubmit(_vm.form)
                      }
                    }
                  },
                  [_vm._v("立即创建")]
                ),
                _vm._v(" "),
                _c(
                  "el-button",
                  [
                    _c("router-link", { attrs: { to: "/project" } }, [
                      _vm._v("取消")
                    ])
                  ],
                  1
                )
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
    require("vue-hot-reload-api")      .rerender("data-v-50401b45", module.exports)
  }
}

/***/ })

});