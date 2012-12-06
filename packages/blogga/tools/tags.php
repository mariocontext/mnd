<?php 
Loader::model('attribute/categories/collection');
$th = Loader::helper('text');
Loader::model('tags','blogga');
$tags = new TagsModel();
$tags_akID = CollectionAttributeKey::getByHandle('blogga_tags')->getAttributeKeyID();

$searchtext = $th->sanitize($_REQUEST['query']); // !!! THESE ARE UNFILTERED!

switch($_REQUEST['axn']){
    
    case 'get_tags':
        $q = $tags->searchTags($searchtext,$tags_akID);

        $array_keys = array_keys($q); // get the keyID

        function addSpaces(&$v,$k){ $v = ucwords(str_replace(array('-', '/'), ' ', $v)); }
        $suggestions = array_values($q);
        array_walk( $suggestions,"addSpaces" ); // add spaces to properly display the tag name

        $json = Loader::helper('json');
        $return_json = array(
            'query'         => $searchtext,
            'suggestions'   => $suggestions,
            'data'          => $array_keys
        );
        echo  $json->encode($return_json);
        break;

    case 'make_tags':
        $tagID = $tags->addTag($th->sanitizeFileSystem($searchtext),$tags_akID); // returns array of [naicsCode] => [description]
        echo $tagID;
        break;
        
}



?>
