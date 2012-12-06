<?php    defined('C5_EXECUTE') or die(_("Access Denied."));
$im=Loader::helper('image');
$i=$j=0;
$page=$category=$get_category=$query_category="";

if(isset($_REQUEST['page'])){
	$page=$_REQUEST['page'];
	$query_page=" LIMIT ".$controller->items*($page-1).",".$controller->items;
	$page_get = "&page=$page";
} else {
	$page_get = "";
}

if(isset($_REQUEST['category'])){
	$category=$_REQUEST['category'];
	$get_category="&category=$category";
	$query_category=" AND category=".$controller->db->qstr($category);
}

if(isset($_REQUEST['unset'])){
	unset($category);
}

$thumb=unserialize($controller->thumbsize);
$items=$controller->db->GetArray('SELECT * FROM PdPortfolioImages WHERE bID='.$controller->bID.$query_category.$query_page);
$cats=$controller->db->GetArray('SELECT DISTINCT category FROM PdPortfolioImages WHERE bID='.$controller->bID.' ORDER BY category ASC');
?>
<div class="pd_portfolio_nav">
<ul>		
	<?php     
	$raw_page = Page::getCurrentPage();
	$pagecID = $raw_page->getCollectionID();
	$edit_fix = "?cID=$pagecID";
	if (!isset($_REQUEST['category'])) {
		$all_selected_css = 'class="pd_nav_selected"';
	} else {
		$all_selected_css = '';
	}
	echo '<li><a '.$all_selected_css.' href="'.BASE_URL.DIR_REL.'/index.php/'.$edit_fix.'&unset">View All</a></li>';
	foreach($cats as $cat){
		if (isset($_REQUEST['category'])) {
			if ($_REQUEST['category'] == $cat['category']) {
				$selected_css = 'class="pd_nav_selected"';
			} else {
				$selected_css = '';
			}	
		} else {
			$selected_css = '';
		}
		echo '<li><a '.$selected_css.' href="'.BASE_URL.DIR_REL.'/index.php/'.$edit_fix.'&category='.$cat['category'].'">'.$cat['category'].'</a></li>';
	} ?>
</ul>
</div>

<div class="pd_items_wrapper">

<?php    

foreach($items as $item){ 
		
	if($i<$controller->items){
			
		echo '<div class="portfolio-item">';
			echo '<a rel="col_group" href="#itemnum'.$item['id'].'">';
				echo '<img src="'.File::getRelativePathFromID($item['image']).'" width="'.$thumb[1].'" height="'.$thumb[0].'" title="'.$item['title'].'" alt="'.$item['title'].'" />';
			echo '</a>';
		echo '</div>';
		
		echo '<div style="display: none;" ><div id="itemnum'.$item['id'].'">';
			echo '<h1>'.$item['title'].'</h1>';
			echo '<img src="'.File::getRelativePathFromID($item['image']).'" width="'.$controller->largewidth.'" />';
			echo '<p style="padding-top: 10px; width: '.$controller->largewidth.'px">'.$item['description'].'</p>';
			if(isset($item['url'])&&$item['url']!=""){
				echo '<a href="'.$item['url'].'" target="blank">'.$item['url'].'</a>';
			}
		echo '</div></div>';
		$i++;
	}
} 
?>
	<div class="pd_pagination">
		<ul>
		<?php   
		$count_per_cat = $controller->db->Execute('SELECT * FROM PdPortfolioImages WHERE bID='.$controller->bID.$query_category)->NumRows();
		$total_divided = $count_per_cat / $controller->items;
		if ($total_divided > 1) {
			$pagi = 1;			
			while ($pagi <= ceil($total_divided)) {
				$num_page = $pagi++;
				if (isset($_REQUEST['page'])){
					if ($num_page == $_REQUEST['page']) {
						$selected_css = 'class="pd_nav_selected"';
					} else {
						$selected_css = '';
					}
				}
				if (isset($_REQUEST['category'])) {
					$cat_string = '&category='.$_REQUEST['category'];
				} else {
					$cat_string = '';
				}
				echo '<li><a '.$selected_css.' href="'.BASE_URL.DIR_REL.'/index.php/'.$edit_fix.'&page='. $num_page .$cat_string.'">'.$num_page.'</a></li>';
			}
		}		
		?>
		</ul>
	</div>
	
</div>

<script type="text/javascript">
$(".ccm-dialog-content").ready(function(){
	$('.portfolio-item img').captify({
	  speedOver: 'fast',
	  speedOut: 'normal',
	  hideDelay: 500,
	  // 'fade', 'slide', 'always-on'
	  animation: 'slide', 
	  prefix: '', 
	  opacity: '0.7',    
	  className: 'caption-bottom',
	  position: 'bottom',
	  spanWidth: '100%'
	 });
	 $(".portfolio-item a[rel='col_group']").colorbox({inline:true});
});
</script>
