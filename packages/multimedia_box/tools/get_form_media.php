<?php   defined('C5_EXECUTE') or die(_("Access Denied."));
$variables = array();
$variables['al'] = Loader::helper('concrete/asset_library');
Loader::model('file');
Loader::model('file_set');
$variables['myFileSet'] = FileSet::getMySets();
$variables['type'] = $_GET['type'] ;
srand(); $variables['random'] = (rand());

if ($_GET['edit'] == 'true') {
    $variables['b']          = Block::getByID($_REQUEST['bID']);
    if(!is_object($variables['b'])) { die(t('Invalid Paremeters')); } 
    $variables['mb']            = $mb = $variables['b']->getInstance();
    $variables['place']         = $_GET['place'];
    $variables['edit']          = $_GET['edit'];
    $variables['types']	        = $types = explode('0o0', $mb->types);
    $variables['descs'] 	= explode('0o0', $mb->descs);
    $variables['medias']	= explode('0o0', $mb->medias);
    $variables['titles']	= explode('0o0', $mb->titles);
    $variables['widths']	= explode('0o0', $mb->widths);
    $variables['heights']	= explode('0o0', $mb->heights);
    if ($types[$_GET['place']] == 'image' || $types[$_GET['place']] == 'mp3' || $types[$_GET['place']] == 'quicktime' || $types[$_GET['place']] == 'flash') {
        $variables['media'] = File::getByID($variables['medias'][$_GET['place']]);
    }
}

Loader::packageElement('form_media','multimedia_box',$variables);
exit;