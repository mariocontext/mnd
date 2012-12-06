<?php     
defined('C5_EXECUTE') or die(_("Access Denied."));
$al = Loader::helper('concrete/asset_library');
$ah = Loader::helper('concrete/interface');
$fm = Loader::helper('form');
$html = Loader::helper('html');

$assetLibraryPassThru = array(
	'type' => 'image'
);
if ($controller->bID) {
	$items=$controller->db->GetArray('SELECT * FROM PdPortfolioImages WHERE bID='.$controller->bID);
} 
$categories=array();
$cats=$controller->db->GetArray('SELECT DISTINCT category FROM PdPortfolioImages ORDER BY category ASC');
foreach($cats as $cat){
	$categories[$cat['category']]=$cat['category'];
}
?>
<?php    echo $html->javascript('jquery.simpleCombo.js','pd_portfolio'); ?>
<script type="text/javascript">
	var ccm_fpActiveTab = "ccm-portfolio-type";	
	$("#ccm-portfolio-tabs a").click(function() {
		$("li.ccm-nav-active").removeClass('ccm-nav-active');
		$("#" + ccm_fpActiveTab + "-tab").hide();
		ccm_fpActiveTab = $(this).attr('id');
		$(this).parent().addClass("ccm-nav-active");
		$("#" + ccm_fpActiveTab + "-tab").show();
	});

	var content;
	var i=-1;
	addItem = function(){
		content='<div class="ccm-portfolio-item-container"><div class="id-container" style="display: none;">'+i+'</div>';
  		content+='<div class="ccm-portfolio-item-title">';
		content+='<a href="javascript:void(0);" onclick="PdPortfolioViewerBlock.toggleCategory($(this));" class="ccm-portfolio-item-title-img ccm-portfolio-item-title-img-down"></a>';
		content+='<a href="javascript:void(0);" onclick="PdPortfolioViewerBlock.toggleCategory($(this));"><strong>New Item #'+i*-1+'</strong></a>';
		content+='<div style="width:80px; float:right; text-align:right;">';
		content+='<a onclick="PdPortfolioViewerBlock.removeCategory($(this))" style="padding-top:4px;"><img src="<?php     echo ASSETS_URL_IMAGES?>/icons/delete_small.png" /></a>';
		content+='</div>';
		content+='</div>';
		content+='<div class="ccm-portfolio-item-contents">';
		content+='<div class="pd_settings_wrapper_outer">';
		content+='<div class="pd_settings_wrapper_inner_top">';
		content+='<?php    echo $fm->label("title_'+i+'",t("Title")); ?>';
		content+='<?php    echo $fm->text("title_'+i+'",null,array("style" => "width: 95%;")); ?>';
		content+='</div>';
		content+='<div class="pd_settings_wrapper_inner_top">';
		content+='<?php    echo $fm->label("category_'+i+'",t("Category (Type to add new.)")); ?>';
		content+='<?php    echo $fm->select("category_'+i+'",$categories,null,array("class"=>"combo","style" => "width: 95%;")); ?>';
		content+='</div>';
		content+='<div class="pd_settings_wrapper_inner_top">';
		content+='<?php    echo $fm->label("url_'+i+'",t("URL (Leave blank to not show link.)")); ?>';
		content+='<?php    echo $fm->text("url_'+i+'",null,array("style" => "width: 95%;")); ?>';
		content+='</div>';
		content+='</div>';
		content+='<div class="pd_settings_wrapper_outer">';
		content+='<div class="pd_settings_wrapper_inner_bottom">';
		content+='<?php    echo $fm->label("description_'+i+'",t("Description")); ?>';
		content+='<?php    echo $fm->textarea("description_'+i+'",null,array("style" => "width: 95%;")); ?>';
		content+='</div>';
		content+='<div class="pd_settings_wrapper_inner_bottom">';
		content+='<?php    echo $fm->label("imageId_'+i+'",t("Image")); ?>';
		content+='<div style="display: none" class="ccm-file-selected-wrapper" id="imageId_'+i+'-fm-selected"><img src="/c5/concrete/images/throbber_white_16.gif"></div><div style="display: block" ccm-file-manager-field="imageId_'+i+'" id="imageId_'+i+'-fm-display" class="ccm-file-manager-select"><a onclick="ccm_chooseAsset=false; ccm_alLaunchSelectorFileManager(\'imageId_'+i+'\')" href="javascript:void(0)">Select Image</a><input type="hidden" value="1" name="fType" class="ccm-file-manager-filter"></div><input type="hidden" value="0" name="imageId_'+i+'" id="imageId_'+i+'-fm-value">';
		content+='</div>';
		content+='</div>';
		content+='</div><div style="clear: both;"></div></div>';
		$(content).insertBefore('#delete-container');
		i--;
		$('.combo').simpleCombo();
	}
	
	$(document).ready(function(){
		$('.combo').simpleCombo();
	});
</script>
<style type="text/css">
.ccm-portfolio-settings-tab * {
	margin:0;
	padding:0;
}
.ccm-portfolio-settings-tab ul {
	margin:10px;
	list-style:none;
}
.ccm-portfolio-settings-tab ul li {
	margin-bottom:15px;
}
div.ccm-portfolio-item-container {
	border: 1px solid #DEDEDE;
	padding:4px;
	margin-top:10px;
	margin-bottom:5px;
}
a.ccm-portfolio-item-title-img { 
	display:block; 
	float:left;
	width:10px;
	height:11px;
	margin-right:2px;
	background:url(<?php     echo DIR_REL?>/concrete/images/popcal/right2.gif) no-repeat center;
}
a.ccm-portfolio-item-title-img-down {
	background:url(<?php     echo DIR_REL?>/concrete/images/popcal/drop2.gif) no-repeat center;
}
.pd_settings_wrapper_outer {
	clear: both;
	position: relative;
	float: left;
	width: 100%;
	padding-top: 10px;
}
.pd_settings_wrapper_inner_top {
	position: relative;
	float: left;
	width: 33%;
}
.pd_settings_wrapper_inner_bottom {
	position: relative;
	float: left;
	width: 50%;
}
</style>

<ul class="ccm-dialog-tabs" id="ccm-portfolio-tabs">
  <li class="ccm-nav-active"><a href="javascript:void(0)" id="ccm-portfolio-type"><?php     echo t('Items')?></a></li>
  <li><a href="javascript:void(0)" id="ccm-portfolio-settings"><?php     echo t('Settings')?></a></li>
</ul>
<div id="ccm-portfolio-settings-tab" style="display:none">
	<div style="padding: 15px;">
		<?php   
			$thumb=unserialize($controller->thumbsize);
			echo '<p>';
			echo $fm->label('items',t('Items Per Page, 999 For No Pagination'));
			echo $fm->text('items',$controller->items);
			echo '</p><p>';
			echo $fm->label('thumbheight',t('Thumbnail Size: Width x Height in Pixels'));
			echo $fm->text('thumbwidth',$thumb[1]);
			echo ' x ';
			echo $fm->text('thumbheight',$thumb[0]);
			echo '</p><p>';
			echo $fm->label('largewidth',t('Lightbox Width in Pixel'));
			echo $fm->text('largewidth',$controller->largewidth);
			echo '</p>';
		?>
	</div>
</div>
<div id="ccm-portfolio-type-tab">
<?php    
if ($controller->bID) {
	foreach($items as $item){ ?>
	<div class="ccm-portfolio-item-container"><div class="id-container" style="display: none;"><?php    echo $item['id']; ?></div>
  		<div class="ccm-portfolio-item-title">
		    <a href="javascript:void(0);" onclick="PdPortfolioViewerBlock.toggleCategory($(this));" class="ccm-portfolio-item-title-img"></a>
		    <a href="javascript:void(0);" onclick="PdPortfolioViewerBlock.toggleCategory($(this));"><strong><?php    echo $item['title']; ?></strong></a>
		    <div style="width:80px; float:right; text-align:right;">
		        <a onclick="PdPortfolioViewerBlock.removeCategory($(this))" style="padding-top:4px;"><img src="<?php     echo ASSETS_URL_IMAGES?>/icons/delete_small.png" /></a>
		    </div>
		</div>
		<div class="ccm-portfolio-item-contents" style="display: none;">
			<div class="pd_settings_wrapper_outer">
				<div class="pd_settings_wrapper_inner_top">
					<?php   
						echo $fm->label('title_'.$item['id'],t('Title'));
						echo $fm->text('title_'.$item['id'],$item['title'],array("class"=>"item","style" => "width: 95%;"));
					?>
				</div>
				<div class="pd_settings_wrapper_inner_top">
					<?php   
						echo $fm->label('category_'.$item['id'],t('Category (Type to add new.)'));
						echo $fm->select('category_'.$item['id'],$categories,$item['category'],array("class"=>"item combo","style" => "width: 95%;"));
					?>
				</div>
				<div class="pd_settings_wrapper_inner_top">
					<?php   
						echo $fm->label('url_'.$item['id'],t('URL (Leave blank to not show link.)'));
						echo $fm->text('url_'.$item['id'],$item['url'],array("style" => "width: 95%;"));
					?>
				</div>
			</div>
			<div class="pd_settings_wrapper_outer">
				<div class="pd_settings_wrapper_inner_bottom">
					<?php   
						echo $fm->label('description_'.$item['id'],t('Description'));
						echo $fm->textarea('description_'.$item['id'],$item['description'],array("style" => "width: 95%;"));
					?>
				</div>
				<div class="pd_settings_wrapper_inner_bottom">
					<?php   
						echo $fm->label("imageId_".$item['id'],t("Image"));
						echo $al->image("imageId_".$item['id'],"imageId_".$item['id'],t("Select Image"),File::getbyID($item['image']));
					?>
				</div>
			</div>
		</div>
		<div style="clear: both;"></div>
	</div>
	<?php    }
} ?>
	<div id="delete-container" style="display: none;"></div>
	<?php    echo $ah->button_js("Add Item","addItem()","left"); ?>
</div>
