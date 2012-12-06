<?php  defined('C5_EXECUTE') or die(_("Access Denied.")) ?>
<ul class="mmb-imageNav" id="mmb-imageNav_<?php  echo $bID?>" style="padding-left: 0pt;">
<?php  
// For each media in the list
foreach($types as $key=>$type) :
	// Get a array with two level.
	$mediaInfos = $controller->get_media_infos($type,$medias[$key],$titles[$key],$descs[$key],$widths[$key],$heights[$key]);
	// If it's a fileset, they a more than one media. 
	foreach($mediaInfos as $mi) :?>
	<?php  //var_dump($mi)?>
	<li class="mmb-item-<?php  echo $type?> mmb-item">
		<?php  if (($mi['title'] != '' && in_array('show_title',$options)) || (($mi['desc'] != '' && in_array('show_desc',$options) )) ) : ?>		
		<div class="mmb-infos">
		<?php  if ($mi['title'] != '' && in_array('show_title',$options) ) : ?>
			<span class="mmb-title"><?php  echo $mi['title']?></span>
		<?php  endif ?>
		<?php  if ($mi['desc'] != '' && in_array('show_desc',$options) ) : ?>
			<span class="mmb-desc"><?php  echo html_entity_decode($mi['desc'])?></span>
		<?php  endif ?>
		</div>
		<?php  endif ?>
		<a href="<?php  echo $mi['box_mediaURL']?>" rel="prettyPhoto<?php  echo  $notAGallery ? '' : '[MB_' . $bID . ']'?>"><?php  echo $mi['img']?></a>
	</li>		
	<?php   endforeach ?>
<?php   endforeach ?>

</ul>
<div style="clear:both">&nbsp;</div>
<style>
#mmb-imageNav_<?php  echo $bID?> li ,#mmb-imageNav_<?php  echo $bID?> li a{
	width: <?php  echo $thumb_size +10 ?>px;	
	height: <?php  echo $thumb_size +10?>px;
}
#mmb-imageNav_<?php  echo $bID?> div.mmb-infos {width: <?php  echo $thumb_size + 10 ?>px;}

</style>
<script type="text/javascript" charset="utf-8">
$(document).ready(function(){
	$("#mmb-imageNav_<?php  echo $bID?> a").prettyPhoto({
		// Setting available from administration panel : 
		slideshow: <?php  echo $slideshow ? $slideshow : 'false'?>,
		autoplay_slideshow: <?php  echo (in_array('autoplay_slideshow',$options) && $slideshow) ? 'true': 'false'?>,
		show_title: <?php  echo in_array('show_lightbox_title',$options) ? 'true' : 'false' ?>, 
		allow_resize: <?php  echo in_array('allow_resize',$options) ? 'true' : 'false' ?>,
		overlay_gallery: <?php  echo in_array('overlay_gallery',$options) ? 'true' : 'false' ?>,
		theme:'<?php  echo $template_options?>',
		// Customize yourself : 
		animation_speed: 'fast', /* fast/slow/normal */
		keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
		opacity: 0.80, /* Value between 0 and 1 */
		default_width: 500,
		default_height: 344,
		counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
		hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
		wmode: 'opaque', /* Set the flash wmode attribute */
		autoplay: true, /* Automatically start videos: True/False */
		modal: false /* If set to true, only the close button will close the window */
	});
});

</script>	
