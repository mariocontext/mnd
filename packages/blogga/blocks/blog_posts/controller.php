<?php  defined('C5_EXECUTE') or die(_("Access Denied."));

class BlogPostsBlockController extends BlockController {

    protected $btInterfaceWidth = 350;
    protected $btInterfaceHeight = 400;
	
    // caching for 5.4.1
    protected $btCacheBlockRecord = true;
    protected $btCacheBlockOutput = true;
    protected $btCacheBlockOutputOnPost = true;
    protected $btCacheBlockOutputForRegisteredUsers = true;
    protected $btCacheBlockOutputLifetime = 300;
	
    protected $btTable = 'btBloggaPostsList';

    public $num_posts_to_show,
           $characters_to_display,
           $paginate,
           $show_thumbs,
           $max_thumb_width,
           $orderBy,
           $show_rss,
           $rss_title,
           $rss_description,
           $show_posts_from;

    public function getBlockTypeName(){ return t('Blog Posts'); }
    public function getBlockTypeDescription(){ return t('Lists blog posts'); }

    public function save($data){
        $args['num_posts_to_show'] = intval($data['num_posts_to_show']);
        $args['paginate'] = intval($data['paginate']) ? '1':'0';
        $args['characters_to_display'] = intval($data['characters_to_display']);
        $args['max_thumb_width'] = intval($data['max_thumb_width']);
        $args['show_thumbs'] = intval($data['show_thumbs']) ? '1':'0';
        $args['order_by'] = $data['order_by'];
        $args['show_rss'] = $data['show_rss'] ? '1':'0';
        $args['rss_title'] = $data['rss_title'];
        $args['rss_description'] = $data['rss_description'];
        $args['show_posts_from'] = intval($data['show_posts_from']);
        parent::save($args);
    }

    public function add(){
        $page = Page::getCurrentPage();
        
        $this->set('num_posts_to_show',8);
        $this->set('paginate',1);
        $this->set('characters_to_display',250);
        $this->set('max_thumb_width',125);
        $this->set('show_thumbs',1);
        $this->set('order_by','date_desc');
        $this->set('show_rss',1);
        $this->set('rss_title',$page->getCollectionName().' feed');
        $this->set('rss_description','Most recent posts from '.$page->getCollectionName().' feeds');
        $this->set('show_posts_from',$page->getCollectionID());
    }
    
    public function view(){
        $this->set('pl',$this->getPages());
    }

    public function on_start(){
        $this->text_h = Loader::helper('text');
        $this->image_h = Loader::helper('image');
    }
    
    public function getPages(){

        Loader::model('page_list');
        $pl = new PageList();
        $pl->setItemsPerPage($this->num_posts_to_show);
        $pl->filterByAttribute('blogga_post',true);

        // only filter by the show_posts_from if it is actually a blog parent page
        $pageIsBlogParent = Page::getByID($this->show_posts_from)->getAttribute('blogga_parent');
        if($pageIsBlogParent){
            $pl->filterByAttribute('post_parent_blog_id',$this->show_posts_from);
        }
        
        switch($this->order_by){
            case 'date_desc':
                $pl->sortByPublicDateDescending();
                break;
            case 'date_asc':
                $pl->sortByPublicDate();
                break;
            case 'title':
                $pl->sortByName();
                break;
        }

        if(isset($_GET['category'])){
            if($pageIsBlogParent){
                $pl->filterByAttribute('blogga_'.$this->show_posts_from.'_categories','%'.$this->text_h->sanitize($this->get('category')).'%','LIKE');
            }
        }

        if(isset($_GET['tags'])){
            $pl->filterByAttribute('blogga_tags','%'.$this->text_h->sanitize($this->get('tags')).'%','LIKE');
        }

        return $pl;
    }

    public function getRssUrl($b){
        $uh = Loader::helper('concrete/urls');
        if(!$b) return '';
        $btID = $b->getBlockTypeID();
        $bt = BlockType::getByID($btID);
        $c = $b->getBlockCollectionObject();
        $a = $b->getBlockAreaObject();
        $rssUrl = $uh->getBlockTypeToolsURL($bt)."/rss?bID=".$b->getBlockID()."&cID=".$c->getCollectionID()."&arHandle=" . $a->getAreaHandle();
        return $rssUrl;
    }

    public function getDescription($b){
        if($b->getCollectionDescription()){
            $description = '<p class="descr">'.$this->text_h->shorten($b->getCollectionDescription(),$this->characters_to_display).'</p>';
        }else{
            $pageBlocks = $b->getBlocks('Blog Area');
            $bl = $pageBlocks[0];
            if(is_object($bl)){
                $blController = $bl->getInstance();
                if($blController->getBlockTypeName() == 'Content'){
                    echo '<p class="descr">'.$this->text_h->shorten($blController->getContent(),$this->characters_to_display).'</p>';
                }
            }else{
                $description = '<p>No description provided yet</p>';
            }
        }
        return $description;
    }

    public function showPostThumbnail($thumb){
        if($this->show_thumbs){
            if(is_object($thumb)){
                $this->image_h->outputThumbnail($thumb,$this->max_thumb_width,$this->max_thumb_width);
            }
        }
    }

}

?>
