$(document).ready(function(){
    if ($('.mmb-infos').size() > 0) {
        $('.mmb-imageNav > li').bind('mouseenter',function() {
            var $infos = $(this).find('.mmb-infos');
            $height = $infos.height();
            $infos
                .stop(true)
                .animate({
                    top:-$height,
                    opacity:1
                    },400,'easeOutBack')
        }).bind('mouseleave',function() {
            var $t = $(this);
            $t.find('.mmb-infos')
                .stop(true)
                .animate({
                    'top':3,
                    opacity:0
                    },400,'easeOutBack')
        });
    }
});