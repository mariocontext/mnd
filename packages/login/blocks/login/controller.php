<?php    
	defined('C5_EXECUTE') or die(_("Access Denied."));
	class LoginBlockController extends BlockController {
		
		var $pobj;
		 
		protected $btTable = 'btLogin';
		protected $btInterfaceWidth = "400";
		protected $btInterfaceHeight = "160";
		
		public $showRegisterLink = 0;
		public $registerText = "";
		public $returnToSamePage = 0;
		public $hideFormUponLogin = 0;
		public $helpers = array('form');
		
		/** 
		 * Used for localization. If we want to localize the name/description we have to include this
		 */
		public function getBlockTypeDescription() {
			return t("Lets you add a login box as a block.");
		}
		
		public function getBlockTypeName() {
			return t("Login Box");
		}
				
		function __construct($obj = null) {		
			parent::__construct($obj);	
			if(!$this->registerText) $this->registerText=t("Click here to register &raquo;");
		}
		
		function view(){ 
			$this->set('registerText', $this->registerText);	
			$this->set('showRegisterLink', $this->showRegisterLink); 
			$this->set('returnToSamePage', $this->returnToSamePage);
			
			$c = $this->getCollectionObject();
			if($c->isEditMode()) {
				$this->set('hideFormUponLogin', false); 
			} else {
				$this->set('hideFormUponLogin', $this->hideFormUponLogin); 
			}
		}
		
		function save($data) { 
			$args['registerText'] = isset($data['registerText']) ? trim($data['registerText']) : '';
			$args['showRegisterLink'] = intval($data['showRegisterLink']);	
			$args['returnToSamePage'] = intval($data['returnToSamePage']);
			$args['hideFormUponLogin'] = intval($data['hideFormUponLogin']);
			parent::save($args);
		}
		
	}
	
?>