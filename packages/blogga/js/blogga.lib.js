


var blogga = {

    siteRoot: null, currentPage:null, packageTools:null,
    clearText: function(el){ // instead of setting up global listener, put an onClick event to fire this on each input
        if(!$(el).hasClass('flagClicked')){ $(el).val('').removeClass('pretext').addClass('flagClicked'); }
    },
    revealer:function(targ){
        $('#'+targ).slideToggle(150);
    },
    defaults: {
        init:function(){
            // nothing here yet
        }
    },

    add_posts:{
        init:function(){
            $('#blog_id').bind('change click',function(e){
                var targ = $(e.target),
                    bID  = targ.val();

                if(e.type=='change' && targ.is(':input')){
                    if(bID){
                        $.post(blogga.packageTools+'load_categories',{blogID:bID},
                        function(d){
                            $('#show-categories').empty().append(d);
                        })
                    }else{
                        $('#show-categories').empty()
                    }
                }
            })

            var qry_field = $('#blogga-tags'),
                akID      = $('#tags_akID').val();
            $(function(){
                qry_field.autocomplete({
                    serviceUrl: blogga.packageTools+'tags',
                    minChars:2,
                    width:500,
                    params:{axn:'get_tags'},
                    noCache:true,
                    onSelect: function(v,d){
                        $('#tag-holder').append('<li>'+v+'<a class="tag-clear" title="Remove tag"></a><input type="hidden" name="akID['+akID+'][atSelectOptionID][]" value="'+d+'" /></li>');
                        qry_field.val('');
                    }
                });
            });

            $('#make-tag').click(function(){
                if(qry_field.val().length >= 3){
                    $.post(blogga.packageTools+'tags',{axn:'make_tags',query:qry_field.val()},
                    function(d){
                        $('#tag-holder').append('<li>'+qry_field.val()+'<a class="tag-clear" title="Remove tag"></a><input type="hidden" name="akID['+akID+'][atSelectOptionID][]" value="'+d+'" /></li>');
                        qry_field.val('');
                    })
                }else{
                    alert('New tags must be a minimum of 4 characters')
                }
            })

            $('.tag-clear').live('click',function(){
                $(this).parent('li').remove();
            })
        }
    },

    manage:{
        init:function(){
            $('a','#blog-hmpg-setup').click(function(){
                // super shitty way of class switching... but works
                $('.highlight').removeClass('highlight');
                $(this).toggleClass('highlight');
                $('.cTabContent').hide();
                $('#hmpg-'+$(this).attr('rel')).show();
            })

            // inline editable fields stuff
            $('span','.cat-field').live('click',function(){
                var val   = $(this).text(),
                    field = $('<input name="'+$(this).attr('rel')+'" value="'+val+'" />');

                $(this).replaceWith(field);

                field.focus().blur(function(){ // $(this) is now scoped to 'field' var
                    var targ     = $(this).attr('name'),
                        inputVal = $(this).val(),
                        rplcFld  = $('<span rel="'+targ+'">'+inputVal+'</span>');

                    $(this).replaceWith( rplcFld );
                    var loader   = rplcFld.siblings('.icn-loader');
                    loader.show(); // show waiting spinner

                    $.post(
                        blogga.currentPage+'update_category',
                        {id:targ,text:inputVal},
                        function(d){
                            rplcFld.effect('highlight',800);
                            loader.hide();
                        }
                    )
                })
            })

            $('a.cat-delete').click(function(){
                var doDelete = confirm('Really delete this category?'),
                    targ    = $(this);
                if(doDelete){
                    $.post(blogga.currentPage+'delete_category',{id:targ.attr('rel')},
                    function(){ targ.parent('div.cat-field').fadeOut() });
                }
            })
        },
        sitemap:function(cID){
            //console.log(cID);
        }
    }
}


