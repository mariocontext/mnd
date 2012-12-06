<?php   defined('C5_EXECUTE') or die(_("Access Denied."));

// leave the next 3 lines of code alone, they are crucial for Blogga to work
if(Page::getCurrentPage()->getAttribute('blogga_parent')){
    $a = new Area('Blog Area'); $a->display($c);
}else{ $b = Page::getCurrentPage();
$nh = Loader::helper('navigation');
$tch = Loader::helper('tags_categories','blogga');

$thisPage = Page::getCurrentPage();

$blogParentID   = $thisPage->getAttribute('post_parent_blog_id');
$targetPageURL  = $nh->getCollectionURL(Page::getByID($blogParentID));
$categories     = $tch->getCategories( $b->getAttribute('blogga_'.$blogParentID.'_categories'), $targetPageURL );
$tags           = $tch->getTags( $b->getAttribute('blogga_tags'), $nh->getCollectionURL(Page::getByPath('/blog_search')) );
?>

    <!-- style blog posts in between here -->

    <div id="target-top" class="entry">
        <?php 
            // thumbnail image
            $ih = Loader::helper('image');
            $thumb = $thisPage->getAttribute('blogga_post_preview_image');
            if(is_object($thumb)){
                $ih->outputThumbnail($thumb,125,125,'thumbnail');
            }

            echo '<h1 style="padding-bottom:3px;">'.$b->getCollectionName().'</h1>';
            echo '<p class="small-text">Categories: '.$categories.' | Tags: '.$tags.'</p>';
        ?>
        
        
        <div class="post-content" style="clear:both;padding:10px 0;">
            <?php  $a = new Area('Blog Area'); $a->display($c); ?>
        </div>
        <a href="#target-top">Back to top</a>

        <div class="entry-details">
            <p>
                <?php  echo $thisPage->getCollectionDateAdded('F j, Y'); ?>&nbsp;&nbsp;|&nbsp;&nbsp;
                <?php  //<strong>Comments:</strong> 15 $b->getAttribute('responses');  &nbsp;&nbsp;|&nbsp;&nbsp; ?>
                <strong>Share:</strong>
                <span class="share-links">
                    <a rel="nofollow"  target="_blank" href="http://www.facebook.com/share.php?u=<?php  echo BASE_URL . $this->url($thisPage->getCollectionPath()); ?><?php  echo '&t='?><?php  echo $thisPage->getCollectionName(); ?>" title="Facebook"><img src="<?php  echo $blockURL; ?>/gfx/facebook.png" title="Facebook" alt="Facebook" style="width: 16px; height: 16px;" class="sharelinks-hovers" /></a>
                    <a rel="nofollow"  target="_blank" href="http://twitter.com/home?status=<?php  echo $thisPage->getCollectionName(); ?>%20-%20<?php  echo BASE_URL . $this->url($thisPage->getCollectionPath()); ?>" title="Twitter"><img src="<?php  echo $blockURL; ?>/gfx/twitter.png" title="Twitter" alt="Twitter" style="width: 16px; height: 16px;" class="sharelinks-hovers" /></a>
                    <a rel="nofollow"  target="_blank" href="http://www.google.com/bookmarks/mark?op=edit&amp;bkmk=<?php  echo BASE_URL . $this->url($thisPage->getCollectionPath()); ?>&amp;title=<?php  echo $thisPage->getCollectionName(); ?>&amp;annotation=EXCERPT" title="Google Bookmarks"><img src="<?php  echo $blockURL; ?>/gfx/googlebookmark.png" title="Google Bookmarks" alt="Google Bookmarks" style="width: 16px; height: 16px;" class="sharelinks-hovers" /></a>
                    <a rel="nofollow"  target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php  echo BASE_URL . $this->url($thisPage->getCollectionPath()); ?>&amp;title=<?php  echo $thisPage->getCollectionName(); ?>&amp;source=Henryhagan.com&amp;summary=EXCERPT" title="LinkedIn"><img src="<?php  echo $blockURL; ?>/gfx/linkedin.png" title="LinkedIn" alt="LinkedIn" style="width: 16px; height: 16px;" class="sharelinks-hovers" /></a>
                    <a rel="nofollow"  target="_blank" href="http://www.printfriendly.com/print?url=<?php  echo BASE_URL . $this->url($thisPage->getCollectionPath()); ?>&amp;partner=henryhagan" title="Print"><img src="<?php  echo $blockURL; ?>/gfx/printfriendly.png" title="Print" alt="Print" style="width: 16px; height: 16px;" class="sharelinks-hovers" /></a>
                    <a rel="nofollow"  target="_blank" href="mailto:?subject=<?php  echo $thisPage->getCollectionName(); ?>&amp;body=<?php  echo BASE_URL . $this->url($thisPage->getCollectionPath()); ?>" title="email"><img src="<?php  echo $blockURL; ?>/gfx/email_link.png" title="email" alt="email" style="width: 16px; height: 16px;" class="sharelinks-hovers" /></a>
                </span>
            </p>
        </div>
    </div>

    <!-- end blog post theming -->

<?php 
    // we have to leave this area installed (but not displayed, until below)
    // so the GuestBook block can be installed when a new blog post is created
    $b = new Area('Blog Comments'); $b->setBlockLimit(1);
    // only show post comments IF ALLOWED on this page!
    if(Page::getCurrentPage()->getAttribute('blogga_post_comments')){
        echo '<div style="margin-top:15px;">';
            $b->display($c);
        echo '</div>';
    }
    
}
?>
