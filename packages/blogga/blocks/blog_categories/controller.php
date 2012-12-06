<?php  defined('C5_EXECUTE') or die(_("Access Denied."));

class BlogCategoriesBlockController extends BlockController {

    // caching for 5.4.1
    protected $btCacheBlockRecord = true;
    protected $btCacheBlockOutput = true;
    protected $btCacheBlockOutputOnPost = true;
    protected $btCacheBlockOutputForRegisteredUsers = true;
    protected $btCacheBlockOutputLifetime = 300;

    protected $btInterfaceWidth = 325;
    protected $btInterfaceHeight = 175;
    protected $btTable = 'btBloggaCategories';

    public $blog_id;

    public function getBlockTypeName(){
        return t('Blog Categories');
    }

    public function getBlockTypeDescription(){
        return t('Show the blog categories as links');
    }

    public function save($data){
        $args['blog_id'] = intval($data['blog_id']);
        parent::save($args);
    }

}

?>
