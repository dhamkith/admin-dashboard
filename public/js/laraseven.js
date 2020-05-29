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
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
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

/***/ "./resources/js/laraseven.js":
/*!***********************************!*\
  !*** ./resources/js/laraseven.js ***!
  \***********************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _func_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./func.js */ "./resources/js/func.js");


(function IIFE() {
  "use strict";

  var windowHeight = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
  var windowWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
  /**
  * 
  * helper functions
  */

  function removeIsFrozenActive() {
    var $removeIsFrozen = _func_js__WEBPACK_IMPORTED_MODULE_0__["htmlcToArray"](document.getElementsByClassName('is-frozen'));
    var asideToggleMobile = document.getElementsByClassName('aside-toggle-mobile')[0];
    var menuToggle = document.getElementsByClassName('menu-toggle')[0];
    var isFrozenOverlay = document.getElementsByClassName('is-frozen-overlay')[0];

    if (asideToggleMobile.classList.contains('is-active') || menuToggle.classList.contains('is-active')) {
      if ($removeIsFrozen.length > 0) {
        $removeIsFrozen.forEach(function (el) {
          el.classList.add('is-frozen--active');
        });
      }

      isFrozenOverlay.classList.add('overlay--active');
    } else {
      if ($removeIsFrozen.length > 0) {
        $removeIsFrozen.forEach(function (el) {
          el.classList.remove('is-frozen--active');
        });
      }

      isFrozenOverlay.classList.remove('overlay--active');
    }
  } // if left menu open hide it


  function hideLeftMobileMenu() {
    var $isActiveAside = _func_js__WEBPACK_IMPORTED_MODULE_0__["htmlcToArray"](document.getElementsByClassName('aside-toggle-mobile'));

    if ($isActiveAside.length > 0) {
      $isActiveAside.forEach(function (el) {
        el.classList.remove('is-active');
        document.getElementsByClassName(el.dataset.target)[0].classList.remove('aside-open-mobile');
      });
    }
  } // if right menu open hide it


  function hideRightMobileMenu() {
    var $menuToggle = _func_js__WEBPACK_IMPORTED_MODULE_0__["htmlcToArray"](document.getElementsByClassName('menu-toggle'));

    if ($menuToggle.length > 0) {
      $menuToggle.forEach(function (el) {
        el.classList.remove('is-active');
        document.getElementById(el.dataset.target).classList.remove('is-active');
      });
    }
  } // Get all "menu-toggle" elements


  var $navbarBurgers = _func_js__WEBPACK_IMPORTED_MODULE_0__["htmlcToArray"](document.querySelectorAll('.menu-toggle')); // Check if there are any menu-toggle

  if ($navbarBurgers.length > 0) {
    // Add a click event on each of them
    $navbarBurgers.forEach(function (el) {
      el.addEventListener('click', function () {
        // is Left Mobile Menu open 
        hideLeftMobileMenu(); // Get the target from the "data-target" attribute

        var target = el.dataset.target;
        var $target = document.getElementById(target); // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"

        el.classList.toggle('is-active');
        $target.classList.toggle('is-active'); // is-frozen

        removeIsFrozenActive();
      });
    });
  } // is-mobile  "aside-toggle-mobile" aside toggle


  var $asideToggleMobile = _func_js__WEBPACK_IMPORTED_MODULE_0__["htmlcToArray"](document.querySelectorAll('.aside-toggle-mobile'));

  if ($asideToggleMobile.length > 0) {
    // Add a click event on each of them
    $asideToggleMobile.forEach(function (el) {
      el.addEventListener('click', function () {
        // is Right Mobile Menu open 
        hideRightMobileMenu(); // Get the target from the "data-target" attribute

        var target = el.dataset.target;
        var $target = document.getElementsByClassName(target)[0];
        el.classList.toggle('is-active');
        $target.classList.toggle('aside-open-mobile'); // is-frozen

        removeIsFrozenActive();
      });
    });
  } // Get all "has-dropdown-mobile" elements


  var $hasDropdownMobile = _func_js__WEBPACK_IMPORTED_MODULE_0__["htmlcToArray"](document.querySelectorAll('.has-dropdown-mobile')); // Check if there are any hasDropdownMobile

  if ($hasDropdownMobile.length > 0) {
    $hasDropdownMobile.forEach(function (el) {
      el.addEventListener('click', function () {
        el.nextElementSibling.classList.toggle('is-clickeble');
      });
    });
  } // Get all "has-submenu" elements


  var $asideHasSubmenu = _func_js__WEBPACK_IMPORTED_MODULE_0__["htmlcToArray"](document.querySelectorAll('.has-submenu')); // Check if there are any has-submenu

  if ($asideHasSubmenu.length > 0) {
    // Add a click event on each of them
    $asideHasSubmenu.forEach(function (el) {
      el.addEventListener('click', function () {
        // Toggle the " " class
        el.classList.toggle('open'); // Get  "<i>" element

        var hasFa = el.lastElementChild; // Check if there are any 'fa-compress' class

        if (hasFa.classList.contains('fa-compress')) {
          hasFa.classList.remove('fa-compress');
          hasFa.classList.add('fa-expand');
        } else {
          hasFa.classList.remove('fa-expand');
          hasFa.classList.add('fa-compress');
        }

        el.nextElementSibling.classList.toggle('toggle--on'); // Get all Sibling element

        var isSibling = _func_js__WEBPACK_IMPORTED_MODULE_0__["getSiblings"](el.parentElement);
        isSibling.forEach(function (el) {
          el.lastElementChild.classList.remove('toggle--on');
          el.firstElementChild.classList.remove('open'); // Get  "<i>" element

          var fa = el.firstElementChild.lastElementChild; // Check if there are any 'fa-expand' class

          if (fa.classList.contains('fa-expand')) {
            fa.classList.remove('fa-expand');
            fa.classList.add('fa-compress');
          }
        });
      });
    });
  }
  /**
  * 
  * dashboad content
  */
  // Get all "action-header-icon" elements action box dropdown


  var $actionHeaderIcon = _func_js__WEBPACK_IMPORTED_MODULE_0__["htmlcToArray"](document.querySelectorAll('.action-header-icon')); // Check if there are any actionHeaderIcon

  if ($actionHeaderIcon.length > 0) {
    $actionHeaderIcon.forEach(function (el) {
      el.addEventListener('click', function () {
        el.offsetParent.lastElementChild.classList.toggle('action-active');
        var isSibling = _func_js__WEBPACK_IMPORTED_MODULE_0__["getSiblings"](el.offsetParent);
        isSibling.forEach(function (el) {
          el.lastElementChild.classList.remove('action-active');
        });
        var parentSibling = _func_js__WEBPACK_IMPORTED_MODULE_0__["getSiblings"](el.offsetParent.parentElement);
        parentSibling.forEach(function (el) {
          for (var i = 0; i < el.children.length; i++) {
            if (el.classList) {
              for (var j = 0; j < el.childElementCount; j++) {
                el.firstElementChild.lastElementChild.classList.remove('action-active');
                var removeActionActiveClass = _func_js__WEBPACK_IMPORTED_MODULE_0__["getSiblings"](el.firstElementChild);
                removeActionActiveClass.forEach(function (el) {
                  el.lastElementChild.classList.remove('action-active');
                });
              }
            }
          }
        }); // if has action-active class 

        setTimeout(function () {
          var $actionDropdown = _func_js__WEBPACK_IMPORTED_MODULE_0__["htmlcToArray"](document.querySelectorAll('.action-dropdown'));

          if ($actionDropdown.length > 0) {
            $actionDropdown.forEach(function (el) {
              if (el.classList.contains('action-active')) {
                el.classList.remove('action-active');
              }
            });
          }
        }, 10000);
      });
    });
  } // Get all "setting-toggle" elements


  var $adminSettingToggle = _func_js__WEBPACK_IMPORTED_MODULE_0__["htmlcToArray"](document.querySelectorAll('.setting-toggle')); // Check if there are any adminSettingToggle

  if ($adminSettingToggle.length > 0) {
    $adminSettingToggle.forEach(function (el) {
      el.addEventListener('click', function () {
        el.nextElementSibling.classList.toggle('toggle-open');
        var siblings = _func_js__WEBPACK_IMPORTED_MODULE_0__["getSiblings"](el.parentNode);
        siblings.forEach(function (sibling) {
          if (sibling.classList.contains('admin-setting-wrap')) {
            if (sibling.lastElementChild.classList.contains('toggle-open')) {
              sibling.lastElementChild.classList.remove('toggle-open');
            }
          }
        });
      }, false);
    });
  }
  /*  
  *  get user login ips (import function)   
  */


  var loginIpsmodel = document.getElementById('get-userlogin-ips');

  if (loginIpsmodel) {
    loginIpsmodel.addEventListener('click', function () {
      _func_js__WEBPACK_IMPORTED_MODULE_0__["getUserLoginIps"](loginIpsmodel);
    }, false);
  }
  /*  
  * login form center
  */


  var $loginCutomize = _func_js__WEBPACK_IMPORTED_MODULE_0__["htmlcToArray"](document.querySelectorAll('.login-cutomize'));

  if ($loginCutomize.length > 0) {
    $loginCutomize.forEach(function (el) {
      if (windowHeight > el.clientHeight) {
        var marginTop = (windowHeight - el.clientHeight) / 2;
        el.style = "margin-top: ".concat(marginTop + 16, "px !important;");
      }
    });
  }
})();

/***/ }),

/***/ 2:
/*!*****************************************!*\
  !*** multi ./resources/js/laraseven.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! D:\xampp\htdocs\laraseven\blog\resources\js\laraseven.js */"./resources/js/laraseven.js");


/***/ })

/******/ });