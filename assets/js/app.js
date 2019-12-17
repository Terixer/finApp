/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.scss');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
// const $ = require('jquery');
require("jquery");
require("../vendors/js/vendor.bundle.base.js");
require("./template/off-canvas.js");
require("./template/hoverable-collapse.js");
require("./template/misc.js");


console.log('Hello Webpack Encore!');