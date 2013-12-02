<?php       

defined('C5_EXECUTE') or die(_("Access Denied."));

class SvgImagePackage extends Package {

	protected $pkgHandle = 'svg_image';
	protected $appVersionRequired = '5.6.0';
	protected $pkgVersion = '0.9.1';
	
	public function getPackageDescription() {
		return t("Adds SVG images with an optional fallback image from the library to pages.");
	}
	
	public function getPackageName() {
		return t("SVG Image");
	}
	 
	public function install() {
	       $pkg = parent::install();
	       $this->configurePackage($pkg);
	} 
	 
	
	public function configurePackage($pkg) {
		$blk = BlockType::getByHandle('svg_image');
		if(!is_object($blk) ) {
			BlockType::installBlockTypeFromPackage('svg_image', $pkg);
		}		
	}
}