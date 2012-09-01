<?php  
	defined('C5_EXECUTE') or die("Access Denied.");
	$content = $controller->getContent();
	echo '<div class="bootstrap-modal-style">';
	print $content;
	echo '</div>';
?>