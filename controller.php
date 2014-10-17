<?php
// Author: Ryan Hewitt - http://www.mesuva.com.au
namespace Concrete\Package\SvgImage;
use Package;
use BlockType;

class Controller extends Package {

	protected $pkgHandle = 'svg_image';
	protected $appVersionRequired = '5.7.0.1';
	protected $pkgVersion = '0.9.4';
	
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