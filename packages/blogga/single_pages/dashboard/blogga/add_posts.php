<?php  defined('C5_EXECUTE') or die(_("Access Denied.")); Loader::model('/attribute/categories/collection'); ?>

<?php  //if ($this->controller->getTask() == 'save_and_preview') { ?>

<h1><span><?php  echo t('Add Posts')?></span></h1>

<form id="frm-add-post" method="post" action="<?php  echo $this->action('add_post') ?>">
    <div class="ccm-dashboard-inner">
        <h2>Select a Blog</h2>

        <table class="entry-form" border="0" cellspacing="1" cellpadding="0">
            <!--<tr>
                <td class="header" style="white-space:nowrap;">Blog Name</td>
                <td class="header">Owner</td>
            </tr>-->

            <tr>
                <td class="subheader" style="white-space:nowrap;">Pick a blog <span style="color:red;">*</span></td>
                <td style="width:100%;" width="100%"><?php  echo (count($blogs) > 1) ? $form->select('blog_id',$blogs) : '<a href="'.$this->url('/dashboard/blogga/manage_blogs').'">Create a blog first!</a>'; ?></td>
            </tr>

            <tr>
                <td class="subheader" style="white-space:nowrap;">Post Title <span style="color:red;">*</span></td>
                <td><?php  echo $form->text('post_title','',array('class'=>'pretext','onFocus'=>'blogga.clearText(this)','style'=>'width:300px;')); ?></td>
            </tr>

            <tr>
                <td class="subheader" style="white-space:nowrap;">Post Description</td>
                <td><?php  echo $form->textarea('post_description','',array('cols'=>'70','rows'=>'6','class'=>'pretext','onFocus'=>'blogga.clearText(this)')); ?></td>
            </tr>

            <tr>
                <td class="subheader" style="white-space:nowrap;">Categories</td>
                <td>
                <div id="show-categories" class="clearfix">
                    Pick a blog to see its categories<!-- loaded via ajax -->
                </div>
                <?php  // echo $form->text('add_category','',array('class'=>'pretext','onFocus'=>'blogga.clearText(this)','style'=>'padding:3px;display:none;')); ?>
                </td>
            </tr>

            <tr>
                <td class="subheader">Tags</td>
                <td>
                    <ul id="tag-holder"><!--appended via ajax --></ul>
                    <?php  echo $form->text('blogga-tags','Start typing tags in here',array('class'=>'pretext','onFocus'=>'blogga.clearText(this)','style'=>'margin-top:5px;')); ?>
                    <a id="make-tag" href="javascript:void(0)">Make new tag</a>
                    <input type="hidden" id="tags_akID" value="<?php  echo $tag_akID; ?>" />
                </td>
            </tr>

            <tr>
                <td class="subheader" style="white-space:nowrap;">Post Preview Image</td>
                <td>
                    <?php 
                        $al = Loader::helper('concrete/asset_library');
                        echo $al->image('post_preview_image','post_preview_image','Choose an Image');
                    ?>
                </td>
            </tr>

            <tr>
                <td></td>
                <td>
                    <div class="ccm-buttons">
                    <a href="javascript:void(0)" onclick="$('#frm-add-post').get(0).submit()" class="ccm-button-right accept" style="float:left;"><span><?php  echo t('Create Post')?></span></a>
                    </div>
                    <p style="margin:8px 0 0 100px;"><?php  echo $form->radio('enable_comments',1,1); ?> Allow Comments <?php  echo $form->radio('enable_comments',0); ?> No Comments</p>
                </td>
            </tr>

        </table>

    </div>
</form>

<script type="text/javascript">
$(window).load(function(){
    blogga.siteRoot = '<?php  echo BASE_URL . DIR_REL; ?>';
    blogga.currentPage = '<?php  echo BASE_URL.$this->url(Page::getCurrentPage()->cPath) ?>';
    blogga.packageTools = '<?php  echo BLOGGA_TOOLS_DIR; ?>';
    blogga.defaults.init();
    blogga.add_posts.init();
})
</script>
<?php  //} ?>