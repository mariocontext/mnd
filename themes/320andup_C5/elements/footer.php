<?php   defined('C5_EXECUTE') or die("Access Denied."); ?>
	
	<footer id="footer-main" class="clearfix" role="contentinfo">
	
		<div id="footer-inner">

			<div id="footer-custom">

				<?php  
				$a = new GlobalArea('Custom Footer');
				$a->display();
				$a->setBlockWrapperStart('<div class="grid-element">');
    			$a->setBlockWrapperEnd('</div>')
				?>

			</div><!-- /footer-custom -->

			<div class="return-to-top"><a href="#main-container">Return to Top</a></div>
			<?php
			/* needs Pretty Urls activated http://www.concrete5.org/documentation/using-concrete5/dashboard/system-and-maintenance/seo-and-statistics/pretty-urls/ or copy and paste direct link into anchor link below */
			?>	
			<div class="go-to-sitemap"><a href="<?php print DIR_REL; ?>/storage/sitemap">View Sitemap</a></div>
			
				<p class="footer-sign-in">
				<?php  
				$u = new User();
				if ($u->isRegistered()) { ?>
					<?php   
					if (Config::get("ENABLE_USER_PROFILES")) {
						$userName = '<a href="' . $this->url('/profile') . '">' . $u->getUserName() . '</a>';
					} else {
						$userName = $u->getUserName();
					}
					?>
					<span class="sign-in"><?php  echo t('Currently logged in as <b>%s</b>.', $userName)?> <a href="<?php  echo $this->url('/login', 'logout')?>"><?php  echo t('Sign Out')?></a></span>
				<?php   } else { ?>
					<span class="sign-in"><a href="<?php  echo $this->url('/login')?>"><?php  echo t('Sign In to Edit this Site')?></a></span>
				<?php   } ?>
				</p>

		
				<p class="footer-copyright clearfix">&copy;<?php  echo date('Y')?> <?php  echo SITE?>.</p>
				
		
		</div><!-- /footer-inner -->
	
	</footer><!-- /footer main -->


</div><!-- /end main container -->

<!-- note - C5 loads jquery version 1.7.1 in the head automatically. 320andup plugins may require 1.7.2 since this is included in the latest Andy Clark update -->
<script src="<?php  echo $this->getThemePath(); ?>/js/plugins.js"></script>
<!-- your own custom scripts can go in script.js -->
<script src="<?php  echo $this->getThemePath(); ?>/js/nav-toggler.js"></script>
<script src="<?php  echo $this->getThemePath(); ?>/js/jquery.fitvids.js"></script>
<script src="<?php  echo $this->getThemePath(); ?>/js/script.js"></script>
<script src="<?php  echo $this->getThemePath(); ?>/js/helper.js"></script>
<script src="<?php  echo $this->getThemePath(); ?>/js/respond.min.js"></script>


<!-- differs from general 320andup guidlines. add google analytics scripts via the c5 dashboard or add it in as per google's instructions as an included php file -->

<?php   Loader::element('footer_required'); ?>

</body>
</html>