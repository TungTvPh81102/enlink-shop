!function(r){var n={};function s(e){if(n[e])return n[e].exports;var t=n[e]={i:e,l:!1,exports:{}};return r[e].call(t.exports,t,t.exports,s),t.l=!0,t.exports}s.m=r,s.c=n,s.d=function(e,t,r){s.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:r})},s.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},s.t=function(t,e){if(1&e&&(t=s(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var r=Object.create(null);if(s.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var n in t)s.d(r,n,function(e){return t[e]}.bind(null,n));return r},s.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return s.d(t,"a",t),t},s.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},s.p="",s(s.s=11)}({"./app/assets/es6/pages/form-elements.js":function(module,exports){eval("class FormElements {\r\n\r\n    static init() {\r\n        $('.select2').select2();\r\n        $('.datepicker-input').datepicker();\r\n\r\n        new Quill('#editor', {\r\n            theme: 'snow'\r\n        });\r\n    }\r\n}\r\n\r\n$(() => { FormElements.init(); });\r\n\r\n\n\n//# sourceURL=webpack:///./app/assets/es6/pages/form-elements.js?")},11:function(module,exports,__webpack_require__){eval('module.exports = __webpack_require__(/*! C:\\Users\\Nate\\Desktop\\themeforest selling\\Enlink-bootstrap\\v1.0.1\\demo\\app\\assets\\es6\\pages\\form-elements.js */"./app/assets/es6/pages/form-elements.js");\n\n\n//# sourceURL=webpack:///multi_./app/assets/es6/pages/form-elements.js?')}});