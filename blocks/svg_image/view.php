<?php 
defined('C5_EXECUTE') or die("Access Denied.");

if ($linkURL) {
	echo '<a href="'.$linkURL.'">';
} 

$fallback = '';

if ($fallbackFile) {
	$fallback = 'onerror="this.src=\''.$fallbackFile->getRelativePath() . '\';this.onerror=null;"';
}

echo '<img alt="'.$altText.'" class="ccm-svg-block" src="'.$SVGFile->getRelativePath() .'" '.$fallback.'>';

if ($linkURL) {
	 echo '</a>';
} 
 
?>

