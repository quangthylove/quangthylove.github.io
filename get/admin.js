aspectResize = function() {
    var $aspect = $('div#media');
    var width = $aspect.width();
    $aspect.height(width/16*9);
};
$(document).ready(function() {
aspectResize();
		$(window).resize(aspectResize);
		});