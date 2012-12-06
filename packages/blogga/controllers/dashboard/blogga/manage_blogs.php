<?php 
Loader::model('attribute/categories/collection');
Loader::model('page_list');
Loader::model('categories','blogga');

class DashboardBloggaManageBlogsController extends Controller {

    public $helpers = array('form','concrete/interface','form/page_selector');

    public function on_start(){
        $this->categories = new CategoriesModel();

        $u = new User();
        $html = Loader::helper('html/v2');
        $this->addHeaderItem($html->css('blogga.css','blogga'));
        //$this->addHeaderItem($html->javascript('jquery.autocomplete-min.js','blogga'));
        $this->addHeaderItem($html->javascript('blogga.lib.js','blogga'));
        $this->set('ui',UserInfo::getByID($u->getUserID()));

        $pl = new PageList();
        $pl->filterByAttribute('blogga_parent',true);
        $this->set('blogs',$pl->get());
    }

    public function add_category(){
        $th = Loader::helper('text');
        if($this->post('txt_add_category')){
            $cat = $th->sanitizeFileSystem($this->post('txt_add_category'));
            $ak = CollectionAttributeKey::getByHandle('blogga_'.(int)$_POST['blog_id'].'_categories');
            $opt = new SelectAttributeTypeOption(0,$cat,1);
            $opt = $opt->saveOrCreate($ak);
        }
    }

    /*
     * This is only setting up the blog parent page. Nothing else.
     */
    public function create_blog(){
        $val = Loader::helper('validation/form');
        $val->setData($this->post());
        $val->addRequired('blog_name','Blog name is required');
        $response = $val->test();
        if($response){ // proceed
            $db = Loader::db();
            
            Loader::model('collection_types');
            Loader::model('single_page');

            $parent = Page::getByID( (int)$this->post('blog_local') );
            $b = $parent->add(CollectionType::getByHandle('blogga_page'),array('cName'=>$this->post('blog_name'),'cDescription'=>$this->post('blog_description'),Package::getByHandle('blogga')));
            $b->setAttribute('blogga_parent',true);

            // now setup a select attribute for this blog's categories
            $select = AttributeType::getByHandle('select');
            $attrName = $b->getCollectionName().' Categories';
            $pkg = Package::getByHandle('blogga');

            if(!is_object(CollectionAttributeKey::getByHandle('blogga_'.$b->getCollectionID().'_categories'))){
                CollectionAttributeKey::add($select,array('akHandle'=>'blogga_'.$b->getCollectionID().'_categories','akName'=>t($attrName),'akSelectAllowMultipleValues'=>true,'akIsSearchable'=>true,'akIsSearchableIndexed'=>true),$pkg)->setAttributeSet('blogga');

                // add first category automatically
                $ak = CollectionAttributeKey::getByHandle('blogga_'.$b->getCollectionID().'_categories');
                $opt = new SelectAttributeTypeOption(0,'General',1);
                $opt->saveOrCreate($ak);
            }

            $bt = BlockType::getByHandle('blog_posts');
            $data = array();
            $data['num_posts_to_show'] = 8;
            $data['characters_to_display'] = 250;
            $data['paginate'] = true;
            $data['max_thumb_width'] = 120;
            $data['show_thumbs'] = true;
            $data['order_by'] = 'date_desc';
            $data['show_rss'] = true;
            $data['rss_title'] = $b->getCollectionName() . ' RSS Feed';
            $data['rss_description'] = 'Blog posts';
            $data['show_posts_from'] = $b->getCollectionID();
            $b->addBlock($bt,'Blog Area',$data);

            $this->redirect('/dashboard/blogga/add_posts');
            
        }else{
            $this->set('error',$val->getError()->getList());
        }
    }

    public function use_existing(){
        $page_cID = $this->post('blog_local');
        $existingPage = Page::getByID($page_cID);
        $existingPage->setAttribute('blogga_parent',true);

        // now setup a select attribute for this blog's categories
        $select = AttributeType::getByHandle('select');
        $attrName = $existingPage->getCollectionName().' Blog Categories';
        $pkg = Package::getByHandle('blogga');

        if(!is_object(CollectionAttributeKey::getByHandle('blogga_'.$page_cID.'_categories'))){
            CollectionAttributeKey::add($select,array('akHandle'=>'blogga_'.$page_cID.'_categories','akName'=>t($attrName),'akSelectAllowMultipleValues'=>true,'akIsSearchable'=>true,'akIsSearchableIndexed'=>true),$pkg)->setAttributeSet('blogga');
        }

        $this->redirect('/dashboard/blogga/add_posts');
    }

    public function update_category(){
        $th = Loader::helper('text');
        $id = (int) str_replace('category_','',$_POST['id']);
        $val = $th->sanitizeFileSystem($_POST['text']);
        $this->categories->update($id,$val);
        exit();
    }

    public function delete_category(){
        $id = (int) str_replace('category_','',$_POST['id']);
        $this->categories->delete($id);
        exit();
    }

}

?>