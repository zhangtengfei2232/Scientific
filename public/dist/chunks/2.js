webpackJsonp([2],{

/***/ 203:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(208)
}
var normalizeComponent = __webpack_require__(79)
/* script */
var __vue_script__ = __webpack_require__(210)
/* template */
var __vue_template__ = __webpack_require__(211)
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

/***/ 208:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(209);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(80)("71ba19c8", content, false, {});
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

/***/ 209:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(48)(false);
// imports


// module
exports.push([module.i, "\n.main{\n    width: 100%;\n    /*height: 935px;*/\n    margin:0 auto\n    /*text-align: center;*/\n    /*background-color: #1b6d85;*/\n    /*display: inline-block;*/\n}\n.content{\n    width: 87%;\n    /*background-color: #1b6d85;*/\n    /*margin: 0;*/\n    float: right;\n}\n.perInfo{\n    width: 100%;\n    height: 50px;\n    line-height: 52px;\n    /*margin-left: 20px;*/\n    border-bottom: 1px solid gray;\n}\n/*.detial{*/\n/*width: 80%;*/\n/*background-color: #5bc0de;*/\n/*}*/\n/*.detial li{*/\n/*height: 50px;*/\n/*}*/\n/*.space{*/\n/*margin-left: 70px;*/\n/*}*/\n/*.space img{*/\n/*width: 33px;*/\n/*vertical-align:middle;*/\n/*}*/\n.body{\n    Font-size:25%\n}\n.detiaLeft{\n    width: 10%;\n    /*background-color: #2ab27b;*/\n    font-size:0.95em;\n    float: left;\n    margin-left: 10%;\n}\n.detialRight{\n    width: 78%;\n    float: right;\n    /*background-color: #4bb1b1;*/\n}\n.detial{\n    margin-top: 3%;\n}\n.detial p{\n    line-height: 43px;\n    height:50px;\n}\n.detialRight img{\n    width: 33px;\n    /*vertical-align:middle;*/\n}\n.el-date-editor.el-input{\n    width: 217px;\n}\n.change{\n    color: rgba(0, 179, 138, 1);\n    margin-left:2%;\n}\n/*//组件*/\n.upload-demo{\n    width: 320px;\n}\n.el-input{\n    width: 217px;\n}\n", ""]);

// exports


/***/ }),

/***/ 210:
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

/* harmony default export */ __webpack_exports__["default"] = ({
    data: function data() {
        return {
            //                list:[
            //                    {lis:'头像'}, {lis:'姓名'}, {lis:'分组'}, {lis:'工号'}, {lis:'办公电话'}, {lis:'住宅电话'},
            //                    {lis:'手机'}, {lis:'籍贯'}, {lis:'编号'}, {lis:'民族'}, {lis:'出生年月'}, {lis:'政治面貌'},
            //                    {lis:'行政职务'}, {lis:'任职时间'}, {lis:'职务级别'}, {lis:'任职时间'}, {lis:'专业技术职务'},
            //                    {lis:'评审通过时间'}, {lis:'聘任时间'}, {lis:'系列'}, {lis:'岗位类别'}, {lis:'所在单位'},
            //                    {lis:'所属教研室和实验室'}, {lis:'来校工作时间'}, {lis:'原工作单位'}, {lis:'教师资格证书编号'},
            //                    {lis:'身份证号'},
            //                    {lis:'第一学历'}, {lis:'毕业学校'}, {lis:'所学专业'}, {lis:'毕业时间'},
            //                    {lis:'最高学历：'}, {lis:'学历/学位'}, {lis:'毕业学校'}, {lis:'所学专业'}, {lis:'毕业时间'},
            //                    {lis:'最高学历：'}, {lis:'毕业学校'}, {lis:'所学专业'}, {lis:'毕业时间'}, {lis:'现从事专业'},
            //                    {lis:'所属学科'}, {lis:'任教课程'}, {lis:'硕(博)导：'}, {lis:'授予单位'}, {lis:'获得时间'},
            //                    {lis:'毕业证书图片'},
            //
            //                ],
            fileList2: [{ name: 'food.jpeg', url: '/dist/img/wang_light.png' }, { name: 'food2.jpeg', url: '/dist/img/wang_light.png' }],
            teacherDate: {},
            show: false,
            inputJob: '',
            input: '',
            options: [{
                value: '选项1',
                label: '黄金糕'
            }, {
                value: '选项4',
                label: '龙须面'
            }, {
                value: '选项5',
                label: '北京烤鸭'
            }],
            options1: [{
                value: '选项1',
                label: '12'
            }],
            value: '',

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
            console.log(file, fileList);
        },
        handlePreview: function handlePreview(file) {
            console.log(file);
        },


        //          getPage:function () {
        //              let self = this;
        //              axios.get("selectteacher").then(function (response) {
        //                    self.options = response.data;
        //              });
        //          },
        clickchange: function clickchange() {
            var change = document.getElementsByClassName("change")[0];
            var txtArrs = document.getElementsByTagName('input');
            for (var i = 0; i < change.length; i++) {
                var txt = change[i];

                if (txt.type == 'text') {
                    if (txt.disabled == true) {
                        txt.disabled = false;
                    } else {
                        //txt.disabled = false;
                    }
                }
            }
        },
        getTeacherData: function getTeacherData() {
            var self = this;
            axios.get("selectteacher").then(function (response) {
                var data = response.data;
                console.log(data);
                if (data.code == 0) {
                    self.teacherDate = data.datas;
                    console.log(self.teacherDate);
                    if (self.teacherDate.teacher_id == 1) {
                        show = true;
                    } else if (self.teacherDate.teacher_id == 2) {
                        show = true;
                    }
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
        this.clickchange();
    }
});
//    function clickchange() {

//        var txtArrs = document.getElementsByTagName('input');
//        for ( var i = 0; i < txtArrs.length; i++) {
//            var txt = txtArrs[i];
//            if (txt.type == 'text') {
//                if (txt.disabled == true) {
//                    txt.disabled = false;
//                } else {
//                    //txt.disabled = false;
//                }
//            }
//        }
//    }

/***/ }),

/***/ 211:
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
          _c("div", { staticClass: "detialRight" }, [
            _vm._m(2),
            _vm._v(" "),
            _c(
              "p",
              [
                _c("el-input", {
                  attrs: { value: _vm.teacherDate.name, disabled: true }
                }),
                _c(
                  "span",
                  {
                    staticClass: "change",
                    nativeOn: {
                      click: function($event) {
                        return _vm.clickchange($event)
                      }
                    }
                  },
                  [_vm._v("修改")]
                )
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "p",
              [
                _c("el-input", {
                  attrs: { value: _vm.teacherDate.name, disabled: true }
                }),
                _c(
                  "span",
                  {
                    staticClass: "change",
                    nativeOn: {
                      click: function($event) {
                        return _vm.clickchange($event)
                      }
                    }
                  },
                  [_vm._v("修改")]
                )
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "p",
              [
                _c("el-input", {
                  attrs: { value: _vm.teacherDate.teacher_id, disabled: true }
                }),
                _c("span", { staticClass: "change" }, [_vm._v("修改")])
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "p",
              [
                _c("el-input", {
                  attrs: { value: _vm.teacherDate.office_phone, disabled: true }
                }),
                _c("span", { staticClass: "change" }, [_vm._v("修改")])
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "p",
              [
                _c("el-input", {
                  attrs: { value: _vm.teacherDate.home_phone, disabled: true }
                }),
                _c("span", { staticClass: "change" }, [_vm._v("修改")])
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "p",
              [
                _c("el-input", {
                  attrs: { value: _vm.teacherDate.phone, disabled: true }
                }),
                _c("span", { staticClass: "change" }, [_vm._v("修改")])
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "p",
              [
                _c("el-input", {
                  attrs: { value: _vm.teacherDate.native_place, disabled: true }
                }),
                _c("span", { staticClass: "change" }, [_vm._v("修改")])
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "p",
              [
                _c("el-input", {
                  attrs: { value: _vm.teacherDate.number, disabled: true }
                }),
                _c("span", { staticClass: "change" }, [_vm._v("修改")])
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "p",
              [
                _c("el-input", {
                  attrs: { value: _vm.teacherDate.nation, disabled: true }
                }),
                _c("span", { staticClass: "change" }, [_vm._v("修改")])
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "p",
              [
                _c("el-input", {
                  attrs: { value: _vm.teacherDate.borth, disabled: true }
                }),
                _c("span", { staticClass: "change" }, [_vm._v("修改")])
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "p",
              [
                _c("el-input", {
                  attrs: {
                    value: _vm.teacherDate.polit_outlook,
                    disabled: true
                  }
                }),
                _c("span", { staticClass: "change" }, [_vm._v("修改")])
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "p",
              [
                _c("el-input", {
                  attrs: { value: _vm.teacherDate.admin_duties, disabled: true }
                }),
                _c("span", { staticClass: "change" }, [_vm._v("修改")])
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "p",
              [
                _c("el-input", {
                  attrs: { value: _vm.teacherDate.tenure_time, disabled: true }
                }),
                _c("span", { staticClass: "change" }, [_vm._v("修改")])
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "p",
              [
                _c("el-input", {
                  attrs: { value: _vm.teacherDate.job_level, disabled: true }
                }),
                _c("span", { staticClass: "change" }, [_vm._v("修改")])
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "p",
              [
                _c("el-input", {
                  attrs: { value: _vm.teacherDate.tenure_time, disabled: true }
                }),
                _c("span", { staticClass: "change" }, [_vm._v("修改")])
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "p",
              [
                _c("el-input", {
                  attrs: { value: _vm.teacherDate.edu_school, disabled: true }
                }),
                _c("span", { staticClass: "change" }, [_vm._v("修改")])
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "p",
              [
                _c("el-input", {
                  attrs: { value: _vm.teacherDate.name, disabled: true }
                }),
                _c("span", { staticClass: "change" }, [_vm._v("修改")])
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "p",
              [
                _c("el-input", {
                  attrs: { value: _vm.teacherDate.name, disabled: true }
                }),
                _c("span", { staticClass: "change" }, [_vm._v("修改")])
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "p",
              [
                _c("el-input", {
                  attrs: { value: _vm.teacherDate.series, disabled: true }
                }),
                _c("span", { staticClass: "change" }, [_vm._v("修改")])
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "p",
              [
                _c("el-input", {
                  attrs: {
                    value: _vm.teacherDate.post_category,
                    disabled: true
                  }
                }),
                _c("span", { staticClass: "change" }, [_vm._v("修改")])
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "p",
              [
                _c("el-input", {
                  attrs: { value: _vm.teacherDate.company, disabled: true }
                }),
                _c("span", { staticClass: "change" }, [_vm._v("修改")])
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "p",
              [
                _c("el-input", {
                  attrs: {
                    value: _vm.teacherDate.te_re_department,
                    disabled: true
                  }
                }),
                _c("span", { staticClass: "change" }, [_vm._v("修改")])
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "p",
              [
                _c("el-input", {
                  attrs: {
                    value: _vm.teacherDate.working_hours,
                    disabled: true
                  }
                }),
                _c("span", { staticClass: "change" }, [_vm._v("修改")])
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "p",
              [
                _c("el-input", {
                  attrs: {
                    value: _vm.teacherDate.origin_work_unit,
                    disabled: true
                  }
                }),
                _c("span", { staticClass: "change" }, [_vm._v("修改")])
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "p",
              [
                _c("el-input", {
                  attrs: {
                    value: _vm.teacherDate.certificate_num,
                    disabled: true
                  }
                }),
                _c("span", { staticClass: "change" }, [_vm._v("修改")])
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "p",
              [
                _c("el-input", {
                  attrs: {
                    value: _vm.teacherDate.identity_card,
                    disabled: true
                  }
                }),
                _c("span", { staticClass: "change" }, [_vm._v("修改")])
              ],
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
                  attrs: { value: _vm.teacherDate.academic_id, disabled: true }
                }),
                _c("span", { staticClass: "change" }, [_vm._v("修改")])
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "p",
              [
                _c("el-input", {
                  attrs: { value: _vm.teacherDate.edu_school, disabled: true }
                }),
                _c("span", { staticClass: "change" }, [_vm._v("修改")])
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "p",
              [
                _c("el-input", {
                  attrs: { value: _vm.teacherDate.name, disabled: true }
                }),
                _c("span", { staticClass: "change" }, [_vm._v("修改")])
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "p",
              [
                _c("el-input", {
                  attrs: { value: _vm.teacherDate.name, disabled: true }
                }),
                _c("span", { staticClass: "change" }, [_vm._v("修改")])
              ],
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
                  attrs: { value: _vm.teacherDate.academic_id, disabled: true }
                }),
                _c("span", { staticClass: "change" }, [_vm._v("修改")])
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "p",
              [
                _c("el-input", {
                  attrs: { value: _vm.teacherDate.edu_school, disabled: true }
                }),
                _c("span", { staticClass: "change" }, [_vm._v("修改")])
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "p",
              [
                _c("el-input", {
                  attrs: { value: _vm.teacherDate.name, disabled: true }
                }),
                _c("span", { staticClass: "change" }, [_vm._v("修改")])
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "p",
              [
                _c("el-input", {
                  attrs: { value: _vm.teacherDate.name, disabled: true }
                }),
                _c("span", { staticClass: "change" }, [_vm._v("修改")])
              ],
              1
            ),
            _c("br"),
            _vm._v(" "),
            _c(
              "p",
              [
                _c("el-input", {
                  attrs: { value: _vm.teacherDate.work_major, disabled: true }
                }),
                _c("span", { staticClass: "change" }, [_vm._v("修改")])
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "p",
              [
                _c("el-input", {
                  attrs: {
                    value: _vm.teacherDate.belong_subject,
                    disabled: true
                  }
                }),
                _c("span", { staticClass: "change" }, [_vm._v("修改")])
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "p",
              [
                _c("el-input", {
                  attrs: { value: _vm.teacherDate.teach_course, disabled: true }
                }),
                _c("span", { staticClass: "change" }, [_vm._v("修改")])
              ],
              1
            ),
            _c("br"),
            _vm._v(" "),
            _c(
              "p",
              [
                _c("el-input", {
                  attrs: { value: _vm.teacherDate.master_insid, disabled: true }
                }),
                _c("span", { staticClass: "change" }, [_vm._v("修改")])
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "p",
              [
                _c("el-input", {
                  attrs: { value: _vm.teacherDate.name, disabled: true }
                }),
                _c("span", { staticClass: "change" }, [_vm._v("修改")])
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "p",
              [
                _c("el-input", {
                  attrs: { value: _vm.teacherDate.name, disabled: true }
                }),
                _c("span", { staticClass: "change" }, [_vm._v("修改")])
              ],
              1
            ),
            _c("br"),
            _vm._v(" "),
            _c(
              "p",
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
            )
          ])
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