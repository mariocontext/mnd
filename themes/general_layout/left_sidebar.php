
<?php 
defined('C5_EXECUTE') or die(_("Access Denied."));
$this->inc('elements/header.php'); ?>

<!-- custom styles can go here -->

<style type="text/css" media="all">
<!--

#primaryContent {
 right:0px;
 width:750px;
}


-->
</style>

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

                  
                    
                    <div id="secondaryContent1Wrap">
                    <div id="secondaryContent1">


                                     			<?php 
			$as = new Area('Sidebar');
			$as->display($c);
			?>	
                
			
                    
                    <!-- close of  secondaryContent1 --></div>
                    <!-- close of  secondaryContent1Wrap--></div>
    
    
    
    
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
