$(document).ready(function() { $(".tooltip").simpletooltip(); });
(function($){ $.fn.simpletooltip = function(){
    return this.each(function() {
        var text = '';
        var tipWidth = '';
        if($(this).find('.popup').length) { text = $(this).find('.popup').html(); tipWidth = 200; } else { text = $(this).attr("title"); tipWidth = $("#tooltip").outerWidth(true); }
        $(this).attr("title", "");
        if(text != '') {
            $(this).hover(function(e){
                var tipX = e.pageX;
                var tipY = e.pageY + 20;
                $(this).attr("title", "").css({'cursor':'pointer'});
                $("body").append("<div id='tooltip' style='position: absolute; z-index: 11000; display: none;'>" + text + "<div style=\"display: none;\" class=\"body\"></div><div style=\"display: none;\" class=\"url\"></div></div>");
                $("#tooltip").width(tipWidth);
                $("#tooltip").css("left", tipX).css("top", tipY).fadeIn("medium");
            }, function(){
                $("#tooltip").remove();
                $(this).attr("title", text);
            });
            $(this).mousemove(function(e){
                var tipX = e.pageX;
                var tipY = e.pageY + 20;
                var tipHeight = $("#tooltip").outerHeight(true);
                if(tipX + tipWidth > $(window).scrollLeft() + $(window).width()) tipX = e.pageX - tipWidth;
                if($(window).height()+$(window).scrollTop() < tipY + tipHeight) tipY = e.pageY - tipHeight;
                $("#tooltip").css("left", tipX).css("top", tipY).fadeIn("medium");
            });
        }
    });
}})(jQuery);
