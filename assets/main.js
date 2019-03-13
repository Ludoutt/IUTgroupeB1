const $ = require('jquery');

require('bootstrap');
require('./scss/main.scss');

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
});


console.log('App run well');
