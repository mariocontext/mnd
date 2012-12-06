<?php 
defined('C5_EXECUTE') or die(_("Access Denied."));

/**
 * This is a convenience way of searching through the atSelectOptions instead
 * of going through concrete5's heavy models. This is primarily used for the
 * auto-suggest search and ajax adding of tags
 */
class TagsModel extends Model {

    public $_table = 'atSelectOptions';

    public function __construct(){
        parent::__construct($this->_table);
    }

    /**
     * This queries the atSelectOptions table. We HAVE to do this so that we can
     * associate the akID from Concrete5 appropriately
     * @param <string> What to search for (either a number or a text string)
     */
    public function searchTags($searchtext, $akID){
        $db = Loader::db();
        $tags = $db->getAssoc("SELECT ID, value FROM $this->_table WHERE value LIKE '%$searchtext%' AND akID = $akID ORDER BY displayOrder ASC LIMIT 8");
        return $tags;
    }

    public function addTag($searchText,$akID){
        $db = Loader::db();
        $db->Execute("INSERT INTO $this->_table (akID,value) VALUES(?,?)",array($akID,$searchText));
        return $db->Insert_ID();
    }

}

?>