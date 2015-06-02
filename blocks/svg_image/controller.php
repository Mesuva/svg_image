<?php

namespace Concrete\Package\SVGImage\Block\SVGImage;
use \Concrete\Core\Block\BlockController;
use Loader;
use Core;
use File;
use Page;

class Controller extends BlockController
{
			protected $btInterfaceWidth = 400;
			protected $btInterfaceHeight = 450;
			protected $btTable = 'btSVGImage';
			protected $btCacheBlockRecord = true;
			protected $btCacheBlockOutput = true;
			protected $btCacheBlockOutputOnPost = true;
			protected $btCacheBlockOutputForRegisteredUsers = true;
			protected $btWrapperClass = 'ccm-ui';
			protected $btExportFileColumns = array('fID','fallbackID');
	
		
			public function getBlockTypeDescription() {
				return t("Adds SVG images and fall back images from the library to pages.");
			}
			
			public function getBlockTypeName() {
				return t("SVG Image");
			}		
			
			public function getJavaScriptStrings() {
				return array(
					'image-required' => t('You must select an SVG image.')
				);
			}
		
		
			function getFileID() {return $this->fID;}
			function getFileFallbackID() {return $this->fallbackID;}
			function getFileFallbackObject() {
				if ($this->fallbackID > 0) {
					return File::getByID($this->fallbackID);
				}
			}
			function getFileObject() {
				return File::getByID($this->fID);
			}		
			function getAltText() {return $this->altText;}
			function getExternalLink() {return $this->externalLink;}
			function getInternalLinkCID() {return $this->internalLinkCID;}

            function getLinkURL() {
				if (!empty($this->externalLink)) {
					return $this->externalLink;
				} else if (!empty($this->internalLinkCID)) {
					$linkToC = Page::getByID($this->internalLinkCID);
					return (empty($linkToC) || $linkToC->error) ? '' : Loader::helper('navigation')->getLinkToCollection($linkToC);
				} elseif ($this->linkFID > 0) {
                    $file = File::getByID($this->linkFID);
                    if ($file) {
                        if ($this->forceDownload) {
                            return $file->getForceDownloadURL();
                        } else {
                            return $file->getDownloadURL();
                        }
                    }
                } else {
					return '';
				}
			}
			
			public function save($args) {		
				$args['fallbackID'] = ($args['fallbackID'] != '') ? $args['fallbackID'] : 0;
				$args['fID'] = ($args['fID'] != '') ? $args['fID'] : 0;
                $args['forceDownload'] = ($args['forceDownload']) ? '1' : '0';

				switch (intval($args['linkType'])) {
					case 1:
						$args['linkFID'] = 0;
						$args['externalLink'] = '';
						break;
					case 2:
						$args['linkFID'] = 0;
						$args['internalLinkCID'] = 0;
						break;
                    case 3:
                        $args['externalLink'] = '';
                        $args['internalLinkCID'] = 0;
                        break;
					default:
                        $args['linkFID'] = 0;
                        $args['externalLink'] = '';
						$args['internalLinkCID'] = 0;
						break;
				}
				unset($args['linkType']); //this doesn't get saved to the database (it's only for UI usage)
				parent::save($args);
			}
			
			public function view() {
				$this->set('linkURL',$this->getLinkURL());
				$this->set('altText',$this->getAltText());
				$this->set('SVGFile',$this->getFileObject());
				$this->set('fallbackFile',$this->getFileFallbackObject());

			}
	
		}
	
	?>