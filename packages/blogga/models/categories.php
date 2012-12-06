<?php  defined('C5_EXECUTE') or die(_("Access Denied."));

// skip trying to deal with the select attribute in C5 and just go direct to db queries

class CategoriesModel {

    public function getCategories($key){
        $db = Loader::db();
        $res = $db->GetArray("SELECT ID,value FROM atSelectOptions WHERE akID = ?",array($key->akID));
        return $res;
    }

    public function update($id,$value){
        $db = Loader::db();
        $db->Execute("UPDATE atSelectOptions SET value = ? WHERE ID = ?",array($value,$id));
    }

    public function delete($id){
        $db = Loader::db();
        $db->Execute("DELETE FROm atSelectOptions WHERE ID = ?",array($id));
    }

}

?>