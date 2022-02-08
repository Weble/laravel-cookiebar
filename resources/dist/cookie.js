/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/helper.js":
/*!********************************!*\
  !*** ./resources/js/helper.js ***!
  \********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "hasClass": () => (/* binding */ hasClass)
/* harmony export */ });
function hasClass(element, cssClass) {
  return element.classList.contains(cssClass);
}

/***/ }),

/***/ "./node_modules/tiny-cookie/es/index.js":
/*!**********************************************!*\
  !*** ./node_modules/tiny-cookie/es/index.js ***!
  \**********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "isEnabled": () => (/* binding */ isEnabled),
/* harmony export */   "get": () => (/* binding */ get),
/* harmony export */   "getAll": () => (/* binding */ getAll),
/* harmony export */   "set": () => (/* binding */ set),
/* harmony export */   "getRaw": () => (/* binding */ getRaw),
/* harmony export */   "setRaw": () => (/* binding */ setRaw),
/* harmony export */   "remove": () => (/* binding */ remove),
/* harmony export */   "isCookieEnabled": () => (/* binding */ isEnabled),
/* harmony export */   "getCookie": () => (/* binding */ get),
/* harmony export */   "getAllCookies": () => (/* binding */ getAll),
/* harmony export */   "setCookie": () => (/* binding */ set),
/* harmony export */   "getRawCookie": () => (/* binding */ getRaw),
/* harmony export */   "setRawCookie": () => (/* binding */ setRaw),
/* harmony export */   "removeCookie": () => (/* binding */ remove)
/* harmony export */ });
/* harmony import */ var _util__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./util */ "./node_modules/tiny-cookie/es/util.js");
function _extends() { _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; }; return _extends.apply(this, arguments); }

 // Check if the browser cookie is enabled.

function isEnabled() {
  var key = '@key@';
  var value = '1';
  var re = new RegExp("(?:^|; )" + key + "=" + value + "(?:;|$)");
  document.cookie = key + "=" + value + ";path=/";
  var enabled = re.test(document.cookie);

  if (enabled) {
    // eslint-disable-next-line
    remove(key);
  }

  return enabled;
} // Get the cookie value by key.


function get(key, decoder) {
  if (decoder === void 0) {
    decoder = decodeURIComponent;
  }

  if (typeof key !== 'string' || !key) {
    return null;
  }

  var reKey = new RegExp("(?:^|; )" + (0,_util__WEBPACK_IMPORTED_MODULE_0__.escapeRe)(key) + "(?:=([^;]*))?(?:;|$)");
  var match = reKey.exec(document.cookie);

  if (match === null) {
    return null;
  }

  return typeof decoder === 'function' ? decoder(match[1]) : match[1];
} // The all cookies


function getAll(decoder) {
  if (decoder === void 0) {
    decoder = decodeURIComponent;
  }

  var reKey = /(?:^|; )([^=]+?)(?:=([^;]*))?(?:;|$)/g;
  var cookies = {};
  var match;
  /* eslint-disable no-cond-assign */

  while (match = reKey.exec(document.cookie)) {
    reKey.lastIndex = match.index + match.length - 1;
    cookies[match[1]] = typeof decoder === 'function' ? decoder(match[2]) : match[2];
  }

  return cookies;
} // Set a cookie.


function set(key, value, encoder, options) {
  if (encoder === void 0) {
    encoder = encodeURIComponent;
  }

  if (typeof encoder === 'object' && encoder !== null) {
    /* eslint-disable no-param-reassign */
    options = encoder;
    encoder = encodeURIComponent;
    /* eslint-enable no-param-reassign */
  }

  var attrsStr = (0,_util__WEBPACK_IMPORTED_MODULE_0__.convert)(options || {});
  var valueStr = typeof encoder === 'function' ? encoder(value) : value;
  var newCookie = key + "=" + valueStr + attrsStr;
  document.cookie = newCookie;
} // Remove a cookie by the specified key.


function remove(key, options) {
  var opts = {
    expires: -1
  };

  if (options) {
    opts = _extends({}, options, opts);
  }

  return set(key, 'a', opts);
} // Get the cookie's value without decoding.


function getRaw(key) {
  return get(key, null);
} // Set a cookie without encoding the value.


function setRaw(key, value, options) {
  return set(key, value, null, options);
}



/***/ }),

/***/ "./node_modules/tiny-cookie/es/util.js":
/*!*********************************************!*\
  !*** ./node_modules/tiny-cookie/es/util.js ***!
  \*********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "hasOwn": () => (/* binding */ hasOwn),
/* harmony export */   "escapeRe": () => (/* binding */ escapeRe),
/* harmony export */   "computeExpires": () => (/* binding */ computeExpires),
/* harmony export */   "convert": () => (/* binding */ convert)
/* harmony export */ });
function hasOwn(obj, key) {
  return Object.prototype.hasOwnProperty.call(obj, key);
} // Escape special characters.


function escapeRe(str) {
  return str.replace(/[.*+?^$|[\](){}\\-]/g, '\\$&');
} // Return a future date by the given string.


function computeExpires(str) {
  var lastCh = str.charAt(str.length - 1);
  var value = parseInt(str, 10);
  var expires = new Date();

  switch (lastCh) {
    case 'Y':
      expires.setFullYear(expires.getFullYear() + value);
      break;

    case 'M':
      expires.setMonth(expires.getMonth() + value);
      break;

    case 'D':
      expires.setDate(expires.getDate() + value);
      break;

    case 'h':
      expires.setHours(expires.getHours() + value);
      break;

    case 'm':
      expires.setMinutes(expires.getMinutes() + value);
      break;

    case 's':
      expires.setSeconds(expires.getSeconds() + value);
      break;

    default:
      expires = new Date(str);
  }

  return expires;
} // Convert an object to a cookie option string.


function convert(opts) {
  var res = ''; // eslint-disable-next-line

  for (var key in opts) {
    if (hasOwn(opts, key)) {
      if (/^expires$/i.test(key)) {
        var expires = opts[key];

        if (typeof expires !== 'object') {
          expires += typeof expires === 'number' ? 'D' : '';
          expires = computeExpires(expires);
        }

        res += ";" + key + "=" + expires.toUTCString();
      } else if (/^secure$/.test(key)) {
        if (opts[key]) {
          res += ";" + key;
        }
      } else {
        res += ";" + key + "=" + opts[key];
      }
    }
  }

  if (!hasOwn(opts, 'path')) {
    res += ';path=/';
  }

  return res;
}



/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!********************************!*\
  !*** ./resources/js/cookie.js ***!
  \********************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var tiny_cookie__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tiny-cookie */ "./node_modules/tiny-cookie/es/index.js");
/* harmony import */ var _helper__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./helper */ "./resources/js/helper.js");



window.cookiebar = function () {
  return {
    config: {},
    configure: configure,
    init: init,
    setupTemplate: setupTemplate,
    loadGTM: loadGTM
  };
}(); // 1


function configure(config) {
  Object.assign(this.config, config);
  return this;
} // 2


function init() {
  window.dataLayer = window.dataLayer || [];

  if (typeof gtag === 'undefined') {
    var _gtag = function _gtag() {
      dataLayer.push(arguments);
    };

    window.gtag = window.gtag || _gtag;
  }

  gtag('consent', 'default', this.config.gtag_consent);
  return this;
} // 3


function setupTemplate() {
  var _this = this;

  // update
  _addClickTo('[data-cookiebar="update-consent"]', function (event) {
    return _updateConsent(event, _this.config);
  }); // show modal


  _addClickTo('[data-cookiebar="modal-show"]', function () {
    return console.log('modal-show');
  }); // hide modal


  _addClickTo('[data-cookiebar="modal-hide"]', function () {
    return console.log('modal-hide');
  });

  return this;
} // 4


function loadGTM() {
  if (!this.config.gtm_code) {
    return;
  }

  (function (w, d, s, l, i) {
    w[l] = w[l] || [];
    w[l].push({
      'gtm.start': new Date().getTime(),
      event: 'gtm.js'
    });
    var f = d.getElementsByTagName(s)[0],
        j = d.createElement(s),
        dl = l != 'dataLayer' ? '&l=' + l : '';
    j.async = true;
    j.src = 'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
    f.parentNode.insertBefore(j, f);
  })(window, document, 'script', 'dataLayer', this.config.gtm_code);

  return this;
}

function _updateConsent(event, config) {
  var target = event.target;
  var advanced_cookie_name = config.advanced_cookie_name,
      expirationInDays = config.expirationInDays,
      gtag_consent = config.gtag_consent; // AGREE: all consents granted

  if ((0,_helper__WEBPACK_IMPORTED_MODULE_1__.hasClass)(target, 'js-cookiebar-agree')) {
    Object.keys(gtag_consent).forEach(function (key) {
      gtag_consent[key] = 'granted';
    });
  } // DISMISS: all consents denied


  if ((0,_helper__WEBPACK_IMPORTED_MODULE_1__.hasClass)(target, 'js-cookiebar-dismiss')) {
    Object.keys(gtag_consent).forEach(function (key) {
      gtag_consent[key] = 'danied';
    });
  }

  (0,tiny_cookie__WEBPACK_IMPORTED_MODULE_0__.setCookie)(advanced_cookie_name, JSON.stringify(gtag_consent), {
    expires: expirationInDays
  });
  gtag('consent', 'update', gtag_consent);
  dataLayer.push({
    'event': 'cookie_advanced_consent_updated'
  });
  dataLayer.push({
    'event': 'gtm.init_consent'
  });
}

function _addClickTo(selector, cb) {
  var elements = document.querySelectorAll(selector);

  if (elements.length <= 0) {
    return;
  }

  elements.forEach(function (button) {
    return button.addEventListener("click", cb);
  });
}
})();

/******/ })()
;