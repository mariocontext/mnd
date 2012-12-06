<?php          
defined('C5_EXECUTE') or die(_("Access Denied."));

class PdPortfolioViewerBlockController extends BlockController {

	protected $btInterfaceWidth = "800";
	protected $btInterfaceHeight = "500";
	protected $btTable = 'btPdPortfolioViewer';

	public function __construct($obj = null) {		
		parent::__construct($obj);
		$this->db = Loader::db();
	}
	
	public function on_page_view() {
   }
	
	public function getBlockTypeDescription() {
		return t("Adds a portfolio viewer block to your pages.");
	}
	
	public function getBlockTypeName(){
		return t("Portfolio viewer");
	}
	
	function save($data){
		$this->db->Execute("DELETE FROM PdPortfolioImages WHERE bID=".$this->db->qstr($this->bID));
		foreach($data as $key => $value){
			if(substr($key,0,6) == "title_"){
				$id=explode("_",$key);
				$id=$id[1];
				$imageId=$data['imageId_'.$id];
				$title=$data['title_'.$id];
				$description=$data['description_'.$id];
				$url=$data['url_'.$id];
				$category=$data['category_'.$id];
				$this->db->Execute("INSERT INTO PdPortfolioImages (image,title,description,url,category,bID) VALUES (".$this->db->qstr($imageId).",".$this->db->qstr($title).",".$this->db->qstr($description).",".$this->db->qstr($url).",".$this->db->qstr($category).",".$this->bID.")");
			}
		}
		$data['thumbsize']=serialize(array($data['thumbheight'],$data['thumbwidth']));
		parent::save($data);
	}
	
	public function getJavaScriptStrings() {
		return array(
			'remove-category' => t('Delete this item?'),
			'title-required' => t('You must enter a title.'),
			'category-required' => t('You must select a category.'),
			'imageId-required' => t('You must select an image.'),
			'items-required' => t('You must specify items per page.'),
			'thumbsize-required' => t('You must specify thumbnail size.'),
			'largewidth-required' => t('You must specify a lightbox width.'),
			'items-numeric' => t('Items per page must be a number.'),
			'thumbsize-numeric' => t('Thumbnail size must be a number.'),
			'largewidth-numeric' => t('Lightbox width must be a number.')
		);
	}
}
?>
