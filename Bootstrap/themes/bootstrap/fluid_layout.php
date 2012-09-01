<?php  defined('C5_EXECUTE') or die(_("Access Denied.")); 
$this->inc('elements/header_fluid.php'); ?>
<div class="container-fluid ">

<?php  
$a = new Area('Header');
if (($a->getTotalBlocksInArea($c) > 0) || ($c->isEditMode()) ) {
?>

	<div class="row-fluid">
        <div class="span12">
		<?php  
		
		$a->display($c);
		?>
		</div>
	</div>	

<?php  } ?>


<section class="small_space">
	<div class="row-fluid">
		<div class="span3">
			<div class="well sidebar-nav">
			<?php  
				$a = new Area('Sidebar');
				$a->display($c);
			?>
			</div><!--/.well -->        
        </div><!--/span-->
		
		<div class="span9">
			<div class="hero-unit">
			<?php  
				$a = new Area('Header Image');
				$a->display($c);
			?>		  
			</div>
			
			<div class="row-fluid">
				<div class="span4">
				<?php  
					$a = new Area('Column 1');
					$a->display($c);
				?>
				</div><!--/span-->
			 
				<div class="span4">
				<?php  
					$a = new Area('Column 2');
					$a->display($c);
				?>
				</div><!--/span-->
				
				<div class="span4">
				<?php  
					$a = new Area('Column 3');
					$a->display($c);
				?>
				</div><!--/span-->
			</div>	
				
			<div class="row-fluid">
				<div class="span4">
				<?php  
					$a = new Area('Column 4');
					$a->display($c);
				?>
				</div><!--/span-->
			 
				<div class="span4">
				<?php  
					$a = new Area('Column 5');
					$a->display($c);
				?>
				</div><!--/span-->
				
				<div class="span4">
				<?php  
					$a = new Area('Column 6');
					$a->display($c);
				?>
				</div><!--/span-->
			
			</div><!--/row-->
		  
		</div><!--/span-->
    </div><!--/row-->	
	  
<div style="clear:both"></div>
</section >

<?php  
	$a = new Area('Main');
if (($a->getTotalBlocksInArea($c) > 0) || ($c->isEditMode()) ) {
?>
<section class="small_space">  
	 <div class="row-fluid">
        <div class="span12">
		<?php  	
		$a->display($c);
		?>
		</div>
	</div>
</section >	
<?php  }
?>

	  <div style="clear:both"></div>
<?php   $this->inc('elements/footer_fluid.php'); ?>
	