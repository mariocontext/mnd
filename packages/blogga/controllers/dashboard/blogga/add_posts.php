<?php 
Loader::model('page_list');

class DashboardBloggaAddPostsController extends Controller {

    public $helpers = array('form','concrete/interface');

    public function on_start(){
        $html = Loader::helper('html/v2');
        $this->addHeaderItem($html->css('blogga.css','blogga'));
        $this->addHeaderItem($html->javascript('autocomplete/jquery.autocomplete-min.js','blogga'));
        $this->addHeaderItem($html->javascript('blogga.lib.js','blogga'));
        
        $pl = new PageList();
        $pl->filterByAttribute('blogga_parent',true);
        $blog[''] = '';
        foreach($pl->get() as $b){
            $p = new Permissions($b); // only show blogs the user has permissions to edit!
            if($p->canWrite()){
                $blog[$b->getCollectionID()] = $b->getCollectionName();
            }
        }
        $this->set('blogs',$blog);

        Loader::model('attribute/categories/collection');
        $this->set('tag_akID',CollectionAttributeKey::getByHandle('blogga_tags')->getAttributeKeyID());
    }

    public function add_post(){
        $val = Loader::helper('validation/form');
        $val->setData($this->post());
        $val->addRequired('blog_id','Must choose a blog to post to');
        $val->addRequired('post_title','Post title is required');
        $response = $val->test();
        if($response){
            Loader::model('collection_types');
            $blogParent = Page::getByID($this->post('blog_id'));
            
            // add the new post as a page
            $post = $blogParent->add(CollectionType::getByHandle('blogga_page'),array('cName'=>$this->post('post_title'),'cDescription'=>$this->post('post_description')));
            $post->setAttribute('blogga_post',true);
            $post->setAttribute('post_parent_blog_id',$this->post('blog_id'));
            $post->setAttribute('blogga_'.$blogParent->getCollectionID().'_categories',$this->post('blogga_'.$blogParent->getCollectionID().'_categories'));
            if($this->post('post_preview_image')){
                $post->setAttribute('blogga_post_preview_image',File::getByID($this->post('post_preview_image')));
            }
            $post->setAttribute('blogga_tags',$this->post('blogga_tags'));

            // install the guestbook in the Blog Comments area
            $bt = BlockType::getByHandle('guestbook');
            $data = array();
            $data['title'] = "Discussion";
            $data['dateFormat'] = 'M jS, Y';
            $data['requireApproval'] = 0;
            $data['displayGuestBookForm'] = 1;
            $data['authenticationRequired'] = 0;
            $data['displayCaptcha'] = 1;
            $gbBlock = $post->addBlock($bt,'Blog Comments',$data);
            $gbBlock->setCustomTemplate('c5tuts.php');



            // above, we add the guesbook block to each new post page. here, we decide
            // whether it actually gets show or not
            $post->setAttribute('blogga_post_comments',$this->post('enable_comments'));

            $this->redirect($post->getCollectionPath());
        }else{
            $this->set('error',$val->getError()->getList());
        }
    }

}

?>