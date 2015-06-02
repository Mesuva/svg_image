<?php 
defined('C5_EXECUTE') or die("Access Denied.");

if ($linkURL) {
	echo '<a href="'.$linkURL.'">';
} 

$fallback = '';

if ($SVGFile) {
    if ($fallbackFile) {
        $fallback = 'onerror="this.src=\''.$fallbackFile->getURL() . '\';this.onerror=null;"';
    }
    echo '<img alt="' . $altText . '" class="ccm-svg-block" src="' . $SVGFile->getURL() . '" ' . $fallback . ' />';
} elseif ($fallbackFile) {
    echo '<img alt="' . $altText . '" class="ccm-svg-block" src="' . $fallbackFile->getURL() . '" />';
}

if ($linkURL) {
	 echo '</a>';
} 
 
?>

