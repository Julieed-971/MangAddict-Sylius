import '../less/homepage.less';
import jQuery from 'jquery';

const $ = jQuery;

$(document).ready(function () {
    $(".switch-color").on('click', function() {
        const current_background_color = $('body').css('background-color')
        const current_font_color = $('body').css('color')
        $('body').css('background-color', current_font_color)
        $('body').css('color', current_background_color)
    })
  })