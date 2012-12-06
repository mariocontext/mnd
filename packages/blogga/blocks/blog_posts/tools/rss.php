<?php  
defined('C5_EXECUTE') or die(_("Access Denied."));

//Permissions Check
if($_GET['bID']) {
	$c = Page::getByID($_GET['cID']);
	$a = Area::get($c, $_GET['arHandle']);
		
	//edit survey mode
	$b = Block::getByID($_GET['bID'],$c, $a);
	
	//$controller = new PageListBlockController($b);
        $controller = $b->getInstance();
	$rssUrl = $controller->getRssUrl($b);
	
	$bp = new Permissions($b);
	if($bp->canRead() && $controller->show_rss) { //

		$pages = $controller->getPages()->get(25);
		$nh = Loader::helper('navigation');

		header('Content-type: text/xml');
		echo "<" . "?" . "xml version=\"1.0\"?>\n";

?>
		<rss version="2.0">
		  <channel>
			<title><?php  echo $controller->rss_title?></title>
			<link><?php  echo BASE_URL.DIR_REL.htmlspecialchars($rssUrl); ?></link>
			<description><?php  echo $controller->rss_description?></description>
<?php  
                
                if($pages){
                    foreach($pages AS $pg){ ?>
                        <item>
                            <title><?php  echo htmlspecialchars($pg->getCollectionName()); ?></title>
                            <link><?php  echo BASE_URL.DIR_REL.$nh->getLinkToCollection($pg); ?></link>
                            <description><?php  echo htmlspecialchars(strip_tags($pg->getCollectionDescription())); ?></description>
                            <pubDate><?php  echo date( 'D, d M Y H:i:s T',strtotime($pg->getCollectionDatePublic())); ?></pubDate>
                        </item>
                <?php  }
                } ?>
     		 </channel>
		</rss>
		
<?php  	} else {  	
		$v = View::getInstance();
		$v->renderError('Permission Denied',"You don't have permission to access this RSS feed");
		exit;
	}
			
} else {
	echo "You don't have permission to access this RSS feed";
}
exit;






