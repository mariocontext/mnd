<?php  
defined('C5_EXECUTE') or die("Access Denied.");
$this->inc('elements/header.php');
$nav = Loader::helper('navigation');
?>


	<div id="header-image">
		
		<div id="featured-image-full">
			<?php 
			
			if ($c->isEditMode()) {
				print '<br /><br />';
				$a = new Area('Thumbnail Image');
				$a->display($c);
			}
			?>
		</div><!-- /featured-image-full -->
		
	</div><!-- /header-image -->

<!-- Row -->

<div id="general-content" class="grids grids-two content clearfix">

	<div id="left-sidebar-container" class="grid grid-1">

		<div id="left-sidebar-inner">

			<aside role="complementary">
		
			<?php  
			$a = new Area('Sidebar');
			$a->display($c);
			$a->setBlockWrapperStart('<div class="grid-element">');
    		$a->setBlockWrapperEnd('</div>')
			?>

			</aside><!-- /left-sidebar-inner aside -->
			
		</div><!-- /left-sidebar-inner -->
	
	</div><!-- /left-sidebar-container -->

	<div id="main-content-container" class="grid grid-2">
		<div id="main-content-inner">
		<article role="main">
			
			<h1><?php  echo $c->getCollectionName(); ?></h1>
			
		
			<?php  
			$a = new Area('Main');
			$a->display($c);
			$a->setBlockWrapperStart('<div class="grid-element">');
    		$a->setBlockWrapperEnd('</div>')
			?>
			
			<div id="main-content-post-author">
			
				<?php  
				$u = new User();
				if ($u->isRegistered()) { ?>
					<?php   
					if (Config::get("ENABLE_USER_PROFILES")) {
						$userName = '<a href="' . $this->url('/profile') . '">' . $u->getUserName() . '</a>';
					} else {
						$userName = $u->getUserName();
					}
				}
				?>

				<p><?php  echo t('Posted by:');?> <span class="post-author"><?php   echo $userName; ?> at <a href="<?php  $c->getLinkToCollection;?>"><?php  echo $c->getCollectionDatePublic('g:i a')?> on <?php  echo $c->getCollectionDatePublic('F jS, Y')?></a></span>
					<div id="main-content-post-footer-share">
						<p>Share:
						<a href="mailto:?subject=<?php  echo $c->getCollectionName(); ?>&body=<?php  echo $nav->getLinkToCollection($c, true); ?>"><img class="main-content-post-footer-share-email" src="<?php  echo $this->getThemePath(); ?>/images/icon_email.png" alt="Email" /></a>
						<a href="https://twitter.com/share"><img class="main-content-post-footer-share-twitter" src="<?php  echo $this->getThemePath(); ?>/images/icon_twitter.png" alt="Share on Twitter" /></a>
						<a href="http://www.facebook.com/share.php?u=<?php  echo $nav->getLinkToCollection($c, true); ?>"><img class="main-content-post-footer-share-facebook" src="<?php  echo $this->getThemePath(); ?>/images/icon_facebook.png" alt="Share on Facebook" /></a>
						</p>
					</div><!-- /main-content-post-footer-share -->
				</p>	
			</div><!-- /main-content-post-author -->
		</article>	
		</div><!-- /main-content-inner -->
	
	</div><!-- /main-content-container -->

</div><!-- /general-content -->

	
<?php  if(isset($print) && $print) { ?>
<script type="text/javascript">
$(function(){ window.print(); });
</script>
<?php  } ?>

	
<?php  $this->inc('elements/footer.php'); ?>
