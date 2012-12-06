<?php  
defined('C5_EXECUTE') or die("Access Denied.");
$this->inc('elements/header.php'); ?>
	
<!-- Row -->
<div id="general-content" class="grids grids-one content clearfix">

	<div id="main-content-container" class="grid grid-1">
		<div id="main-content-inner">
		<section role="main">
		
			<?php  
			$a = new Area('Main');
			$a->display($c);
			$a->setBlockWrapperStart('<div class="grid-element">');
    		$a->setBlockWrapperEnd('</div>')
			?>
		</section><!-- /main-content-inner section -->
		
		</div><!-- /main-content-inner -->
	
	</div><!-- /main-content-container -->

</div><!-- /general-content -->
<!-- /Row -->
	
<?php  $this->inc('elements/footer.php'); ?>
