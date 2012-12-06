<?php       

defined('C5_EXECUTE') or die(_("Access Denied."));

class MultimediaBoxPackage extends Package {

	protected $pkgHandle = 'multimedia_box';
	protected $appVersionRequired = '5.3.3';
	protected $pkgVersion = '2.0.1.2';
	
	public function getPackageDescription() {
		return t("Provide a Multimedia viewer");
	}
	
	public function getPackageName() {
		return t("Multimedia Box");
	} 
	
	public function install() {
		$pkg = parent::install();
		
		// install block
		BlockType::installBlockTypeFromPackage('multimedia_box', $pkg);
 
	}

}