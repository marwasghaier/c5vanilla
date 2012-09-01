<?php   defined('C5_EXECUTE') or die("Access Denied."); ?> 
<form action="<?php  echo $this->url( $resultTargetURL )?>" method="get" class="ccm-search-block-form search-form ">
<fieldset>
<?php   if(strlen($query)==0){ ?>
	<input name="search_paths[]" type="hidden" value="<?php  echo htmlentities($baseSearchPath, ENT_COMPAT, APP_CHARSET) ?>" />
	<?php   } else if (is_array($_REQUEST['search_paths'])) { 
		foreach($_REQUEST['search_paths'] as $search_path){ ?>
			<input name="search_paths[]" type="hidden" value="<?php  echo htmlentities($search_path, ENT_COMPAT, APP_CHARSET) ?>" />
	<?php    }
	} ?>
	<span class="text-wrap">
	<input name="query" type="text"  class="ccm-search-block-text text "  placeholder="Search.."/>
	</span>
	<input name="submit" type="submit" value="<?php  echo $buttonText?>" class="ccm-search-block-submit submit btn" style="display:none"/>
</fieldset>
</form>