/*!
 * Lazy Load - JavaScript plugin for lazy loading images
 *
 * Copyright (c) 2007-2019 Mika Tuupola
 *
 * Licensed under the MIT license:
 *   http://www.opensource.org/licenses/mit-license.php
 *
 * Project home:
 *   https://appelsiini.net/projects/lazyload
 *
 * Version: 2.0.0-rc.2
 * Modified by rolle
 *
 */

(function (root, factory) {
  if (typeof exports === 'object') {
    module.exports = factory(root);
  } else if (typeof define === 'function' && define.amd) {
    define([], factory);
  } else {
    root.LazyLoad = factory(root);
  }
}(
  typeof global !== 'undefined' ? global : this.window || this.global,
  (root) => {
    if (typeof define === 'function' && define.amd) {
      root = window;
    }

    const defaults = {
      src: 'data-src',
      srcmobile: 'data-src-mobile',
      srcset: 'data-srcset',
      selector: '.lazyload',
      root: null,
      rootMargin: '0px',
      threshold: 0,
    };

    /**
     * Merge two or more objects. Returns a new object.
     * @private
     * @param {Boolean}  deep     If true, do a deep (or recursive) merge [optional]
     * @param {Object}   objects  The objects to merge together
     * @returns {Object}          Merged values of defaults and options
     */
    const extend = function () {
      const extended = {};
      let deep = false;
      let i = 0;
      const { length } = arguments;

      /* Check if a deep merge */
      if (Object.prototype.toString.call(arguments[0]) === '[object Boolean]') {
        deep = arguments[0];
        i++;
      }

      /* Merge the object into the extended object */
      const merge = function (obj) {
        for (const prop in obj) {
          if (Object.prototype.hasOwnProperty.call(obj, prop)) {
            /* If deep merge and property is an object, merge properties */
            if (
              deep
              && Object.prototype.toString.call(obj[prop]) === '[object Object]'
            ) {
              extended[prop] = extend(true, extended[prop], obj[prop]);
            } else {
              extended[prop] = obj[prop];
            }
          }
        }
      };

      /* Loop through each object and conduct a merge */
      for (; i < length; i++) {
        const obj = arguments[i];
        merge(obj);
      }

      return extended;
    };

    function LazyLoad(images, options) {
      this.settings = extend(defaults, options || {});
      this.images = images || document.querySelectorAll(this.settings.selector);
      this.observer = null;
      this.init();
    }

    LazyLoad.prototype = {
      init() {
        /* Without observers load everything and bail out early.
               This affects some iOS and Windows Phones */
        if (!root.IntersectionObserver) {
          this.loadImages();
          return;
        }

        const self = this;
        const observerConfig = {
          root: this.settings.root,
          rootMargin: this.settings.rootMargin,
          threshold: [this.settings.threshold],
        };

        this.observer = new IntersectionObserver(((entries) => {
          Array.prototype.forEach.call(entries, (entry) => {
            /* If inside viewport */
            if (entry.isIntersecting) {
              /* Define image */
              const img = entry.target;

              // img.classList.remove("preview");

              /* Add animation class to full-image div */
              if (
                typeof img.nextElementSibling !== 'undefined'
                && img.nextElementSibling != null
              ) {
                img.nextElementSibling.classList.add('reveal');
              }

              self.observer.unobserve(entry.target);
              const src = img.getAttribute(self.settings.src);
              const srcset = img.getAttribute(self.settings.srcset);
              const srcmobile = img.getAttribute(self.settings.srcmobile);

              /* Replace fully loaded original background image to the img src */
              if (img.tagName.toLowerCase() === 'img') {
                if (document.documentElement.clientWidth < 600) {
                  img.src = srcmobile;
                } else {
                  img.src = src;
                }
              } else {
                /* Add fully loaded original background image to next div element */
                if (document.documentElement.clientWidth < 600) {
                  img.nextElementSibling.style.backgroundImage = `url(${srcmobile})`;
                } else {
                  img.nextElementSibling.style.backgroundImage = `url(${src})`;
                }
              }
            }
          });
        }), observerConfig);

        Array.prototype.forEach.call(this.images, (image) => {
          self.observer.observe(image);
        });
      },

      loadAndDestroy() {
        if (!this.settings) {
          return;
        }
        this.loadImages();
        this.destroy();
      },

      loadImages() {
        if (!this.settings) {
          return;
        }

        const self = this;
        Array.prototype.forEach.call(this.images, (image) => {
          const src = image.getAttribute(self.settings.src);
          const srcset = image.getAttribute(self.settings.srcset);
          const srcmobile = image.getAttribute(self.settings.srcmobile);

          if (image.tagName.toLowerCase() === 'img') {
            if (src) {
              image.src = src;
            }
            if (srcset) {
              image.srcset = srcset;
            }
            if (srcmobile) {
              image.srcmobile = srcmobile;
            }
          } else if (document.documentElement.clientWidth < 600) {
            image.style.backgroundImage = `url('${srcmobile}')`;
          } else {
            image.style.backgroundImage = `url('${src}')`;
          }
        });
      },

      destroy() {
        if (!this.settings) {
          return;
        }
        this.observer.disconnect();
        this.settings = null;
      },
    };

    root.lazyload = function (images, options) {
      return new LazyLoad(images, options);
    };

    if (root.jQuery) {
      const $ = root.jQuery;
      $.fn.lazyload = function (options) {
        options = options || {};
        options.attribute = options.attribute || 'data-src';
        new LazyLoad($.makeArray(this), options);
        return this;
      };
    }

    return LazyLoad;
  },
));
