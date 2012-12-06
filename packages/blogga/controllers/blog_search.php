<?php 

class BlogSearchController extends Controller {

    public function on_start(){
        $html = Loader::helper('html');
        $uh = Loader::helper('concrete/urls');
        $this->addHeaderItem($html->css($uh->getBlockTypeAssetsURL(BlockType::getByHandle('blog_posts'),'view.css')));
    }

}

?>
