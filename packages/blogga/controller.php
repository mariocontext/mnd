<?php  defined('C5_EXECUTE') or die(_("Access Denied."));

class BloggaPackage extends Package {

    protected $pkgHandle = 'blogga';
    protected $appVersionRequired = '5.4.0.5';
    protected $pkgVersion = '1.0.';

    public function getPackageDescription() {
        return t('Add a blog to yer site.');
    }

    public function getPackageName(){
        return t('blogga');
    }

    public function on_start(){
        $uh = Loader::helper('concrete/urls');
        Config::getOrDefine('BLOGGA_TOOLS_DIR',BASE_URL.$uh->getToolsURL('','blogga'));
        Config::getOrDefine('BLOGGA_DIR',$uh->getPackageURL(Package::getByHandle('blogga')));
    }

    public function uninstall() {
        parent::uninstall();
        $pkgID = $this->pkgID;
        $db = Loader::db();

        if(Group::getByName('Bloggers')){ Group::getByName('Bloggers')->delete(); }

        $res = $db->GetArray("SELECT cID FROM Pages WHERE pkgID = ?",array($pkgID));
        foreach($res as $pgID){
            Page::getByID($pgID['cID'])->delete();
        }

        $db->Execute('truncate table btBloggaPostsList');
        $db->Execute('truncate table btBloggaCategories');
    }

    public function upgrade(){
        parent::upgrade();
        //$pkg = Package::getByHandle('blogga');
    }

    public function install() {
        $pkg = parent::install();

        Loader::model('collection_types');
        Loader::model('single_page');

        // setup Bloggers group
        Group::add('Bloggers','People with blogging priveleges');

        // install blocks
        BlockType::installBlockTypeFromPackage('blog_posts',$pkg);
        BlockType::installBlockTypeFromPackage('blog_categories',$pkg);

        // install blog_post page type
        $blogga_pt = CollectionType::getByHandle('blogga_page');
        if(!$blogga_pt || !intval($blogga_pt->getCollectionTypeID())){
            $blogga_pt = CollectionType::add(array('ctHandle'=>'blogga_page','ctName'=>t('Blogga Page')),$pkg);
        }

        // install pages
        SinglePage::add('blog_search',$pkg);
        // dashboard single pages
        $p1 = SinglePage::add('/dashboard/blogga',$pkg);
        $p1->update(array('cDescription'=>$this->getPackageDescription()));
        SinglePage::add('/dashboard/blogga/add_posts',$pkg);
        SinglePage::add('/dashboard/blogga/manage_blogs',$pkg);
        SinglePage::add('/dashboard/blogga/help',$pkg);

        // setup user attributes groups in the blogga set
        $select = AttributeType::getByHandle('select'); // select attribute
        $image_file = AttributeType::getByHandle('image_file'); //text attribute
        $bool = AttributeType::getByHandle('boolean'); //checkbox
        $number = AttributeType::getByHandle('number'); // number attribute

        // add the 'blogga' attribute set to pages
        Loader::model('attribute/categories/collection');
        $eaku = AttributeKeyCategory::getByHandle('collection');
        $eaku->setAllowAttributeSets(AttributeKeyCategory::ASET_ALLOW_SINGLE);
        $bloggaSet = $eaku->addSet('blogga',t('Blogga'),$pkg);

        // add Blog Parent and Blog Post boolean attributes
        CollectionAttributeKey::add($bool,array('akHandle'=>'blogga_parent','akName'=>t('Blogga Parent'),'akIsSearchable'=>true),$pkg)->setAttributeSet($bloggaSet);
        CollectionAttributeKey::add($bool,array('akHandle'=>'blogga_post','akName'=>t('Blogga Post'),'akIsSearchable'=>true),$pkg)->setAttributeSet($bloggaSet);
        CollectionAttributeKey::add($bool,array('akHandle'=>'blogga_post_comments','akName'=>t('Allow Comments on Blog Post'),'akIsSearchable'=>true,'akIsSearchableIndexed'=>true,'akSelectAllowMultipleValues'=>true),$pkg)->setAttributeSet($bloggaSet);

        if(!is_object(CollectionAttributeKey::getByHandle('blogga_tags'))){
            CollectionAttributeKey::add($select,array('akHandle'=>'blogga_tags','akName'=>t('Blogga Tags'),'akIsSearchable'=>true,'akIsSearchableIndexed'=>true,'akSelectAllowMultipleValues'=>true),$pkg)->setAttributeSet('blogga');
        }

        if(!is_object(CollectionAttributeKey::getByHandle('post_parent_blog_id'))){
            CollectionAttributeKey::add($number,array('akHandle'=>'post_parent_blog_id','akName'=>t('Post Parent Blog PageID')),$pkg)->setAttributeSet('blogga');
        }

        // check and see if there is already a 'is_featured' page attribute, if not create it
        if(!is_object(CollectionAttributeKey::getByHandle('is_featured'))){
            CollectionAttributeKey::add($bool,array('akHandle'=>'is_featured','akName'=>t('Is Featured'),'akIsSearchable'=>true),$pkg)->setAttributeSet($bloggaSet);
        }

        // add the post preview image_file attribute
        if(!is_object(CollectionAttributeKey::getByHandle('blogga_post_preview_image'))){
            CollectionAttributeKey::add($image_file,array('akHandle'=>'blogga_post_preview_image','akName'=>t('Post Preview Image'),'akIsSearchable'=>false),$pkg)->setAttributeSet($bloggaSet);
        }
    }

    

}

    ?>