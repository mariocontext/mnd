<?php  defined('C5_EXECUTE') or die(_("Access Denied.")); $form = Loader::helper('form');
Loader::model('page_list');
$pl = new PageList();
$pl->filterByAttribute('blogga_parent',true);
$blogs[''] = '';
foreach($pl->get() as $b){
    $blogs[$b->getCollectionID()] = $b->getCollectionName();
}
?>

<div class="ccm-block-field-group">
    <h2 style="margin-bottom:0;padding-bottom:0;">Pick a blog</h2>
    <p>Each blog has its own list of categories. Choose which blog you want to use.</p>
    <p style="text-align:center;"><?php  echo (count($blogs) > 1) ? $form->select('blog_id',$blogs) : '<a href="'.$this->url('/dashboard/blogga/manage_blogs').'">Create a blog first!</a>'; ?></p>
</div>

