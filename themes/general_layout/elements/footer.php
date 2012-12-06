		<div id="socialFooterLinks">
		
		<div id="linkedInFooterIcon" class="myPoppy">
      		<a href="http://www.linkedin.com/in/argus"><img src="<?php echo $this->getThemePath(); ?>/images/linkedInSmall.gif" alt="Linked In"/></a>
	    </div>
		
		<div id="facebookFooterIcon" class="myPoppy">
      		<a href="http://www.facebook.com/profile.php?id=625085884"><img src="<?php echo $this->getThemePath(); ?>/images/facebookIcon.gif" alt="Facebook"/></a>
	    </div>
		
		<div id="twitterFooterIcon" class="myPoppy">
      		<a href="http://twitter.com/#!/mndtwit"><img src="<?php echo $this->getThemePath(); ?>/images/twitterIconSmall.gif" alt="Facebook"/></a>
	    </div>
		
		<div id="mushroomFooterIcon" class="myPoppy"></div>
		<div id="turtleFooterIcon" class="mySlider"></div>
		<div id="myMario" class="myPoppy"></div>
		
		<!-- close of socialFooterLinks --></div>
		
				 <div id="fatFooter">
				  
				  <?php 
                        $a = new Area('FatFooter');
                        $a->display($c);
                  ?>
				  
				  <!-- close of FatFooter --></div>

     
             <div id="footerInfo">
             
                          <p>
                          <?php 
                          $a = new Area('Footer');
                          $a->display($c);
                          ?>
                          </p>
                           
                          <div id="footerEnd">	
                          
                          &copy; <?php echo date('Y')?> <a href="<?php echo DIR_REL?>/"><?php echo SITE?></a>
                          &nbsp;&nbsp;
                          <?php echo t('All rights reserved.')?>	
                         
                          
                           <!-- close of footerEnd --></div> 
             
             <!-- close of footerInfo --></div>   
          



                        
           

    

