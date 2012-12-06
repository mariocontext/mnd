<?php 
defined('C5_EXECUTE') or die(_("Access Denied."));
$this->inc('elements/header.php'); ?>

<style type="text/css" media="all">
<!--

#primaryContent {
	width:920px;
	float:none;
	position:relative;
	left:20px;
	top:0px;
}

-->
</style>

<!-- note v2 -->

<?php include_once("googleanalytics.php") ?>

</head>

<body>



<div id="containerWrap">
<div id="container">



    <div id="headerWrap">

    <div id="header">
    
    <?php  $this->inc('elements/headerItems.php'); ?>


    <!-- close of  header --></div>
    
  <div id="headerNavWrap">
  <div id="headerNav">

			<?php 
			$a = new Area('Header Nav');
			$a->display($c);
			?>
            
<!-- close of headerNav --></div>
<!-- close of headerNavWrap --></div> 
    
    
    <!-- close of  headerWrap--></div>
    
    
    
        <div id="contentWrap">
        <div id="myContent">
    
    
                    <div id="primaryContentWrap">
                    <div id="primaryContent">
					
					            <div class="breadcrumb">        
									<?php  
									defined('C5_EXECUTE') or die(_("Access Denied."));  
									
									//output  
									   
									show_breadcrumb($c);  
									   
									function show_breadcrumb($c){  
									$nh=Loader::helper('navigation');  
									$breadcrumb=$nh->getTrailToCollection($c);  
									krsort($breadcrumb);  
									foreach($breadcrumb as $bcpage){  
									echo'<a href="'.BASE_URL.DIR_REL.$bcpage->getCollectionPath().'/">'.$bcpage->getCollectionName().'</a> > ';  
									}  
									echo$c->getCollectionName();  
									}  
									   
									?> 
            
            					<!-- close of breadcrumb--></div>
                    
			<?php 
			$a = new Area('Main');
			$a->display($c);
			?>
			
			<div id="primaryContentFooterNav">
						<?php 
			$a = new Area('contentFooterNav');
			$a->display($c);
			?>
			<!-- close of contentFooterNav--></div>
                    
  
        <!-- close of  primaryContent --></div>
        <!-- close of  primaryContentWrap--></div>

    
    
    
        <!-- close of  content --></div>
        <!-- close of  contentWrap--></div>
        
    
    <div id="footerWrap">
    <div id="footer">
    
    <?php  $this->inc('elements/footer.php'); ?>

    
    <!-- close of  footer --></div>
    <!-- close of  footerWrap--></div>


<!-- close of container --></div>
<!-- close of containerWrap --></div>

<?php  defined('C5_EXECUTE') or die(_("Access Denied.")); ?>

<?php  Loader::element('footer_required'); ?>


</body>
</html>
