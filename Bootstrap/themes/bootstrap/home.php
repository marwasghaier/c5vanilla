<?php  defined('C5_EXECUTE') or die(_("Access Denied.")); $this->inc('elements/header.php'); ?>
<div class="container">
<header id="overview" class="jumbotron masthead">
	<?php  
										$a = new Area('Header Image');
										$a->display($c);
	?>
<div class="edit-mode-space"></div>

<?php  
$a = new Area('SubNav');
if (($a->getTotalBlocksInArea($c) > 0) || ($c->isEditMode())  ) { ?>
<div class="subnav ">
<?php  
$a->display($c);
?>
</div>	
<?php  
}
?>
<div class="edit-mode-space"></div>
</header>

<div class="edit-mode-space"></div>
<div class="marketing">
<section >
	<div class="page-header">
								<?php  
										$a = new Area('Header');
										$a->display($c);
									?>
	</div>
		<div class="row">
			<div class="span4">
			<?php  
										$a = new Area('Column 1');
										$a->display($c);
									?>
			</div>
			<div class="span4">
			<?php  
										$a = new Area('Column 2');
										$a->display($c);
									?>
			</div>
			<div class="span4">
			<?php  
										$a = new Area('Column 3');
										$a->display($c);
									?>
			</div>
		</div>	
		
		<div class="row">
			<div class="span4">
			<?php  
										$a = new Area('Sidebar');
										$a->display($c);
									?>
			</div>
			<div class="span8">
			<?php  
										$a = new Area('Main');
										$a->display($c);
									?>
			</div>			
		</div>
		
		<div class="row">
			<div class="span6">
			<?php  
										$a = new Area('Bottom 1');
										$a->display($c);
									?>
			</div>
			<div class="span6">
			<?php  
										$a = new Area('Bottom 2');
										$a->display($c);
									?>
			</div>			
		</div>
	
</div>				
<?php   $this->inc('elements/footer.php'); ?>
	