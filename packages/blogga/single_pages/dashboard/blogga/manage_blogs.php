<?php  defined('C5_EXECUTE') or die(_("Access Denied."));
$ch = Loader::helper('categories','blogga');
$tch = Loader::helper('tags_categories','blogga');
?>

<h1><span><?php  echo t('Add a New Blog')?></span></h1>
<div class="ccm-dashboard-inner">
    <p id="blog-hmpg-setup">Give the blog a homepage: <strong><a href="javascript:void(0)" rel="new">Create a New Page</a></strong> | <strong><a href="javascript:void(0)" rel="existing">Choose an Existing Page</a></strong> ( <span style="font-weight:100;font-size:10px;"><a onclick="blogga.revealer('tip-newblog')">Help tip</a></span> )</p>
    <p id="tip-newblog" class="hider" style="margin-left:20px;color:#999;">For every blog that you have, you must assign it a homepage. This is necessary because <em>Blogga</em> allows you to have multiple blogs on your site.<br />
    The blog's homepage is used to list all of the blog's posts. If you choose 'Create a New Page', <em>Blogga</em> will set everything up for you automatically (<strong>recommended</strong>).<br />
    If you want to make an already existing page the blog's homepage, <strong>you'll have to add the <em>Blog Posts</em> block somewhere on that page</strong>.</p>
    <div id="hmpg-new" class="cTabContent hider">
        <form id="frm-create-new" method="post" action="<?php  echo $this->action('create_blog') ?>">
            <table  class="entry-form" border="0" cellspacing="1" cellpadding="0">
                <tr>
                    <td class="col-1 subheader">Name It</td>
                    <td style="width:100%;" width="100%">
                        <?php  echo $form->text('blog_name','My New Blog Title',array('class'=>'pretext','onFocus'=>'blogga.clearText(this)','style'=>'padding:3px;width:250px;')); ?>
                    </td>
                </tr>

                <tr>
                    <td class="col-1 subheader">Blog Description</td>
                    <td>
                        <?php  echo $form->textarea('blog_description','A little sumthin sumthin goes here...',array('cols'=>'70','rows'=>'6','class'=>'pretext','onFocus'=>'blogga.clearText(this)')); ?>
                    </td>
                </tr>

                <tr>
                    <td class="col-1 subheader">Where should it go?<br /><span style="font-weight:100;font-size:10px;"><a onclick="blogga.revealer('target-whereShouldGo')">Explain</a></span></td>
                    <td>
                        <?php  echo $form_page_selector->selectPage('blog_local',1); ?>
                        <div id="target-whereShouldGo" style="display:none;padding:8px 15px;color:#999;">
                            This is where your blog will be placed in your sitemap. By default, it'll just go under the homepage. If you want to put it somewhere else, simply pick the <em>parent page</em> (the page you want it to go under) here.
                            Unless you are managing multiple blogs, you probably won't need to do anything here.
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <div class="ccm-buttons">
                        <a href="javascript:void(0)" onclick="$('#frm-create-new').get(0).submit()" class="ccm-button-right accept" style="float:left;"><span><?php  echo t('Create Blog')?></span></a>
                        </div>
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <div id="hmpg-existing" class="cTabContent hider">
        <form id="frm-use-existing" method="post" action="<?php  echo $this->action('use_existing') ?>">
            <table class="entry-form" border="0" cellspacing="1" cellpadding="0">
                <tr>
                    <td class="col-1 subheader">Select Existing Page</td>
                    <td style="width:100%;" width="100%">
                        <?php  echo $form_page_selector->selectPage('blog_local',1); ?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <div class="ccm-buttons">
                        <a href="javascript:void(0)" onclick="$('#frm-use-existing').get(0).submit()" class="ccm-button-right accept" style="float:left;"><span><?php  echo t('Create Blog')?></span></a>
                        </div>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php 
    if(!empty($blogs)){
        $tabIndex = 1;
        foreach($blogs as $b){ ?>

            <?php  $pl = new PageList(); $pl->filterByAttribute('post_parent_blog_id',$b->getCollectionID()); $pl->filterByCollectionTypeHandle('blogga_page'); ?>
            <h1><span>Blog Title: <?php  echo t($b->getCollectionName()); ?></span></h1>
            <div class="ccm-dashboard-inner">
                <table class="entry-form" border="0" cellspacing="1" cellpadding="0">
                    <tr><td class="header">Owner</td><td width="100%"><?php  echo UserInfo::getByID($b->getCollectionUserID())->getUserName(); ?></td></tr>
                    <tr><td class="header">Posts</td><td width="100%"><?php  $posts = 0; foreach($pl->get() as $pg){ $posts++; } echo $posts; /*$b->getNumChildren();*/ ?></td></tr>
                    <tr><td class="header">Description</td><td width="100%"><?php  echo $b->getCollectionDescription(); ?></td></tr>
                    <tr>
                        <td colspan="3" class="subheader">Manage Blog Categories <span style="font-weight:200;">(To edit a category, just click the text)</span></td>
                    </tr>
                    <tr>
                        <td class="show-categories" colspan="3">
                            <div class="clearfix">
                                <?php 
                                    $key = CollectionAttributeKey::getByHandle('blogga_'.$b->getCollectionID().'_categories');
                                    $cats = $ch->getCategories($key);
                                    foreach($cats as $ctg){
                                        echo '<div class="cat-field">';
                                        //echo '<input name="category_'.$ctg['ID'].'" value="'.$ctg['value'].'" class="flatten" /><br />';
                                        echo '<span rel="category_'.$ctg['ID'].'">'.$tch->spaces($ctg['value']).'</span>';
                                        echo '<input id="category_'.$ctg['ID'].'" type="hidden" name="category_'.$ctg['ID'].'" value="'.$ctg['value'].'" />';
                                        echo '<img src="'.ASSETS_URL_IMAGES.'/throbber_white_16.gif" width="16" height="16" class="icn-loader" />';
                                        echo '<a class="cat-delete" rel="category_'.$ctg['ID'].'"><img src="'.ASSETS_URL_IMAGES.'/icons/close.png" class="btn-closer" alt="" /></a>';
                                        echo '</div>';
                                    }
                                ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <form method="post" action="<?php  echo $this->action('add_category'); ?>">
                                <input name="txt_add_category" tabindex="<?php  echo $tabIndex++; ?>" type="text" value="Category Name" class="pretext" onfocus="blogga.clearText(this)" />
                                &nbsp;<button tabindex="<?php  echo $tabIndex++; ?>" type="submit" name="submit">Add</button>
                                <input type="hidden" name="blog_id" value="<?php  echo $b->getCollectionID(); ?>" />
                            </form>
                        </td>
                    </tr>
                </table>
            </div>

<?php   }
    }
?>
            
<script type="text/javascript">
$(window).load(function(){
    blogga.siteRoot = '<?php  echo BASE_URL . DIR_REL; ?>';
    blogga.currentPage = '<?php  echo BASE_URL.$this->url(Page::getCurrentPage()->cPath) ?>';
    blogga.packageTools = '<?php  echo BLOGGA_TOOLS_DIR; ?>';
    blogga.defaults.init();
    blogga.manage.init();
})
</script>


