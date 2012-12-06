<?php   defined('C5_EXECUTE') or die("Access Denied."); ?>
<!DOCTYPE html>
<!-- 
320 and Up by Andy Clarke
Version: 3.0
URL: http://stuffandnonsense.co.uk/projects/320andup/
Apache License: v2.0. http://www.apache.org/licenses/LICENSE-2.0

Port to Concrete 5 - Mario Noble Version 0.1.0

-->

<?php
/* NOTE: header.php and blog_header.php in this folder need to match(elements) */
?>

<!-- HTML5 Boilerplate -->
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html class="no-js lt-ie9" lang="en"><![endif]-->
<!--[if gt IE 8]><!--><html><!--<![endif]-->
<?php
/* could include below in html tag - not doing so to make more flexibile for multilanguage sites
lang="<?php echo LANGUAGE?>"
*/
?>

<head>

<meta charset="utf-8">

<?php   Loader::element('header_required'); ?>

<!-- http://t.co/dKP3o1e -->
<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="320">
<!-- include if you want favicon see also alternate links farther down 
<link rel="shortcut icon" href="<?php  echo $this->getThemePath(); ?>/favicon.ico"> -->

<!-- Site Header Content //-->

<link rel="stylesheet" href="<?php  echo $this->getThemePath(); ?>/css/320andup.css" />
<link rel="stylesheet" media="screen" type="text/css" href="<?php  echo $this->getStyleSheet('typography.css')?>" />
<link rel="stylesheet" media="screen" type="text/css" href="<?php  echo $this->getStyleSheet('C5_tinymce.css')?>" />

<!--[if (lt IE 9) & (!IEMobile)]>
<script src="<?php  echo $this->getThemePath(); ?>/js/selectivizr-min.js"></script>
<![endif]-->

<!-- JavaScript -->
<script src="<?php  echo $this->getThemePath(); ?>/js/modernizr-2.5.3-min.js"></script>


<!-- Icons -->

<!-- 16x16 
<link rel="shortcut icon" href="<?php  echo $this->getThemePath(); ?>/favicon.ico"> -->
<!-- 32x32 
<link rel="shortcut icon" href="<?php  echo $this->getThemePath(); ?>/favicon.png"> -->
<!-- 57x57 (precomposed) for iPhone 3GS, pre-2011 iPod Touch and older Android devices -->
<!-- <link rel="apple-touch-icon-precomposed" href="<?php  echo $this->getThemePath(); ?>/img/apple-touch-icon-precomposed.png"> -->
<!-- 72x72 (precomposed) for 1st generation iPad, iPad 2 and iPad mini -->
<!-- <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php  echo $this->getThemePath(); ?>/img/apple-touch-icon-72x72-precomposed.png"> -->
<!-- 114x114 (precomposed) for iPhone 4, 4S, 5 and post-2011 iPod Touch -->
<!-- <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php  echo $this->getThemePath(); ?>/img/apple-touch-icon-114x114-precomposed.png"> -->
<!-- 144x144 (precomposed) for iPad 3rd and 4th generation -->
<!-- <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php  echo $this->getThemePath(); ?>/img/apple-touch-icon-144x144-precomposed.png"> -->

<!--iOS -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- <meta name="apple-mobile-web-app-title" content="320 and Up"> -->
<!-- <meta name="viewport" content="initial-scale=1.0"> (Use if apple-mobile-web-app-capable below is set to yes) -->
<!-- <meta name="apple-mobile-web-app-capable" content="yes"> -->
<!-- <meta name="apple-mobile-web-app-status-bar-style" content="black"> -->

<!-- iPhone 3GS, pre-2011 iPod Touch -->
<!-- <link rel="apple-touch-startup-image" href="<?php  echo $this->getThemePath(); ?>/img/startup/startup-320x460.png" media="screen and (max-device-width:320px)"> -->
<!-- iPhone 4, 4S and 2011 iPod Touch-->
<!-- <link rel="apple-touch-startup-image" href="<?php  echo $this->getThemePath(); ?>/img/startup/startup-640x920.png" media="(max-device-width:480px) and (-webkit-min-device-pixel-ratio:2)"> -->
<!-- iPhone 5 and 2012 iPod Touch -->
<!-- <link rel="apple-touch-startup-image" href="<?php  echo $this->getThemePath(); ?>/img/startup/startup-640x1096.png" media="(max-device-width:548px) and (-webkit-min-device-pixel-ratio:2)"> -->
<!-- iPad landscape -->
<!-- <link rel="apple-touch-startup-image" sizes="1024x748" href="<?php  echo $this->getThemePath(); ?>/img/startup/startup-1024x748.png" media="screen and (min-device-width:481px) and (max-device-width:1024px) and (orientation:landscape)"> -->
<!-- iPad Portrait -->
<!-- <link rel="apple-touch-startup-image" sizes="768x1004" href="<?php  echo $this->getThemePath(); ?>/img/startup/startup-768x1004.png" media="screen and (min-device-width:481px) and (max-device-width:1024px) and (orientation:portrait)"> -->

<!-- Windows 8 / RT -->
<meta name="msapplication-TileImage" content="<?php  echo $this->getThemePath(); ?>/img/apple-touch-icon-144x144-precomposed.png">
<meta name="msapplication-TileColor" content="#000">
<meta http-equiv="cleartype" content="on">

</head>

<body id="page<?php  echo $c->getCollectionID() ?>" class="<?php  echo $c->getCollectionTypeHandle() ?> clearfix" <?php 
global $cp;
if (is_object($cp) && ($cp->canWrite() || $cp->canAddSubContent() || $cp->canAdminPage())) {
	echo ' style="margin:70px 2% 2% !important;"';
}
?>>

<!--start main container -->

<div id="main-container">

	<header role="banner" class="clearfix">

		<span id="logo-area">
		<?php  
		$a = new GlobalArea('Site Name');
		$a->display();
		?>
		</span>

		<nav id="header-nav" role="navigation" class="clearfix">
		<?php  
		$a = new GlobalArea('Header Nav');
		$a->display();
		?>

		<?php
		/*
		 alternate nav example: use code below (enclosing in php tags) instead of global nav above to harcode the nav and not allow site admins to change it on their own

		    $bt_nav = BlockType::getByHandle('autonav');
		    $bt_nav->controller->displayPages = 'top';
		    $bt_nav->controller->orderBy = 'display_asc';
		    $bt_nav->controller->displaySubPages = 'none';
		    $bt_nav->render('templates/header_menu');
		
        <div class="clearboth">&nbsp;</div>
		*/
    	?>
    	</nav>
		
		<div id="header-image">
		
			<?php  
			$a = new Area('Header Image');
			$a->display($c);
			?>
		
		</div><!-- / header-image -->
		
	</header><!-- main header area -->
	

	<!-- comment out to remove breadcrumbs -->
    <div id="breadcrumbs-threetwenty" class="clearfix">
	        <?php 
	        $bt = BlockType::getByHandle('autonav');
	        $bt->controller->displayPages = 'top';
	        $bt->controller->orderBy = 'display_asc';                    
	        $bt->controller->displaySubPages = 'relevant_breadcrumb';
			$bt->controller->displaySubPageLevels = 'all';
	        $bt->render('templates/breadcrumb');
	        ?>
    </div><!-- /breadcrumbs -->
