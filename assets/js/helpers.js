!function r(i,o,a){function u(n,e){if(!o[n]){if(!i[n]){var t="function"==typeof require&&require;if(!e&&t)return t(n,!0);if(c)return c(n,!0);throw(t=new Error("Cannot find module '"+n+"'")).code="MODULE_NOT_FOUND",t}t=o[n]={exports:{}},i[n][0].call(t.exports,function(e){return u(i[n][1][e]||e)},t,t.exports,r,i,o,a)}return o[n].exports}for(var c="function"==typeof require&&require,e=0;e<a.length;e++)u(a[e]);return u}({1:[function(e,n,t){"use strict";function i(e,n){e.hide(),n.attr("style","display:none")}Object.defineProperty(t,"__esModule",{value:!0}),t.showPageLoader=function(e,n){e.fadeIn("slow"),n.attr("style","display:block")},t.hideLoaderShowResponse=i,t.activateSpinner=function(e){e.attr("class","spin"),e.prop("disabled",!0)},t.deactivateSpinner=function(e){e.removeAttr("class","spin"),e.prop("disabled",!1)},t.retrieveFormValues=function(e){var t;return $.each($("input[name="+e+"], select[name="+e+"]"),function(e,n){n=$(n).val();t=n}),t},t.retrieveFormValues_Array=function(e){var t=new Array,r=0;return $.each($("input[name="+e+"], select[name="+e+"]"),function(e,n){n=$(n).val();t[r]=n,r++}),t},t.hideForm=function(e,n,t,r){e&&e.fadeOut(3e3,function(){i(n,t),e.fadeOut("fast"),r.attr("style","display:block")})}},{}]},{},[1]);
//# sourceMappingURL=helpers.js.map
