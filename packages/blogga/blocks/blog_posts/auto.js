
var blog_posts = {

    init:function(){
        this.tab_setup();

        $('#show_rss').bind('click',function(e){
            $('#rss-details').slideToggle();
        })

        $('#show_thumbs').click(function(){
            if(!$(this).is(':checked')){
                $('#max_thumb_width').attr('disabled','disabled');
            }else{
                $('#max_thumb_width').removeAttr('disabled');
            }
        })
    },
    
    tab_setup:function(){
        $('li > a','ul#ccm-posts-tabs').click(function(){
            var target = $('#'+$(this).attr('id')+'Pane');

            $('.ccm-nav-active').removeClass('ccm-nav-active');
            $(this).parent('li').addClass('ccm-nav-active');

            $('.ccm-postsPane').hide();
            target.show();
        })
    }

}

blog_posts.init();

