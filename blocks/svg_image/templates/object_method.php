<?php 
defined('C5_EXECUTE') or die("Access Denied.");

if ($linkURL) {
	echo '<a href="'.$linkURL.'">';
} 

$fallback = '';

if ($fallbackFile) {
	$fallback = '<img alt="'.htmlspecialchars($altText).'" src="'.$fallbackFile->getRelativePath().'" />';
}

echo '<object type="image/svg+xml" data="'.$SVGFile->getRelativePath().'" class="ccm-svg-block">
'. $fallback .'
</object>';

if ($linkURL) {
	 echo '</a>';
} 

 
?>

