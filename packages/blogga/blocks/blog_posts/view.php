<?php  defined('C5_EXECUTE') or die(_("Access Denied."));
$v = View::getInstance();
$themePath = $v->getThemePath();
$tch = Loader::helper('tags_categories','blogga');
$nh = Loader::helper('navigation');
$html = Loader::helper('html');

$res = $pl->getPage();

if($controller->show_rss) {
    $btID = $b->getBlockTypeID();
    $bt = BlockType::getByID($btID);
    $rssUrl = $controller->getRssUrl($b);
    ?>
    <div class="blogga-rss">
        <a href="<?php  echo $rssUrl; ?>" target="_blank"><img src="<?php  echo Loader::helper('concrete/urls')->getBlockTypeAssetsURL($bt, 'gfx/rss.png')?>" width="14" height="14" /> <span class="subscribe-text">Subscribe</span></a>
        <link href="<?php  echo $rssUrl; ?>" rel="alternate" type="application/rss+xml" title="<?php  echo $controller->rssTitle; ?>" />
    </div>
<?php 
}

if(empty($res)){
    echo '<div class="entry"><h3>No blog posts were found.</h3></div>';
}else{

    if(isset($_GET['tags'])){
        echo '<div class="blogga-search-tags">';
        echo 'Narrow By Tag: <a href="'.$nh->getCollectionURL(Page::getCurrentPage()).'" class="tag"><span class="left"></span>'.$_GET['tags'].'<span class="right"></span></a>';
        echo '</div>';
    }

    //echo $this->getBlockURL();

    foreach($res as $b){ // this is the "posts loop" per say... all your wordpress folks

        /*---------------GENERAL PAGE SETUP STUFF--------------------------- */
        $blogParentID   = $b->getAttribute('post_parent_blog_id');
        $targetPageURL  = $nh->getCollectionURL(Page::getByID($blogParentID));
        $categories     = $tch->getCategories( $b->getAttribute('blogga_'.$blogParentID.'_categories'), $targetPageURL );
        $tags           = $tch->getTags( $b->getAttribute('blogga_tags'), $nh->getCollectionURL(Page::getByPath('/blog_search')) );
        ?>

        <div class="entry">
            <?php 
                $controller->showPostThumbnail( $b->getAttribute('blogga_post_preview_image') );
                echo '<h2><a href="'.$this->url($b->getCollectionPath()).'">'.$b->getCollectionName().'</a></h2>';
                echo $controller->getDescription($b);
                echo '<div style="clear:both;"></div>';
                echo '<p class="small-text">Categories: '.$categories.' | Tags: '.$tags.'</p>';
            ?>
            
            <div class="entry-details">
                <p>
                    <?php  echo $b->getCollectionDateAdded('F j, Y'); ?>&nbsp;&nbsp;|&nbsp;&nbsp;
                    <?php  //<strong>Comments:</strong> 15 $b->getAttribute('responses');  &nbsp;&nbsp;|&nbsp;&nbsp; ?>
                    <strong>Share:</strong>
                    <span class="share-links">
                        <a rel="nofollow"  target="_blank" href="http://www.facebook.com/share.php?u=<?php  echo BASE_URL . $this->url($b->getCollectionPath()); ?><?php  echo '&t='?><?php  echo $b->getCollectionName(); ?>" title="Facebook"><img src="<?php  echo $this->getBlockURL();  ?>/gfx/facebook.png" title="Facebook" alt="Facebook" style="width: 16px; height: 16px;" class="sharelinks-hovers" /></a>
                        <a rel="nofollow"  target="_blank" href="http://twitter.com/home?status=<?php  echo $b->getCollectionName(); ?>%20-%20<?php  echo BASE_URL . $this->url($b->getCollectionPath()); ?>" title="Twitter"><img src="<?php  echo $this->getBlockURL(); ?>/gfx/twitter.png" title="Twitter" alt="Twitter" style="width: 16px; height: 16px;" class="sharelinks-hovers" /></a>
                        <a rel="nofollow"  target="_blank" href="http://www.google.com/bookmarks/mark?op=edit&amp;bkmk=<?php  echo BASE_URL . $this->url($b->getCollectionPath()); ?>&amp;title=<?php  echo $b->getCollectionName(); ?>&amp;annotation=EXCERPT" title="Google Bookmarks"><img src="<?php  echo $this->getBlockURL(); ?>/gfx/googlebookmark.png" title="Google Bookmarks" alt="Google Bookmarks" style="width: 16px; height: 16px;" class="sharelinks-hovers" /></a>
                        <a rel="nofollow"  target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php  echo BASE_URL . $this->url($b->getCollectionPath()); ?>&amp;title=<?php  echo $b->getCollectionName(); ?>&amp;source=Henryhagan.com&amp;summary=EXCERPT" title="LinkedIn"><img src="<?php  echo $this->getBlockURL(); ?>/gfx/linkedin.png" title="LinkedIn" alt="LinkedIn" style="width: 16px; height: 16px;" class="sharelinks-hovers" /></a>
                        <a rel="nofollow"  target="_blank" href="http://www.printfriendly.com/print?url=<?php  echo BASE_URL . $this->url($b->getCollectionPath()); ?>&amp;partner=henryhagan" title="Print"><img src="<?php  echo $this->getBlockURL(); ?>/gfx/printfriendly.png" title="Print" alt="Print" style="width: 16px; height: 16px;" class="sharelinks-hovers" /></a>
                        <a rel="nofollow"  target="_blank" href="mailto:?subject=<?php  echo $b->getCollectionName(); ?>&amp;body=<?php  echo BASE_URL . $this->url($b->getCollectionPath()); ?>" title="email"><img src="<?php  echo $this->getBlockURL(); ?>/gfx/email_link.png" title="email" alt="email" style="width: 16px; height: 16px;" class="sharelinks-hovers" /></a>
                    </span>
                </p>
            </div>
        </div>

  <?php  } } ?>

<?php  if($controller->paginate){ ?>
<div style="padding:15px 0 8px;">
    <?php  echo $pl->displayPaging(); ?>
</div>
<?php  } ?>