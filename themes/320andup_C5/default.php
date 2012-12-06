<?php  
defined('C5_EXECUTE') or die("Access Denied.");
$this->inc('elements/header.php'); ?>

<!-- Row -->
<div id="general-content" class="grids grids-two content clearfix">

	<div id="main-content-container" class="grid grid-1">
		<div id="main-content-inner">
		<section role="main">	
			
		<h1><?php  echo $c->getCollectionName(); ?></h1>
		
			<?php  
			$a = new Area('Main');
			$a->display($c);
			$a->setBlockWrapperStart('<div class="grid-element">');
    		$a->setBlockWrapperEnd('</div>');
    		/* you can hardcode in the the content editor or plugins, grid-a, grid-b, grid-c etc to stack elements */
			?>
		</section><!-- /main-content-inner section -->
		</div><!-- /main-content-inner -->
	
	</div><!-- /main-content-container -->

	<div id="right-sidebar-container" class="grid grid-2">

		<div id="right-sidebar-inner">
		<aside role="complementary">
			<?php  
			$a = new Area('Sidebar');
			$a->display($c);
			$a->setBlockWrapperStart('<div class="grid-element">');
    		$a->setBlockWrapperEnd('</div>')
			?>
		</aside><!-- /right-sidebar-inner aside -->	
		</div><!-- /right-sidebar-inner -->
	
	</div><!-- /right-sidebar-container -->
	

</div><!-- /general-content -->
<!-- /Row -->
	
<?php  $this->inc('elements/footer.php'); ?>
