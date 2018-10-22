webpackJsonp([18],{

/***/ 218:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(277)
}
var normalizeComponent = __webpack_require__(82)
/* script */
var __vue_script__ = __webpack_require__(279)
/* template */
var __vue_template__ = __webpack_require__(280)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-26712338"
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
Component.options.__file = "resources/assets/js/components/award/award.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-26712338", Component.options)
  } else {
    hotAPI.reload("data-v-26712338", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 277:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(278);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(81)("82c129d4", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-26712338\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./award.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-26712338\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./award.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 278:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(25)(false);
// imports


// module
exports.push([module.i, "\nheader[data-v-26712338]{\n    border-bottom: 1px solid #eee;\n}\n.paper[data-v-26712338]{\n    font-size: 18px;\n    color: #090909;\n    display: inline-block;\n    padding: 23px 60px;\n    border-right: 1px solid #eee;\n}\n.load[data-v-26712338]{\n    display: inline-block;\n    margin: 0;\n    padding: 16px 60px;\n    border-right: 1px solid #eee;\n}\n.searchtime[data-v-26712338]{\n     width: 45%;\n     display: inline-block;\n     margin: 15px 0 0 18%;\n}\n.demonstration[data-v-26712338]{\n    font-weight: lighter;\n}\n.navbo[data-v-26712338]{\n    border-bottom: 1px solid #eee;\n    background: rgba(187, 187, 187, 0.1);\n    height: 40px;\n}\n.info[data-v-26712338],.number[data-v-26712338],.do[data-v-26712338],.time[data-v-26712338]{\n    display: inline-block;\n    padding: 10px;\n    font-size: 14px;\n}\n.number[data-v-26712338]{\n    margin: 0 2% 0 3%;\n}\n.time[data-v-26712338]{\n    margin: 0 6% 0 45%;\n}\n.lists[data-v-26712338]{\n    border-bottom: 1px solid #eee;\n    height: 80px;\n}\n.del[data-v-26712338],.times[data-v-26712338],.infos[data-v-26712338],.numbers[data-v-26712338],.dos[data-v-26712338],.tos[data-v-26712338]{\n    display: inline-block;\n    padding: 10px;\n    font-size: 14px;\n}\n.lists span[data-v-26712338]{\n    float: left;\n}\n.lists img[data-v-26712338]{\n    width: 35px;\n}\n.numbers[data-v-26712338]{\n    margin: 20px 2% 0 3.5%;\n}\n.check[data-v-26712338]{\n    margin: 25px 2% 0 3%;\n}\n.checks[data-v-26712338]{\n    margin: 0 2% 0 3%;\n}\n.picture[data-v-26712338]{\n    margin: 20px 5px 0 1%;\n}\n.infos[data-v-26712338]{\n    margin: 10px 2% 0 0;\n}\n.infos h5[data-v-26712338]{\n    font-size: 14px;\n    font-weight: lighter;\n}\n.infos p[data-v-26712338]{\n    font-size: 13px;\n    font-weight: lighter;\n    margin: 8px 0 0 0;\n}\n.infos p small[data-v-26712338]{\n    color: orange;\n    padding: 0 0 0 5px;\n}\n.times[data-v-26712338]{\n    margin: 22px 2% 0 39%;\n}\n.dos[data-v-26712338],.tos[data-v-26712338],.del[data-v-26712338]{\n    font-size: 13px;\n    margin: 23px 0 0 0;\n    color: rgba(61, 112, 206, 0.77)!important;\n}\n.dos a[data-v-26712338],.tos a[data-v-26712338]{\n    color: rgba(61, 112, 206, 0.77)!important;\n}\n.del a[data-v-26712338]{\n    color: rgba(229, 28, 35, 1)!important;\n}\n.clear[data-v-26712338]{\n    clear: both;\n    content: '';\n}\n", ""]);

// exports


/***/ }),

/***/ 279:
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
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
            AwardDate: [],
            checkAll: false,
            checked: false,
            form: {
                data1: '',
                data2: ''
            }
        };
    },

    methods: {
        handleCheckAllChange: function handleCheckAllChange(val) {
            this.checkedCities = val ? this.AwardDate : [];
            this.isIndeterminate = false;
        },
        handleCheckedCitiesChange: function handleCheckedCitiesChange(value) {
            var checkedCount = value.length;
            this.checkAll = checkedCount === this.AwardDate.length;
            this.isIndeterminate = checkedCount > 0 && checkedCount < this.AwardDate.length;
        },
        getAwardDate: function getAwardDate() {
            var self = this;
            axios.get("selectopus").then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.AwardDate = data.datas;
                } else {
                    self.$notify({
                        type: 'error',
                        message: data.msg,
                        duration: 2000
                    });
                }
            });
        },
        sentAwardSelfData: function sentAwardSelfData(aw_id) {
            this.$router.push({
                path: '/selfAward/' + aw_id
            });
        },
        deleteAwardData: function deleteAwardData(aw_id) {
            var _this = this;

            this.$confirm('此操作将永久删除该文件, 是否继续?', '提示', {
                confirmButtonText: '确定',
                cancelButtonText: '取消',
                type: 'warning'
            }).then(function () {
                var self = _this;
                axios.get("", aw_id).then(function (response) {
                    var data = response.data;
                    if (data.code == 0) {
                        this.$message({
                            type: 'success',
                            message: '删除成功!'
                        });
                    } else {
                        self.$notify({
                            type: 'error',
                            message: data.msg,
                            duration: 2000
                        });
                    }
                });
            }).catch(function () {
                _this.$message({
                    type: 'info',
                    message: '已取消删除'
                });
            });
        },
        byTimeSearch: function byTimeSearch(form) {
            axios.get("", form).then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.AwardDate = data.datas;
                } else {
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
        this.getAwardDate();
    }
});

/***/ }),

/***/ 280:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _c("header", [
      _c("span", { staticClass: "paper" }, [
        _vm._v("\n            获奖\n        ")
      ]),
      _vm._v(" "),
      _c(
        "span",
        { staticClass: "load" },
        [
          _c(
            "router-link",
            { attrs: { to: "/addAward" } },
            [
              _c("el-button", { attrs: { type: "primary" } }, [
                _c("i", { staticClass: "el-icon-plus el-icon--left" }, [
                  _vm._v("上传")
                ])
              ])
            ],
            1
          )
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "span",
        { staticClass: "searchtime" },
        [
          _c("el-form", [
            _c(
              "div",
              { staticClass: "block" },
              [
                _c("span", { staticClass: "demonstration" }, [
                  _vm._v("按发表时间检索:")
                ]),
                _vm._v(" "),
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
                }),
                _vm._v(" "),
                _c(
                  "el-button",
                  {
                    staticStyle: { "margin-left": "10px" },
                    attrs: { type: "primary" },
                    on: {
                      click: function($event) {
                        _vm.byTimeSearch(_vm.form)
                      }
                    }
                  },
                  [_vm._v("搜索")]
                )
              ],
              1
            )
          ])
        ],
        1
      )
    ]),
    _vm._v(" "),
    _c("div", { staticClass: "navbo" }, [
      _c(
        "span",
        { staticClass: "checks" },
        [
          _c("el-checkbox", {
            model: {
              value: _vm.checked,
              callback: function($$v) {
                _vm.checked = $$v
              },
              expression: "checked"
            }
          })
        ],
        1
      ),
      _vm._v(" "),
      _c("span", { staticClass: "number" }, [_vm._v("序号")]),
      _vm._v(" "),
      _c("span", { staticClass: "info" }, [_vm._v("论文信息")]),
      _vm._v(" "),
      _c("span", { staticClass: "time" }, [_vm._v("发表时间")]),
      _vm._v(" "),
      _c("span", { staticClass: "do" }, [_vm._v("操作")])
    ]),
    _vm._v(" "),
    _c(
      "div",
      { staticClass: "content" },
      [
        _c(
          "el-checkbox-group",
          {
            on: { change: _vm.handleCheckedCitiesChange },
            model: {
              value: _vm.checkAll,
              callback: function($$v) {
                _vm.checkAll = $$v
              },
              expression: "checkAll"
            }
          },
          _vm._l(_vm.AwardDate, function(item, index) {
            return _c("div", { key: index, staticClass: "lists" }, [
              _c(
                "span",
                { staticClass: "check" },
                [
                  _c("el-checkbox", {
                    model: {
                      value: _vm.checked,
                      callback: function($$v) {
                        _vm.checked = $$v
                      },
                      expression: "checked"
                    }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c("span", { staticClass: "numbers" }, [
                _vm._v(_vm._s(item.teacher_id))
              ]),
              _vm._v(" "),
              _c("span", { staticClass: "picture" }, [
                _c("img", {
                  attrs: { src: "/dist/img/hj.png", alt: "文件加载失败" }
                })
              ]),
              _vm._v(" "),
              _c("span", { staticClass: "infos" }, [
                _c("h5", [_vm._v(_vm._s(item.title))]),
                _vm._v(" "),
                _c("p", [_vm._v("作者 "), _c("small", [_vm._v("特别标注")])])
              ]),
              _vm._v(" "),
              _c("span", { staticClass: "times" }, [_vm._v("2018-09-10")]),
              _vm._v(" "),
              _c(
                "span",
                {
                  staticClass: "dos",
                  on: {
                    click: function($event) {
                      _vm.sentAwardSelfData(item.aw_id)
                    }
                  }
                },
                [_vm._v("编辑")]
              ),
              _vm._v(" "),
              _c(
                "span",
                { staticClass: "tos" },
                [_c("router-link", { attrs: { to: "/" } }, [_vm._v("导出")])],
                1
              ),
              _vm._v(" "),
              _c(
                "span",
                {
                  staticClass: "dos",
                  on: {
                    click: function($event) {
                      _vm.sentAwardSelfData(item.aw_id)
                    }
                  }
                },
                [_vm._v("查看")]
              ),
              _vm._v(" "),
              _c(
                "span",
                {
                  staticClass: "del",
                  on: {
                    click: function($event) {
                      _vm.deleteAwardData(item.aw_id)
                    }
                  }
                },
                [_vm._v("删除")]
              ),
              _vm._v(" "),
              _c("div", { staticClass: "clear" })
            ])
          })
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
    require("vue-hot-reload-api")      .rerender("data-v-26712338", module.exports)
  }
}

/***/ })

});