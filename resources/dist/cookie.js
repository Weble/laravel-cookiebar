/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/cookie.js":
/*!********************************!*\
  !*** ./resources/js/cookie.js ***!
  \********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

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
  // initialize GTM
  window.dataLayer = window.dataLayer || [];

  if (typeof gtag === 'undefined') {
    var _gtag = function _gtag() {
      dataLayer.push(arguments);
    };

    window.gtag = window.gtag || _gtag;
  }

  var cookie = JSON.parse((0,tiny_cookie__WEBPACK_IMPORTED_MODULE_0__.getCookie)(this.config.advanced_cookie_name)); // default consent

  if (!cookie) {
    gtag('consent', 'default', this.config.gtag_consent);
    return this;
  } // update consent


  Object.assign(this.config.gtag_consent, cookie);

  _updateConsent(this.config);

  return this;
} // 3


function setupTemplate() {
  var _this = this;

  // update
  _addClickTo('[data-cookiebar="update-consent"]', function (event) {
    return _updateConsentEvent(event, _this.config);
  }); // show modal


  _addClickTo('[data-cookiebar="modal-show"]', function () {
    return _showModal(_this.config.gtag_consent);
  }); // hide modal


  _addClickTo('[data-cookiebar="modal-hide"]', function () {
    return _hide(document.getElementById('cookiebar-modal'));
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

function _updateConsentEvent(event, config) {
  var target = event.target;
  var gtag_consent = config.gtag_consent; // AGREE: all consents granted

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

  if ((0,_helper__WEBPACK_IMPORTED_MODULE_1__.hasClass)(target, 'js-cookiebar-custom')) {
    Object.keys(gtag_consent).forEach(function (key) {
      var checkbox = document.getElementById(key);

      if (!checkbox) {
        return;
      }

      if (checkbox.checked) {
        gtag_consent[key] = 'granted';
      }

      if (!checkbox.checked) {
        gtag_consent[key] = 'denied';
      }
    });
  }

  _updateConsent(config);
}

function _updateConsent(config) {
  var advanced_cookie_name = config.advanced_cookie_name,
      expirationInDays = config.expirationInDays,
      gtag_consent = config.gtag_consent;
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

  _hide(document.getElementById('cookiebar-banner'));

  _hide(document.getElementById('cookiebar-modal'));
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

function _hide(el) {
  if (!el) {
    return;
  }

  el.style.display = "none";
}

function _show(el) {
  if (!el) {
    return;
  }

  el.style.display = "block";
}

function _showModal(consents) {
  // check consent
  Object.keys(consents).forEach(function (key) {
    var checkbox = document.getElementById(key);

    if (!checkbox) {
      return;
    }

    checkbox.checked = consents[key] === 'granted';
  });

  _show(document.getElementById('cookiebar-modal'));
}

/***/ }),

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

/***/ "./resources/css/cookie.css":
/*!**********************************!*\
  !*** ./resources/css/cookie.css ***!
  \**********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


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
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
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
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/resources/dist/cookie": 0,
/******/ 			"resources/dist/cookie": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunklaravel_cookiebar"] = self["webpackChunklaravel_cookiebar"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["resources/dist/cookie"], () => (__webpack_require__("./resources/js/cookie.js")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["resources/dist/cookie"], () => (__webpack_require__("./resources/css/cookie.css")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;