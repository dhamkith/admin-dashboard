/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/func.js":
/*!******************************!*\
  !*** ./resources/js/func.js ***!
  \******************************/
/*! exports provided: getSiblings, htmlcToArray, getUserLoginIps */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "getSiblings", function() { return getSiblings; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "htmlcToArray", function() { return htmlcToArray; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "getUserLoginIps", function() { return getUserLoginIps; });
var baseUrl = location.protocol + '//' + location.host;
var windowHeight = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
var windowWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
var publicFunc = {
  /* -----------------------------------------------
  * helper function 
  * ------------------------------------------------
  */
  getChildren: function getChildren(n, skipMe) {
    var r = [];

    for (; n; n = n.nextSibling) {
      if (n.nodeType == 1 && n != skipMe) r.push(n);
    }

    return r;
  },
  getSiblings: function getSiblings(n) {
    return this.getChildren(n.parentNode.firstChild, n);
  },
  htmlcToArray: function htmlcToArray(htmlCollection) {
    return Array.prototype.slice.call(htmlCollection, 0);
  },

  /* 
  * 
  * get user login ids, helper function
  *
  */
  getUserLoginIps: function getUserLoginIps(el) {
    var _this = this;

    var userId = el.dataset.userid;
    var frag = document.createDocumentFragment();
    var appendElem = document.getElementById('append-modal');
    appendElem.innerHTML = '';
    axios.post("".concat(baseUrl, "/manage/api/user-id=").concat(userId, "/ips")).then(function (response) {
      var arrayData = response.data;

      _this.appendModel(frag, arrayData);

      appendElem.appendChild(frag);

      var $modalClose = _this.htmlcToArray(document.querySelectorAll('.m-close'));

      if ($modalClose.length > 0) {
        $modalClose.forEach(function (el) {
          _this.modelCloseEvent(el);
        });
      }
    })["catch"](function (_ref) {
      var response = _ref.response;
      console.log(response);
    });
  },

  /* 
  * 
  * append model fragment
  *
  */
  appendModel: function appendModel(frag, arrayData) {
    var fragLi = document.createDocumentFragment();
    arrayData.forEach(function (el) {
      var li = document.createElement('li');
      li.className = 'ip-list';
      var loginData = document.createTextNode("".concat(el.time, " --- Ip: ").concat(el.ip));
      li.appendChild(loginData);
      fragLi.appendChild(li);
    });
    var div1 = document.createElement('div');
    div1.id = 'is-active';
    div1.className = 'modal is-active';
    div1.style = "z-index: 9999;";
    var div2 = document.createElement('div');
    div2.className = 'modal-background';
    var div3 = document.createElement('div');
    div3.className = 'modal-card slide-down';
    var header = document.createElement('header');
    header.className = 'modal-card-head';
    var button1 = document.createElement('a');
    button1.className = 'delete is-danger m-close';
    button1.setAttribute('aria-label', "close");
    header.appendChild(button1);
    var section = document.createElement('section');
    section.className = 'modal-card-body';
    section.appendChild(fragLi);
    var footer = document.createElement('footer');
    footer.className = 'modal-card-foot';
    var cancel = document.createTextNode('close');
    var button2 = document.createElement('a');
    button2.className = 'button cancel is-danger is-outlined m-close';
    button2.appendChild(cancel);
    footer.appendChild(button2);
    div3.appendChild(footer);
    div3.insertBefore(section, footer);
    div3.insertBefore(header, section);
    div1.appendChild(div3);
    div1.insertBefore(div2, div3);
    frag.appendChild(div1);
  },

  /*
  *
  * modelCloseEvent function
  * 
  */
  modelCloseEvent: function modelCloseEvent(elem) {
    elem.addEventListener('click', function () {
      var isActive = document.getElementById('is-active');

      if (isActive.classList.contains('is-active')) {
        isActive.classList.remove('is-active');
      }
    }, false);
  }
};
function getSiblings(el) {
  return publicFunc.getSiblings(el);
}
;
function htmlcToArray(htmlCollection) {
  return publicFunc.htmlcToArray(htmlCollection);
}
;
function getUserLoginIps(el) {
  return publicFunc.getUserLoginIps(el);
}
;

/***/ }),

/***/ 1:
/*!************************************!*\
  !*** multi ./resources/js/func.js ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! D:\xampp\htdocs\laraseven\blog\resources\js\func.js */"./resources/js/func.js");


/***/ })

/******/ });