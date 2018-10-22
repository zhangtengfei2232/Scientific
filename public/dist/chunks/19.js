webpackJsonp([19],{

/***/ 220:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(289)
}
var normalizeComponent = __webpack_require__(82)
/* script */
var __vue_script__ = __webpack_require__(291)
/* template */
var __vue_template__ = __webpack_require__(292)
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
Component.options.__file = "resources/assets/js/components/award/selfAward.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-6fdea4f8", Component.options)
  } else {
    hotAPI.reload("data-v-6fdea4f8", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 289:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(290);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(81)("89fe1a0a", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-6fdea4f8\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./selfAward.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-6fdea4f8\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./selfAward.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 290:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(25)(false);
// imports


// module
exports.push([module.i, "\n.information{\n       width: 75%;\n       float: left;\n}\n.add{\n       width: 80%;\n       margin: 35px 0 0 35px;\n}\n", ""]);

// exports


/***/ }),

/***/ 291:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
        var _form;

        return {
            AwardSelfData: {},
            form: (_form = {
                aw_first_author: ''
            }, _defineProperty(_form, 'aw_first_author', ''), _defineProperty(_form, 'prize_win_name', ''), _defineProperty(_form, 'award_name', ''), _defineProperty(_form, 'form_achievement', ''), _defineProperty(_form, 'aw_grade', ''), _defineProperty(_form, 'aw_level', ''), _defineProperty(_form, 'aw_grant_unit', ''), _defineProperty(_form, 'aw_grant_time', ''), _defineProperty(_form, 'aw_certi_number', ''), _defineProperty(_form, 'aw_sch_rank', ''), _defineProperty(_form, 'aw_integral', ''), _form)
        };
    },


    methods: {
        getBookSelfData: function getBookSelfData() {
            var self = this;
            var art_id = self.$route.params.art_id;
            axios.get("", art_id).then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.AwardSelfData = data.datas;
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
            if (form.author == '') {
                this.$message.error('第一获奖人不能为空');
            } else if (form.art_all_author == '') {
                this.$message.error('全部获奖人不能为空');
            } else if (form.title == '') {
                this.$message.error('获奖成果名称不能为空');
            } else if (form.publication_name == '') {
                this.$message.error('奖励名称不能为空');
            } else if (form.publication_num == '') {
                this.$message.error('成果形式不能为空');
            } else if (year1 == '') {
                this.$message.error('等级不能为空');
            } else if (year2 == '') {
                this.$message.error('奖励级别不能为空');
            } else if (year3 == '') {
                this.$message.error('授奖单位不能为空');
            } else if (year4 == '') {
                this.$message.error('授奖时间不能为空');
            } else if (year5 == '') {
                this.$message.error('证书编号不能为空');
            } else if (form.num_words == '') {
                this.$message.error('我校名次不能为空');
            } else if (form.periodical_cate == '') {
                this.$message.error('积分不能为空');
            } else {
                this.changeAwardData(form);
            }
        },
        changeAwardData: function changeAwardData(form) {
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
    },
    mounted: function mounted() {
        this.getBookSelfData();
    }
});

/***/ }),

/***/ 292:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "information" }, [
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
                    value: _vm.form.aw_first_author,
                    callback: function($$v) {
                      _vm.$set(_vm.form, "aw_first_author", $$v)
                    },
                    expression: "form.aw_first_author"
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
                    value: _vm.form.aw_all_author,
                    callback: function($$v) {
                      _vm.$set(_vm.form, "aw_all_author", $$v)
                    },
                    expression: "form.aw_all_author"
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
                    value: _vm.form.prize_win_name,
                    callback: function($$v) {
                      _vm.$set(_vm.form, "prize_win_name", $$v)
                    },
                    expression: "form.prize_win_name"
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
                    value: _vm.form.award_name,
                    callback: function($$v) {
                      _vm.$set(_vm.form, "award_name", $$v)
                    },
                    expression: "form.award_name"
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
                      value: _vm.form.form_achievement,
                      callback: function($$v) {
                        _vm.$set(_vm.form, "form_achievement", $$v)
                      },
                      expression: "form.form_achievement"
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
                      value: _vm.form.aw_grade,
                      callback: function($$v) {
                        _vm.$set(_vm.form, "aw_grade", $$v)
                      },
                      expression: "form.aw_grade"
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
                      value: _vm.form.aw_level,
                      callback: function($$v) {
                        _vm.$set(_vm.form, "aw_level", $$v)
                      },
                      expression: "form.aw_level"
                    }
                  },
                  [
                    _c("el-option", { attrs: { label: "国家级", value: "1" } }),
                    _vm._v(" "),
                    _c("el-option", { attrs: { label: "省部级", value: "2" } }),
                    _vm._v(" "),
                    _c("el-option", { attrs: { label: "厅局级", value: "3" } }),
                    _vm._v(" "),
                    _c("el-option", { attrs: { label: "校级", value: "4" } }),
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
                    value: _vm.form.aw_grant_unit,
                    callback: function($$v) {
                      _vm.$set(_vm.form, "aw_grant_unit", $$v)
                    },
                    expression: "form.aw_grant_unit"
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
                        value: _vm.form.aw_grant_time,
                        callback: function($$v) {
                          _vm.$set(_vm.form, "aw_grant_time", $$v)
                        },
                        expression: "form.aw_grant_time"
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
                    value: _vm.form.aw_certi_number,
                    callback: function($$v) {
                      _vm.$set(_vm.form, "aw_certi_number", $$v)
                    },
                    expression: "form.aw_certi_number"
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
                    value: _vm.form.aw_sch_rank,
                    callback: function($$v) {
                      _vm.$set(_vm.form, "aw_sch_rank", $$v)
                    },
                    expression: "form.aw_sch_rank"
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
                    value: _vm.form.aw_integral,
                    callback: function($$v) {
                      _vm.$set(_vm.form, "aw_integral", $$v)
                    },
                    expression: "form.aw_integral"
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
                _c(
                  "el-button",
                  [
                    _c("router-link", { attrs: { to: "/award" } }, [
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
    require("vue-hot-reload-api")      .rerender("data-v-6fdea4f8", module.exports)
  }
}

/***/ })

});