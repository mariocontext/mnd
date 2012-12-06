
<div id="headerItems">

	  <div id="headerLogo" class="myPoppy">
      <a href="<?php echo DIR_REL?>/"><img src="<?php echo $this->getThemePath(); ?>/images/mndLogoV2_trans.png" alt="<?php echo SITE?>"/></a>
      
      <div id="logoText">
      <a href="<?php echo DIR_REL?>/"><?php echo SITE?></a>
       <!-- close of logoText --></div>
      
      <!-- close of headerLogo--></div> 
      
            <div id="customHeaderInfo">
      
      			<?php 
			$a = new Area('Custom Header Info');
			$a->display($c);
			?>
      </div> 
	  
	  <div id="myNavMarker" class="myPoppy">

	  </div>
	  
	  <div id="scorer">
	  
				<div id="scoringArea">
				scoring
				</div>
				
				<div id= "outputArea">
				<p class="feedback"></p>
				</div>
	  
	  </div>
	  
	 
            
</div>


