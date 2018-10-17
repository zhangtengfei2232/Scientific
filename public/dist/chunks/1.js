webpackJsonp([1],{

/***/ 207:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(212)
}
var normalizeComponent = __webpack_require__(82)
/* script */
var __vue_script__ = __webpack_require__(214)
/* template */
var __vue_template__ = __webpack_require__(215)
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
Component.options.__file = "resources/assets/js/components/teacher/infor.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-200b6510", Component.options)
  } else {
    hotAPI.reload("data-v-200b6510", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 212:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(213);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(81)("71ba19c8", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-200b6510\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./infor.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-200b6510\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./infor.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 213:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(25)(false);
// imports


// module
exports.push([module.i, "\n.main{\n    width: 100%;\n    margin:0 auto\n}\n.content{\n    width: 87%;\n    float: right;\n}\n.perInfo{\n    width: 100%;\n    height: 50px;\n    line-height: 52px;\n    border-bottom: 1px solid gray;\n}\n.body{\n    Font-size:25%\n}\n.detiaLeft{\n    width: 12%;\n    /*background-color: #2ab27b;*/\n    font-size:0.95em;\n    float: left;\n    margin-left: 10%;\n}\n.detialRight{\n    width: 78%;\n    float: right;\n}\n.detial{\n    margin-top: 3%;\n}\n.detial p{\n    line-height: 43px;\n    height:50px;\n}\n.detialRight img{\n    width: 33px;\n}\n.el-date-editor.el-input{\n    width: 217px;\n}\n.change{\n    color: rgba(0, 179, 138, 1);\n    margin-left:2%;\n}\n.commit{\n    /*float: right;*/\n    width: 320px;\n    /*margin-right: 30%;*/\n}\n/*//组件*/\n.upload-demo{\n    width: 320px;\n}\n.el-input{\n    width: 217px;\n}\n", ""]);

// exports


/***/ }),

/***/ 214:
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

/* harmony default export */ __webpack_exports__["default"] = ({
    data: function data() {
        return {
            fileList2: [{ name: 'food.jpeg', url: '/dist/img/wang_light.png' }],
            //                fileList2: [{name: 'food.jpeg', url: teacherDate.gra_cert_road}],
            teacherDate: {},
            show: false,
            //                inputJob:'' ,
            //                input: '',

            pickerOptions1: {
                disabledDate: function disabledDate(time) {
                    return time.getTime() > Date.now();
                }
            },
            value1: ''
        };
    },

    methods: {
        handleRemove: function handleRemove(file, fileList) {
            //console.log(file, fileList);
        },
        handlePreview: function handlePreview(file) {
            //console.log(file);
        },
        getInputValue: function getInputValue() {},
        getTeacherData: function getTeacherData() {
            var self = this;
            axios.get("selectteacher").then(function (response) {
                var data = response.data;
                console.log(data.datas);
                if (data.code == 0) {
                    self.teacherDate = data.datas;
                    //                        if (self.teacherDate.teacher_id == 1) {
                    //                            show = true;
                    //                        }else if(self.teacherDate.teacher_id == 2) {
                    //                            show = true;
                    //                        }
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
        this.getTeacherData();
        //            this.clickchange();
    }
});

/***/ }),

/***/ 215:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _c("div", { staticClass: "main" }, [
      _c("div", { staticClass: "content" }, [
        _vm._m(0),
        _vm._v(" "),
        _c("div", { staticClass: "detial" }, [
          _vm._m(1),
          _vm._v(" "),
          _c(
            "div",
            { staticClass: "detialRight" },
            [
              _vm._m(2),
              _vm._v(" "),
              _c(
                "p",
                [_c("el-input", { attrs: { value: _vm.teacherDate.name } })],
                1
              ),
              _vm._v(" "),
              _c(
                "p",
                [_c("el-input", { attrs: { value: _vm.teacherDate.sex } })],
                1
              ),
              _vm._v(" "),
              _c(
                "p",
                [_c("el-input", { attrs: { value: _vm.teacherDate.name } })],
                1
              ),
              _vm._v(" "),
              _c(
                "p",
                [
                  _c("el-input", {
                    attrs: { value: _vm.teacherDate.teacher_id }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "p",
                [
                  _c("el-input", {
                    attrs: { value: _vm.teacherDate.office_phone }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "p",
                [
                  _c("el-input", {
                    attrs: { value: _vm.teacherDate.home_phone }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "p",
                [_c("el-input", { attrs: { value: _vm.teacherDate.phone } })],
                1
              ),
              _vm._v(" "),
              _c(
                "p",
                [
                  _c("el-input", {
                    attrs: { value: _vm.teacherDate.native_place }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "p",
                [_c("el-input", { attrs: { value: _vm.teacherDate.number } })],
                1
              ),
              _vm._v(" "),
              _c(
                "p",
                [_c("el-input", { attrs: { value: _vm.teacherDate.nation } })],
                1
              ),
              _vm._v(" "),
              _c(
                "p",
                [_c("el-input", { attrs: { value: _vm.teacherDate.borth } })],
                1
              ),
              _vm._v(" "),
              _c(
                "p",
                [
                  _c("el-input", {
                    attrs: { value: _vm.teacherDate.polit_outlook }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "p",
                [
                  _c("el-input", {
                    attrs: { value: _vm.teacherDate.admin_duties }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "p",
                [
                  _c("el-input", {
                    attrs: { value: _vm.teacherDate.tenure_time }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "p",
                [
                  _c("el-input", {
                    attrs: { value: _vm.teacherDate.job_level }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "p",
                [
                  _c("el-input", {
                    attrs: { value: _vm.teacherDate.tenure_time }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "p",
                [
                  _c("el-input", {
                    attrs: { value: _vm.teacherDate.edu_school }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "p",
                [_c("el-input", { attrs: { value: _vm.teacherDate.name } })],
                1
              ),
              _vm._v(" "),
              _c(
                "p",
                [_c("el-input", { attrs: { value: _vm.teacherDate.name } })],
                1
              ),
              _vm._v(" "),
              _c(
                "p",
                [_c("el-input", { attrs: { value: _vm.teacherDate.series } })],
                1
              ),
              _vm._v(" "),
              _c(
                "p",
                [
                  _c("el-input", {
                    attrs: { value: _vm.teacherDate.post_category }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "p",
                [_c("el-input", { attrs: { value: _vm.teacherDate.company } })],
                1
              ),
              _vm._v(" "),
              _c(
                "p",
                [
                  _c("el-input", {
                    attrs: { value: _vm.teacherDate.te_re_department }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "p",
                [
                  _c("el-input", {
                    attrs: { value: _vm.teacherDate.working_hours }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "p",
                [
                  _c("el-input", {
                    attrs: { value: _vm.teacherDate.origin_work_unit }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "p",
                [
                  _c("el-input", {
                    attrs: { value: _vm.teacherDate.certificate_num }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "p",
                [
                  _c("el-input", {
                    attrs: { value: _vm.teacherDate.identity_card }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c("p"),
              _c("br"),
              _vm._v(" "),
              _c(
                "p",
                [_c("el-input", { attrs: { value: _vm.teacherDate.name } })],
                1
              ),
              _vm._v(" "),
              _c(
                "p",
                [
                  _c("el-input", {
                    attrs: { value: _vm.teacherDate.edu_school }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "p",
                [_c("el-input", { attrs: { value: _vm.teacherDate.name } })],
                1
              ),
              _vm._v(" "),
              _c(
                "p",
                [_c("el-input", { attrs: { value: _vm.teacherDate.name } })],
                1
              ),
              _vm._v(" "),
              _c("p"),
              _c("br"),
              _vm._v(" "),
              _c(
                "p",
                [
                  _c("el-input", {
                    attrs: { value: _vm.teacherDate.academic_id }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "p",
                [
                  _c("el-input", {
                    attrs: { value: _vm.teacherDate.edu_school }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "p",
                [_c("el-input", { attrs: { value: _vm.teacherDate.name } })],
                1
              ),
              _vm._v(" "),
              _c(
                "p",
                [_c("el-input", { attrs: { value: _vm.teacherDate.name } })],
                1
              ),
              _vm._v(" "),
              _c("br"),
              _vm._v(" "),
              _c(
                "p",
                [
                  _c("el-input", {
                    attrs: { value: _vm.teacherDate.work_major }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "p",
                [
                  _c("el-input", {
                    attrs: { value: _vm.teacherDate.belong_subject }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "p",
                [
                  _c("el-input", {
                    attrs: { value: _vm.teacherDate.teach_course }
                  })
                ],
                1
              ),
              _c("br"),
              _vm._v(" "),
              _c("br"),
              _c("br"),
              _vm._v(" "),
              _c(
                "p",
                [_c("el-input", { attrs: { value: _vm.teacherDate.name } })],
                1
              ),
              _vm._v(" "),
              _c(
                "p",
                [_c("el-input", { attrs: { value: _vm.teacherDate.name } })],
                1
              ),
              _c("br"),
              _vm._v(" "),
              _c(
                "p",
                { staticClass: "graduationPic" },
                [
                  _c(
                    "el-upload",
                    {
                      staticClass: "upload-demo",
                      attrs: {
                        action: "https://jsonplaceholder.typicode.com/posts/",
                        "on-preview": _vm.handlePreview,
                        "on-remove": _vm.handleRemove,
                        "file-list": _vm.fileList2,
                        "list-type": "picture"
                      }
                    },
                    [
                      _c(
                        "el-button",
                        { attrs: { size: "small", type: "primary" } },
                        [_vm._v("点击上传")]
                      ),
                      _vm._v(" "),
                      _c(
                        "div",
                        {
                          staticClass: "el-upload__tip",
                          attrs: { slot: "tip" },
                          slot: "tip"
                        },
                        [_vm._v("只能上传jpg/png文件，且不超过500kb")]
                      )
                    ],
                    1
                  )
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "el-button",
                {
                  staticClass: "commit",
                  attrs: { type: "primary", plain: "", disabled: "" }
                },
                [_vm._v("保存修改")]
              )
            ],
            1
          )
        ])
      ]),
      _vm._v(" "),
      _c("div", { staticStyle: { clear: "both" } })
    ])
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "perInfo" }, [
      _c("span", { staticStyle: { "margin-left": "15px" } }, [
        _vm._v("个人信息")
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "detiaLeft" }, [
      _c("p", [_vm._v("头像")]),
      _vm._v(" "),
      _c("p", [_vm._v("姓名")]),
      _vm._v(" "),
      _c("p", [_vm._v("性别")]),
      _vm._v(" "),
      _c("p", [_vm._v("分组")]),
      _vm._v(" "),
      _c("p", [_vm._v("工号")]),
      _vm._v(" "),
      _c("p", [_vm._v("办公电话")]),
      _vm._v(" "),
      _c("p", [_vm._v("住宅电话")]),
      _vm._v(" "),
      _c("p", [_vm._v("手机")]),
      _vm._v(" "),
      _c("p", [_vm._v("籍贯")]),
      _vm._v(" "),
      _c("p", [_vm._v("编号")]),
      _vm._v(" "),
      _c("p", [_vm._v("民族")]),
      _vm._v(" "),
      _c("p", [_vm._v("出生年月")]),
      _vm._v(" "),
      _c("p", [_vm._v("政治面貌")]),
      _vm._v(" "),
      _c("p", [_vm._v("行政职务")]),
      _vm._v(" "),
      _c("p", [_vm._v("任职时间")]),
      _vm._v(" "),
      _c("p", [_vm._v("职务级别")]),
      _vm._v(" "),
      _c("p", [_vm._v("任职时间")]),
      _vm._v(" "),
      _c("p", [_vm._v("专业技术职务")]),
      _vm._v(" "),
      _c("p", [_vm._v("评审通过时间")]),
      _vm._v(" "),
      _c("p", [_vm._v("聘任时间")]),
      _vm._v(" "),
      _c("p", [_vm._v("系列")]),
      _vm._v(" "),
      _c("p", [_vm._v("岗位类别")]),
      _vm._v(" "),
      _c("p", [_vm._v("所在单位")]),
      _vm._v(" "),
      _c("p", [_vm._v("所属教研室和实验室")]),
      _vm._v(" "),
      _c("p", [_vm._v("来校工作时间")]),
      _vm._v(" "),
      _c("p", [_vm._v("原工作单位")]),
      _vm._v(" "),
      _c("p", [_vm._v("教师资格证书编号")]),
      _vm._v(" "),
      _c("p", [_vm._v("身份证号")]),
      _c("br"),
      _vm._v(" "),
      _c("p", [_vm._v("第一学历：")]),
      _vm._v(" "),
      _c("p", [_vm._v("学历/学位")]),
      _vm._v(" "),
      _c("p", [_vm._v("毕业学校")]),
      _vm._v(" "),
      _c("p", [_vm._v("所学专业")]),
      _vm._v(" "),
      _c("p", [_vm._v("毕业时间")]),
      _c("br"),
      _vm._v(" "),
      _c("p", [_vm._v("最高学历：")]),
      _vm._v(" "),
      _c("p", [_vm._v("学历/学位")]),
      _vm._v(" "),
      _c("p", [_vm._v("毕业学校")]),
      _vm._v(" "),
      _c("p", [_vm._v("所学专业")]),
      _vm._v(" "),
      _c("p", [_vm._v("毕业时间")]),
      _c("br"),
      _vm._v(" "),
      _c("p", [_vm._v("现从事专业")]),
      _vm._v(" "),
      _c("p", [_vm._v("所属学科")]),
      _vm._v(" "),
      _c("p", [_vm._v("任教课程")]),
      _c("br"),
      _vm._v(" "),
      _c("p", [_vm._v("硕(博)导：")]),
      _vm._v(" "),
      _c("p", [_vm._v("授予单位")]),
      _vm._v(" "),
      _c("p", [_vm._v("获得时间")]),
      _c("br"),
      _vm._v(" "),
      _c("p", [_vm._v("毕业证书图片")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [
      _c("img", { attrs: { src: "/dist/img/pic_fill.png", alt: "未加载" } })
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-200b6510", module.exports)
  }
}

/***/ })

});