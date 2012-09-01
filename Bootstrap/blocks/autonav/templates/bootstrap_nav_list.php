<?php 
defined('C5_EXECUTE') or die("Access Denied.");

$c = Page::getCurrentPage();

//Create an array of parent cIDs so we can determine the "nav path" of the current page
$inspectC = $c;
$selectedPathCIDs = array($inspectC->getCollectionID());
$parentCIDnotZero=true;
while ($parentCIDnotZero) {
	$cParentID = $inspectC->cParentID;
	if (!intval($cParentID)) {
		$parentCIDnotZero=false;
	} else {
		if ($cParentID != HOME_CID) {
			$selectedPathCIDs[] = $cParentID; //Don't want home page in nav-path-selected
		}
		$inspectC = Page::getById($cParentID);
	}
}

//Remove excluded pages from the list (do this first because some of the data prep code needs to "look ahead" in the list)
$allNavItems = $controller->generateNav();
$includedNavItems = array();
$excluded_parent_level = 9999; //Arbitrarily high number denotes that we're NOT currently excluding a parent (because all actual page levels will be lower than this)
$exclude_children_below_level = 9999; //Same deal as above. Note that in this case "below" means a HIGHER number (because a lower number indicates higher placement in the sitemp -- e.g. 0 is top-level)
foreach ($allNavItems as $ni) {
	$_c = $ni->getCollectionObject();
	$current_level = $ni->getLevel();
	
	if ($_c->getAttribute('exclude_nav') && ($current_level <= $excluded_parent_level)) {
		$excluded_parent_level = $current_level;
		$exclude_page = true;
	} else if (($current_level > $excluded_parent_level) || ($current_level > $exclude_children_below_level)) {
		$exclude_page = true;
	} else {
		$excluded_parent_level = 9999; //Reset to arbitrarily high number to denote that we're no longer excluding a parent
		$exclude_children_below_level = $_c->getAttribute('hide_children_from_nav') ? $current_level : 9999;
		
		$exclude_page = false;
	}
	
	if (!$exclude_page) {
		$includedNavItems[] = $ni;
	}
}

//Prep all data and put it into a clean structure so markup output is as simple as possible
$navItems = array();
$navItemCount = count($includedNavItems);
for ($i = 0; $i < $navItemCount; $i++) {
	$ni = $includedNavItems[$i];
	$_c = $ni->getCollectionObject();
	$current_level = $ni->getLevel();
	
	//Link target (e.g. open in new window)
	$target = $ni->getTarget();
	$target = empty($target) ? '_self' : $target;
	
	//Link URL
	$pageLink = false;
	if ($_c->getAttribute('replace_link_with_first_in_nav')) {
		$subPage = $_c->getFirstChild(); //Note: could be a rare bug here if first child was excluded, but this is so unlikely (and can be solved by moving it in the sitemap) that it's not worth the trouble to check
		if ($subPage instanceof Page) {
			$pageLink = Loader::helper('navigation')->getLinkToCollection($subPage); //We could optimize by instantiating the navigation helper outside the loop, but this is such an infrequent attribute that I prefer code clarity over performance in this case
		}
	}
	if (!$pageLink) {
		$pageLink = $ni->getURL();
	}
	
	//Link Disabled attribute (do this separately from the page link, in case the url is needed for something else -- e.g. javascript)
	$disableLink = $_c->getAttribute('dont_link');
	

	$navtxt=$ni->getName();
	//Current/ancestor page
	$selected = false;
	$path_selected = false;
	if ($c->getCollectionID() == $_c->getCollectionID()) {
		$selected = true; //Current item is the page being viewed
		$path_selected = true;
	} elseif (in_array($_c->getCollectionID(), $selectedPathCIDs)) {
		$path_selected = true; //Current item is an ancestor of the page being viewed
	}
	
	//Calculate difference between this item's level and next item's level so we know how many closing tags to output in the markup
	$next_level = isset($includedNavItems[$i+1]) ? $includedNavItems[$i+1]->getLevel() : 0;
	$levels_between_this_and_next = $current_level - $next_level;
	
	//Determine if this item has children (can't rely on $ni->hasChildren() because it doesn't ignore excluded items!)
	$has_children = $next_level > $current_level;
	
	//Calculate if this is the first item in its level (useful for CSS classes)
	$prev_level = isset($includedNavItems[$i-1]) ? $includedNavItems[$i-1]->getLevel() : -1;
	$is_first_in_level = $current_level > $prev_level;
	
	//Calculate if this is the last item in its level (useful for CSS classes)
	$is_last_in_level = true;
	for ($j = $i+1; $j < $navItemCount; $j++) {
		if ($includedNavItems[$j]->getLevel() == $current_level) {
			//we found a subsequent item at this level (before this level "ended"), so this is NOT the last in its level
			$is_last_in_level = false;
			break;
		}
		if ($includedNavItems[$j]->getLevel() < $current_level) {
			//we found a previous level before any other items in this level, so this IS the last in its level
			$is_last_in_level = true;
			break;
		}
	} //If loop ends before one of the "if" conditions is hit, then this is the last in its level (and $is_last_in_level stays true)
	
	//Custom CSS class
	$attribute_class = $_c->getAttribute('nav_class');
	$attribute_class = empty($attribute_class) ? '' : $attribute_class;
	
	//Page ID stuff
	$item_cid = $_c->getCollectionID();
	$is_home_page = ($item_cid == HOME_CID);
	
	
	//bootstrap dropdown
		if ($_c->getAttribute('bootstrap_drop')&& $displaySubPages!='none') {
			$b_arr='';
			if( $thisLevel==0){				
				$b_arr['li_class']="dropdown";
				$b_arr['a_class']="dropdown-toggle";
				$b_arr['a_data']='data-toggle="dropdown"';
				$b_arr['arrow_code']='<b class="caret"></b>';
				$pageLink='';
				}
			
			else  {
				$b_arr['li_class']="";
				$b_arr['a_class']="";
				$b_arr['a_data']='';
				$b_arr['arrow_code']='';	
				}
			
			}
	else{
	
				$b_arr['li_class']="";
				$b_arr['a_class']="";
				$b_arr['a_data']='';
				$b_arr['arrow_code']='';	
				
	}
	
	//Package up all the data
	$navItem = new stdClass();
	$navItem->url = $pageLink;
	$navItem->name = $navtxt;
	$navItem->target = $target;
	$navItem->level = $current_level + 1; //make this 1-based instead of 0-based (more human-friendly)
	$navItem->subDepth = $levels_between_this_and_next;
	$navItem->hasSubmenu = $has_children;
	$navItem->nav_stack = $nav_stack;	
	$navItem->isFirst = $is_first_in_level;
	$navItem->isLast = $is_last_in_level;
	$navItem->isCurrent = $selected;
	$navItem->inPath = $path_selected;
	$navItem->attrClass = $attribute_class;
	$navItem->isEnabled = !$disableLink;
	$navItem->isHome = $is_home_page;
	$navItem->cID = $item_cid;
	$navItem->cObj = $_c;
	$navItem->bootstrap_drop=$b_arr;
	$navItems[] = $navItem;
}

/******************************************************************************
* DESIGNERS: CUSTOMIZE THE CSS CLASSES STARTING HERE...
*/
foreach ($navItems as $ni) {
	$classes = array();
	
	if ($ni->isCurrent) {
		//class for the page currently being viewed
		$classes[] = 'active';
	}
	
	if ($ni->inPath) {
		//class for parent items of the page currently being viewed
		$classes[] = 'nav-path-selected active';
	}
	
	
	if ($ni->isFirst) {
		//class for the first item in each menu section (first top-level item, and first item of each dropdown sub-menu)
		$classes[] = 'nav-first';
	}
	
	if ($ni->isLast) {
		//class for the last item in each menu section (last top-level item, and last item of each dropdown sub-menu)
		$classes[] = 'nav-last';
	}
	
	
	
	if ($ni->hasSubmenu) {
		//class for items that have dropdown sub-menus
		$classes[] = 'nav-dropdown';
	}
	if ($ni->nav_stack) {
		//stack
		$classes[] = 'pronav_stack_li';
	}
	
	
	
	if (!empty($ni->attrClass)) {
		//class that can be set by end-user via the 'nav_class' custom page attribute
		$classes[] = $ni->attrClass;
	}
	
	
	
	if ($ni->isHome) {
		//home page
		$classes[] = 'nav-home';
	}
	
	
	
	//unique class for every single menu item
	$classes[] = 'nav-item-' . $ni->cID;
	
	
	//Put all classes together into one space-separated string
	$ni->classes = implode(" ", $classes);
}

/******************************************************************************
* DESIGNERS: CUSTOMIZE THE HTML STARTING HERE...
*/



echo '<ul class="nav nav-list">'; //opens the top-level menu

foreach ($navItems as $ni) {

		if ($ni->hasSubmenu && $displaySubPages!='none') {	
			$b_arr='';
			if( $thisLevel==0){				
				$b_arr['li_class']="dropdown";
				$b_arr['a_class']="dropdown-toggle";
				$b_arr['a_data']='data-toggle="dropdown"';
				$b_arr['arrow_code']='<b class="caret"></b>';
				$ni->url='';
				}
			
			else  {
				$b_arr['li_class']="";
				$b_arr['a_class']="";
				$b_arr['a_data']='';
				$b_arr['arrow_code']='';	
				}
			
			}
	else{
	
				$b_arr['li_class']="";
				$b_arr['a_class']="";
				$b_arr['a_data']='';
				$b_arr['arrow_code']='';	
				
	}



	echo '<li class="'.$b_arr['li_class'].' ' . $ni->classes . '">'; //opens a nav item
	
	if ($ni->isEnabled) {
		echo '<a href="' . $ni->url . '" target="' . $ni->target . '" class="'.$b_arr['a_class'].' ' . $ni->classes . '" '.$b_arr['a_data'].' >'. $ni->name .$b_arr['arrow_code']. '</a>';
	} else {
		echo '<span class="'.$b_arr['a_class'].' ' . $ni->classes . '" '.$b_arr['a_data'].'>' . $ni->name .$b_arr['arrow_code']. '</span>';
	}
	if ($ni->hasSubmenu ) {	
		echo '<ul class="dropdown-menu">'; //opens a dropdown sub-menu
		if($ni->nav_stack==1){
		

		
		}
	} else {
		echo '</li>'; //closes a nav item	
		echo str_repeat('</ul></li>', $ni->subDepth); //closes dropdown sub-menu(s) and their top-level nav item(s)
	
	}
}

echo '</ul>'; //closes the top-level menu
?>
