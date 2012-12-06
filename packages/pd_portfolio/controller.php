<?php      defined('C5_EXECUTE') or die(_("Access Denied."));

class PdPortfolioPackage extends Package {

	protected $pkgHandle = 'pd_portfolio';
	protected $appVersionRequired = '5.3.3';
	protected $pkgVersion = '1.2';
	
	public function getPackageDescription() {
		return t('Add a portfolio viewer to your Concrete 5 website');
	}
	
	public function getPackageName() {
		return t('Portfolio Viewer');
	}
	
	public function install() {
		$pkg = parent::install();
		
		Loader::model('single_page');
		
		//Install Blocks
		BlockType::installBlockTypeFromPackage('pd_portfolio_viewer', $pkg);
	}
}

?>
