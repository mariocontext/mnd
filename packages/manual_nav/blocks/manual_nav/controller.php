<?php  
defined('C5_EXECUTE') or die(_("Access Denied."));
class ManualNavBlockController extends BlockController {
	
	protected $btTable = 'btManualNav';
	protected $btInterfaceWidth = "600";
	protected $btInterfaceHeight = "480";

	protected $btCacheBlockRecord = true;
	protected $btCacheBlockOutput = true;
	protected $btCacheBlockOutputOnPost = true;
	protected $btCacheBlockOutputForRegisteredUsers = true;
	protected $btCacheBlockOutputLifetime = 300;
		
	public function getBlockTypeName() {
		return t("Manual Nav");
	}

	public function getBlockTypeDescription() {
		return t('Manually choose pages for a navigation menu.');
	}

	public function getJavaScriptStrings() {
		return array(
			'one-link-required' => t('You must choose at least one link.'),
		);
	}
	
	function add() {
		$this->set('links', array());
	}
	
	function edit() {
		$links = $this->getLinks();
		$this->set('links', $links);
	}
	
	function view() {
		$nh = Loader::helper('navigation');
		$linkRows = $this->getLinks();
		$linkObjs = array();
		foreach ($linkRows as $row) {
			$link = new stdClass;
			$link->url = $nh->getLinkToCollection(Page::getByID($row['linkToCID']));
			$link->text = $row['linkText'];
			$linkObjs[] = $link;
		}
		$this->set('links', $linkObjs);
	}
	
	function getLinks() {
		$db = Loader::db();
		$sql = 'SELECT * FROM btManualNavLinks WHERE bID=' . intval($this->bID) . ' ORDER BY position';
		return $db->getAll($sql);
	}	
	
	function delete(){
		$db = Loader::db();
		$db->query("DELETE FROM btManualNavLinks WHERE bID=".intval($this->bID));		
		parent::delete();
	}

	function duplicate($nbID) {
		parent::duplicate($nbID);
		$links = $this->getLinks();
		$db = Loader::db();
		$sql = "INSERT INTO btManualNavLinks (bID, linkToCID, linkText, position)"
		 	 . " SELECT ?, linkToCID, linkText, position FROM btManualNavLinks WHERE bID = ?";
		$vals = array($nbID, $this->bID);
		$db->Execute($sql, $vals);
	}
	
	function save($data) {
		$db = Loader::db();
		if(count($data['linkToCIDs']) ){
			//delete existing links
			$db->query("DELETE FROM btManualNavLinks WHERE bID = ?", array($this->bID));
			
			//loop through and add the links
			$pos=0;
			foreach($data['linkToCIDs'] as $linkToCID){ 
				if(intval($linkToCID)==0 || $data['LinkTexts'][$pos]=='tempLinkText') continue;
				$sql = "INSERT INTO btManualNavLinks (bID, linkToCID, linkText, position) values (?,?,?,?)";
				$vals = array($this->bID, $linkToCID, $data['linkTexts'][$pos], $pos);
				$db->Execute($sql, $vals);
				$pos++;
			}
		}

		parent::save($data);
	}

}

?>
