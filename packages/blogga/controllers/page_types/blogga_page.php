<?php  defined('C5_EXECUTE') or die(_("Access Denied."));

class BloggaPagePageTypeController extends Controller {

    public function on_start(){
        $html = Loader::helper('html');

        $bt = BlockType::getByHandle('blog_posts');
        $blockURL = Loader::helper('concrete/urls')->getBlockTypeAssetsURL($bt,'');
        $this->addHeaderItem($html->css($blockURL.'/view.css'));
        $this->set('blockURL',$blockURL);
    }

}

?>
