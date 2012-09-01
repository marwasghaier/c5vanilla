<?php  
	defined('C5_EXECUTE') or die("Access Denied.");
	$content = $controller->getContent();
	echo '<div class="well">';
	print $content;
	echo '</div>';
?>