<?php    
	defined('C5_EXECUTE') or die(_("Access Denied."));
	if($title==''){
		$title='Categories';
	}
	?>
	<ul class="nav nav-pills">
			<li class="dropdown active">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#">
		<?php 	echo t($title);?>
		<b class="caret"></b>
		</a>
		<ul class="dropdown-menu">
		
		

<?php 		
	if (count($cArray) > 0) { ?>
	
	
	
	<?php    
	$ak = CollectionAttributeKey::getByHandle('blog_category');
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
	?></ul>
	</li>
		</ul>
	<?php    
}
	
		