<?php 
defined('C5_EXECUTE') or die(_("Access Denied."));

class BootstrapPackage extends Package {

     protected $pkgHandle = 'bootstrap';
     protected $appVersionRequired = '5.5.0';
     protected $pkgVersion = '2.0.4.3';

     public function getPackageDescription() {
          return t("Based on responsive Bootstrap, from Twitter");
     }

     public function getPackageName() {
          return t("Bootstrap");
     }

    
     public function install() {
    $pkg = parent::install(); 		  
	$db = Loader::db();	  


		Loader::model('collection_types');	
		// installs templates
		$pageType = CollectionType::getByHandle('home');
		if(!is_object($pageType)) {
			$data['ctHandle'] = 'home';
			$data['ctName'] = t('Home');
			$newPage = CollectionType::add($data, $pkg);
		}
		
		$pageType = CollectionType::getByHandle('left_sidebar');
		if(!is_object($pageType)) {
			$data['ctHandle'] = 'left_sidebar';
			$data['ctName'] = t('Left Sidebar');
			$newPage = CollectionType::add($data, $pkg);
		}
		$pageType = CollectionType::getByHandle('right_sidebar');
		if(!is_object($pageType)) {
			$data['ctHandle'] = 'right_sidebar';
			$data['ctName'] = t('Right Sidebar');
			$newPage = CollectionType::add($data, $pkg);
		}		
		$pageType = CollectionType::getByHandle('three_column');
		if(!is_object($pageType)) {
			$data['ctHandle'] = 'three_column';
			$data['ctName'] = t('Three Column');
			$newPage = CollectionType::add($data, $pkg);
		}
		$pageType = CollectionType::getByHandle('full');
		if(!is_object($pageType)) {
			$data['ctHandle'] = 'full';
			$data['ctName'] = t('Full');
			$newPage = CollectionType::add($data, $pkg);
		}
		$pageType = CollectionType::getByHandle('fluid_layout');
		if(!is_object($pageType)) {
			$data['ctHandle'] = 'fluid_layout';
			$data['ctName'] = t('Fluid Layout');
			$newPage = CollectionType::add($data, $pkg);
		}
		$pageType = CollectionType::getByHandle('fluid_layout_reversed');
		if(!is_object($pageType)) {
			$data['ctHandle'] = 'fluid_layout_reversed';
			$data['ctName'] = t('Fluid Layout Reversed');
			$newPage = CollectionType::add($data, $pkg);
		}
		
        	
	//install related page attributes
		Loader::model('collection_attributes');		
		$hideChildrenAttrKey=CollectionAttributeKey::getByHandle('hide_children_from_nav');
		if( !$hideChildrenAttrKey || !intval($hideChildrenAttrKey->getAttributeKeyID()) )
			$hideChildrenAttrKey = CollectionAttributeKey::add('hide_children_from_nav', t('Hide Children from Nav'), true, null, 'BOOLEAN');
		
		$dontLinkAttrKey=CollectionAttributeKey::getByHandle('dont_link');
		if( !$dontLinkAttrKey || !intval($dontLinkAttrKey->getAttributeKeyID()) )
			$dontLinkAttrKey = CollectionAttributeKey::add('dont_link', t('Dont Link in Navigation'), true, null, 'BOOLEAN');
			
		$bootstrapDropAttrKey=CollectionAttributeKey::getByHandle('bootstrap_drop');
		if( !$bootstrapDropAttrKey || !intval($bootstrapDropAttrKey->getAttributeKeyID()) )
			$bootstrapDropAttrKey = CollectionAttributeKey::add('bootstrap_drop', t('Bootstrap Navigation DropDown'), true, null, 'BOOLEAN');			
		 	 
	// install Theme
		PageTheme::add('bootstrap', $pkg);
		
	
     }
	 public function uninstall() {
		parent::uninstall();
	
		}

}
?>