<?php    
	defined('C5_EXECUTE') or die(_("Access Denied."));
	
	if($title!=''){
		echo '<h2>'.t($title).'</h2>';
	}
	
		if($title==''){
		$title='Tag List';
	}
	?>
	<ul class="nav nav-list">
			<?php 
	if (count($cArray) > 0) { ?>
	
	
	<?php    	
	$ak = CollectionAttributeKey::getByHandle('tags');
	$akc = $ak->getController();

	$tagCounts = array();
	$ttags = $akc->getOptionUsageArray($pp);
	$tags = array();
	foreach($ttags as $t) {
		$tagCounts[] = $t->getSelectAttributeOptionUsageCount();
		$tags[] = $t;
	}
	shuffle($tags);

	for ($i = 0; $i < $ttags->count(); $i++) {
		$akct = $tags[$i];
		$qs = $akc->field('atSelectOptionID') . '[]=' . $akct->getSelectAttributeOptionID();
		echo '<li><a href="'.BASE_URL.$search.'?'.$qs.'">'.$akct->getSelectAttributeOptionValue().' ('.$akct->getSelectAttributeOptionUsageCount().')</a></li>';
			
	}
	?></ul><?php    
	
}
	
		