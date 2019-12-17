/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
require('../scss/app.scss');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
require('jquery')
require('popper.js')
require('bootstrap')
require('perfect-scrollbar')
require("./template/off-canvas.js");
require("./template/hoverable-collapse.js");
require("./template/misc.js");


(function($) {
    'use strict';
    $(function() {
        $("body").tooltip({ selector: '[data-toggle=tooltip]' });
    });
  })(jQuery);