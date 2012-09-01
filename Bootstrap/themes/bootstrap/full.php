<?php  defined('C5_EXECUTE') or die(_("Access Denied."));
$this->inc('elements/header.php'); 
?>
<div class="container">
<header id="overview" class="jumbotron masthead">
	<?php  
										$a = new Area('Header Image');
										$a->display($c);
?>

</header>
<div class="edit-mode-space"></div>
<section class="small_space">

		<div class="row ">
			<div class="span12">
			<?php  
										$a = new Area('Header');
										$a->display($c);
									?>
			</div>
						
		</div>
		<div class="row">
			<div class="span12">
			<?php  
										$a = new Area('Main');
										$a->display($c);
									?>
			</div>
						
		</div>
	
</section >					
<?php   $this->inc('elements/footer.php'); ?>