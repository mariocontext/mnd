<?php  defined('C5_EXECUTE') or die(_("Access Denied.")); ?>

<div class="categories-wrapper">
    <h3>Categories</h3>
    <ul>
        <?php 
            $uh = Loader::helper('url');
            $targetPageURL = Loader::helper('navigation')->getCollectionURL(Page::getByID($blog_id));
            Loader::model('attribute/categories/collection');
            $k = CollectionAttributeKey::getByHandle('blogga_'.$blog_id.'_categories');
            $nb = AttributeType::getByHandle('select')->getController();
            $nb->setAttributeKey($k);
            $options = $nb->getOptions();
            foreach($options as $opt){
                echo '<li><a href="'.$uh->buildQuery($targetPageURL,array('category'=>$opt->getSelectAttributeOptionValue())).'">'.$opt->getSelectAttributeOptionValue().'</a></li>';
            }
        ?>
    </ul>
</div>