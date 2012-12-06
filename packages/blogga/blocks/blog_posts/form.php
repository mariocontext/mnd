<?php  defined('C5_EXECUTE') or die(_("Access Denied.")); $form = Loader::helper('form'); ?>

<ul id="ccm-posts-tabs" class="ccm-dialog-tabs">
    <li class="ccm-nav-active"><a id="posts-add" href="javascript:void(0);"><?php  echo ($bID>0)? t('Edit') : t('Add') ?></a></li>
    <li><a id="posts-rss"  href="javascript:void(0);"><?php  echo t('RSS Config')?></a></li>
    <li><a id="posts-blogs"  href="javascript:void(0);"><?php  echo t('Source')?></a></li>
</ul>

<div id="posts-addPane" class="ccm-postsPane" style="padding-top:10px;">
    <div class="ccm-block-field-group">
        <h2>Number of posts to show</h2>
        <?php  echo $form->text('num_posts_to_show',$num_posts_to_show,array('style'=>'width:20px;')) ?>
        &nbsp;<?php  echo $form->checkbox('paginate',1,$paginate); ?> Display Paging
    </div>

    <div class="ccm-block-field-group">
        <h2>Descriptions</h2>
        Show first <?php  echo $form->text('characters_to_display',$characters_to_display,array('style'=>'width:30px;')); ?> characters of description
    </div>

    <div class="ccm-block-field-group">
        <h2>Thumbnails</h2>
        <?php  echo $form->checkbox('show_thumbs',1,$show_thumbs); ?> Show preview thumbnail, if included<br />
        Maximum Width <?php  echo $form->text('max_thumb_width',$max_thumb_width,array('style'=>'width:30px;')); ?> px
    </div>

    <div class="ccm-block-field-group">
        <h2>Post Order</h2>
        <?php  echo $form->select('order_by',array('date_desc'=>'Date: Recent First','date_asc'=>'Date: Oldest First','title'=>'Post Title (A-Z)'),$order_by) ?>
    </div>
</div>

<div id="posts-rssPane" class="ccm-postsPane" style="padding-top:10px;display:none;">
    <div class="ccm-block-field-group">
        <h2>RSS Feed</h2>
        <?php  echo $form->checkbox('show_rss',1,$show_rss); ?> Make RSS feed available
    </div>

    <div id="rss-details"<?php  if(!$show_rss){echo ' style="display:none;"';} ?>>
        <div class="ccm-block-field-group">
            <strong>Feed Title</strong><br />
            <?php  echo $form->text('rss_title',$rss_title); ?><br /><br />

            <strong>Feed Description</strong><br />
            <?php  echo $form->textarea('rss_description',$rss_description,array('cols'=>'60','rows'=>'5')); ?>
        </div>
    </div>
</div>

<div id="posts-blogsPane" class="ccm-postsPane" style="padding-top:10px;display:none;">
    <div class="ccm-block-field-group">
        <h2>Display Posts From</h2>
        <p>Usually just leave this be. You should only use this if you are managing multiple blogs.</p>
        <p style="text-align:center;">
        <?php  Loader::model('page_list');
            $pl = new PageList();
            $pl->filterByAttribute('blogga_parent',true);
            $blogs['0'] = 'All Blogs';
            foreach($pl->get() as $b){
                $p = new Permissions($b); // only show blogs the user has permissions to edit!
                if($p->canWrite()){
                    $blogs[$b->getCollectionID()] = $b->getCollectionName();
                }
            }
            echo (count($blogs) > 1) ? $form->select('show_posts_from',$blogs,$show_posts_from) : '<a href="'.$this->url('/dashboard/blogga/manage_blogs').'">Create a blog first!</a>';
        ?>
        </p>
    </div>
</div>