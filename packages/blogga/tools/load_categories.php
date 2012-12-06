<?php  defined('C5_EXECUTE') or die(_("Access Denied."));
Loader::model('attribute/categories/collection');
$ah = Loader::helper('form/attribute');


$ah->setAttributeObject(new Page);
$cAK = CollectionAttributeKey::getByHandle('blogga_'.(int)$_POST['blogID'].'_categories');
echo $ah->display($cAK,'',false);

?>