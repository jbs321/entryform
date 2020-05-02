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
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
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
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 10);
/******/ })
/************************************************************************/
/******/ ({

/***/ 10:
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(11);
module.exports = __webpack_require__(36);


/***/ }),

/***/ 11:
/***/ (function(module, exports, __webpack_require__) {


/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');
__webpack_require__(35);

/***/ }),

/***/ 35:
/***/ (function(module, exports) {

window.fancybox = {};
window.fancybox.defaults = {
  // Close existing modals
  // Set this to false if you do not need to stack multiple instances
  closeExisting: false,

  // Enable infinite gallery navigation
  loop: false,

  // Horizontal space between slides
  gutter: 50,

  // Enable keyboard navigation
  keyboard: true,

  // Should allow caption to overlap the content
  preventCaptionOverlap: true,

  // Should display navigation arrows at the screen edges
  arrows: true,

  // Should display counter at the top left corner
  infobar: true,

  // Should display close button (using `btnTpl.smallBtn` template) over the content
  // Can be true, false, "auto"
  // If "auto" - will be automatically enabled for "html", "inline" or "ajax" items
  smallBtn: 'auto',

  // Should display toolbar (buttons at the top)
  // Can be true, false, "auto"
  // If "auto" - will be automatically hidden if "smallBtn" is enabled
  toolbar: 'auto',

  // What buttons should appear in the top right corner.
  // Buttons will be created using templates from `btnTpl` option
  // and they will be placed into toolbar (class="fancybox-toolbar"` element)
  buttons: ['thumbs',
  // "share",
  'slideShow',
  // "fullScreen",
  'zoom', "download", 'close'],

  // Detect "idle" time in seconds
  idleTime: 3,

  // Disable right-click and use simple image protection for images
  protect: false,

  // Shortcut to make content "modal" - disable keyboard navigtion, hide buttons, etc
  modal: false,

  image: {
    // Wait for images to load before displaying
    //   true  - wait for image to load and then display;
    //   false - display thumbnail and load the full-sized image over top,
    //           requires predefined image dimensions (`data-width` and `data-height` attributes)
    preload: false
  },

  ajax: {
    // Object containing settings for ajax request
    settings: {
      // This helps to indicate that request comes from the modal
      // Feel free to change naming
      data: {
        fancybox: true
      }
    }
  },

  // Default content type if cannot be detected automatically
  defaultType: 'image',

  // Open/close animation type
  // Possible values:
  //   false            - disable
  //   "zoom"           - zoom images from/to thumbnail
  //   "fade"
  //   "zoom-in-out"
  //
  animationEffect: 'zoom',

  // Duration in ms for open/close animation
  animationDuration: 366,

  // Should image change opacity while zooming
  // If opacity is "auto", then opacity will be changed if image and thumbnail have different aspect ratios
  zoomOpacity: 'auto',

  // Transition effect between slides
  //
  // Possible values:
  //   false            - disable
  //   "fade'
  //   "slide'
  //   "circular'
  //   "tube'
  //   "zoom-in-out'
  //   "rotate'
  //
  transitionEffect: 'fade',

  // Duration in ms for transition animation
  transitionDuration: 366,

  // Custom CSS class for slide element
  slideClass: '',

  // Custom CSS class for layout
  baseClass: '',

  caption: function caption(instance, item) {
    var caption = $(this).data('caption') || '';

    console.log(caption);

    if (item.type === 'image') {
      caption = (caption.length ? caption + '<br />' : '') + '<a href="' + item.src + '">Download image</a>';
    }

    return caption;
  },

  // Base template for layout
  baseTpl: '<div class="fancybox-container" role="dialog" tabindex="-1">' + '<div class="fancybox-bg"></div>' + '<div class="fancybox-inner">' + '<div class="fancybox-infobar"><span data-fancybox-index></span>&nbsp;/&nbsp;<span data-fancybox-count></span></div>' + '<div class="fancybox-toolbar">{{buttons}}</div>' + '<div class="fancybox-navigation">{{arrows}}</div>' + '<div class="fancybox-stage"></div>' + '<div class="fancybox-caption"><div class=""fancybox-caption__body"></div></div>' + '</div>' + '</div>',

  // Loading indicator template
  spinnerTpl: '<div class="fancybox-loading"></div>',

  // Error message template
  errorTpl: '<div class="fancybox-error"><p>{{ERROR}}</p></div>',

  btnTpl: {
    download: '<a download data-fancybox-download class="fancybox-button fancybox-button--download" title="{{DOWNLOAD}}" href="javascript:;">' + '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M18.62 17.09V19H5.38v-1.91zm-2.97-6.96L17 11.45l-5 4.87-5-4.87 1.36-1.32 2.68 2.64V5h1.92v7.77z"/></svg>' + '</a>',

    zoom: '<button data-fancybox-zoom class="fancybox-button fancybox-button--zoom" title="{{ZOOM}}">' + '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M18.7 17.3l-3-3a5.9 5.9 0 0 0-.6-7.6 5.9 5.9 0 0 0-8.4 0 5.9 5.9 0 0 0 0 8.4 5.9 5.9 0 0 0 7.7.7l3 3a1 1 0 0 0 1.3 0c.4-.5.4-1 0-1.5zM8.1 13.8a4 4 0 0 1 0-5.7 4 4 0 0 1 5.7 0 4 4 0 0 1 0 5.7 4 4 0 0 1-5.7 0z"/></svg>' + '</button>',

    close: '<button data-fancybox-close class="fancybox-button fancybox-button--close" title="{{CLOSE}}">' + '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 10.6L6.6 5.2 5.2 6.6l5.4 5.4-5.4 5.4 1.4 1.4 5.4-5.4 5.4 5.4 1.4-1.4-5.4-5.4 5.4-5.4-1.4-1.4-5.4 5.4z"/></svg>' + '</button>',

    // Arrows
    arrowLeft: '<button data-fancybox-prev class="fancybox-button fancybox-button--arrow_left" title="{{PREV}}">' + '<div><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M11.28 15.7l-1.34 1.37L5 12l4.94-5.07 1.34 1.38-2.68 2.72H19v1.94H8.6z"/></svg></div>' + '</button>',

    arrowRight: '<button data-fancybox-next class="fancybox-button fancybox-button--arrow_right" title="{{NEXT}}">' + '<div><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M15.4 12.97l-2.68 2.72 1.34 1.38L19 12l-4.94-5.07-1.34 1.38 2.68 2.72H5v1.94z"/></svg></div>' + '</button>',

    // This small close button will be appended to your html/inline/ajax content by default,
    // if "smallBtn" option is not set to false
    smallBtn: '<button type="button" data-fancybox-close class="fancybox-button fancybox-close-small" title="{{CLOSE}}">' + '<svg xmlns="http://www.w3.org/2000/svg" version="1" viewBox="0 0 24 24"><path d="M13 12l5-5-1-1-5 5-5-5-1 1 5 5-5 5 1 1 5-5 5 5 1-1z"/></svg>' + '</button>'
  },

  // Container is injected into this element
  parentEl: 'body',

  // Hide browser vertical scrollbars; use at your own risk
  hideScrollbar: true,

  // Focus handling
  // ==============

  // Try to focus on the first focusable element after opening
  autoFocus: true,

  // Put focus back to active element after closing
  backFocus: true,

  // Do not let user to focus on element outside modal content
  trapFocus: true,

  // Module specific options
  // =======================

  fullScreen: {
    autoStart: true
  },

  // Set `touch: false` to disable panning/swiping
  touch: {
    vertical: true, // Allow to drag content vertically
    momentum: true // Continue movement after releasing mouse/touch when panning
  },

  // Hash value when initializing manually,
  // set `false` to disable hash change
  hash: null,

  // Customize or add new media types
  // Example:
  /*
    media : {
      youtube : {
        params : {
          autoplay : 0
        }
      }
    }
  */
  media: {},

  slideShow: {
    autoStart: false,
    speed: 3000
  },

  thumbs: {
    autoStart: true, // Display thumbnails on opening
    // hideOnClose: true, // Hide thumbnail grid when closing animation starts
    // parentEl: '.fancybox-container', // Container is injected into this element
    axis: 'y' // Vertical (y) or horizontal (x) scrolling
  },

  // Use mousewheel to navigate gallery
  // If 'auto' - enabled for images only
  wheel: 'auto',

  // Callbacks
  //==========

  // See Documentation/API/Events for more information
  // Example:
  /*
    afterShow: function( instance, current ) {
      console.info( 'Clicked element:' );
      console.info( current.opts.$orig );
    }
  */

  onInit: $.noop, // When instance has been initialized

  beforeLoad: $.noop, // Before the content of a slide is being loaded
  afterLoad: $.noop // When the content of a slide is done loading
};

/***/ }),

/***/ 36:
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ })

/******/ });