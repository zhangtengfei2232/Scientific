webpackJsonp([1],{

/***/ 205:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(214)
}
var normalizeComponent = __webpack_require__(80)
/* script */
var __vue_script__ = __webpack_require__(216)
/* template */
var __vue_template__ = __webpack_require__(217)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-312dfdd0"
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
Component.options.__file = "resources/assets/js/components/teacher/paper.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-312dfdd0", Component.options)
  } else {
    hotAPI.reload("data-v-312dfdd0", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 214:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(215);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(79)("3b10cb51", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-312dfdd0\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./paper.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-312dfdd0\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./paper.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 215:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(48)(false);
// imports


// module
exports.push([module.i, "\nheader[data-v-312dfdd0]{\n    border-bottom: 1px solid #eee;\n}\n.paper[data-v-312dfdd0]{\n    font-size: 18px;\n    color: #090909;\n    display: inline-block;\n    padding: 23px 60px;\n\n    border-right: 1px solid #eee;\n}\n.load[data-v-312dfdd0]{\n    display: inline-block;\n    margin: 0;\n    padding: 16px 60px;\n    border-right: 1px solid #eee;\n}\n.navbo[data-v-312dfdd0]{\n    border-bottom: 1px solid #eee;\n    background: rgba(187, 187, 187, 0.1);\n    height: 40px;\n}\n.info[data-v-312dfdd0],.number[data-v-312dfdd0],.do[data-v-312dfdd0],.time[data-v-312dfdd0]{\n    display: inline-block;\n    padding: 10px;\n    font-size: 14px;\n}\n.number[data-v-312dfdd0]{\n    margin: 0 2% 0 3%;\n}\n.time[data-v-312dfdd0]{\n    margin: 0 3% 0 50%;\n}\n.lists[data-v-312dfdd0]{\n    border-bottom: 1px solid #eee;\n    height: 80px;\n}\n.numbers[data-v-312dfdd0]{\n}\n", ""]);

// exports


/***/ }),

/***/ 216:
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

/* harmony default export */ __webpack_exports__["default"] = ({
    data: function data() {
        return {};
    }
});

/***/ }),

/***/ 217:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _c("header", [
      _c("span", { staticClass: "paper" }, [
        _vm._v("\n            论文\n        ")
      ]),
      _vm._v(" "),
      _c(
        "span",
        { staticClass: "load" },
        [
          _c(
            "router-link",
            { attrs: { to: "/" } },
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
      )
    ]),
    _vm._v(" "),
    _vm._m(0),
    _vm._v(" "),
    _vm._m(1)
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "navbo" }, [
      _c("span", { staticClass: "number" }, [_vm._v("序号")]),
      _vm._v(" "),
      _c("span", { staticClass: "info" }, [_vm._v("论文信息")]),
      _vm._v(" "),
      _c("span", { staticClass: "time" }, [_vm._v("发表时间")]),
      _vm._v(" "),
      _c("span", { staticClass: "do" }, [_vm._v("操作")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "content" }, [
      _c("div", { staticClass: "lists" }, [
        _c("span", { staticClass: "numbers" }),
        _vm._v(" "),
        _c("span", [_c("img", { attrs: { src: "", alt: "" } })]),
        _vm._v(" "),
        _c("span", { staticClass: "infos" }),
        _vm._v(" "),
        _c("span", { staticClass: "times" }),
        _vm._v(" "),
        _c("span", { staticClass: "dos" })
      ])
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-312dfdd0", module.exports)
  }
}

/***/ })

});