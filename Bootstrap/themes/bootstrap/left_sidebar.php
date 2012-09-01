<?php  defined('C5_EXECUTE') or die(_("Access Denied.")); $this->inc('elements/header.php'); ?>
<div class="container">
<div class="row">
			<div class="span12">
			<?php  
										$a = new Area('Header Image');
										$a->display($c);
									?>
			</div>
						
		</div>
		<div class="row">
			<div class="span12">
			<?php  
										$a = new Area('Header');
										$a->display($c);
									?>
			</div>
						
		</div>
		<div class="row">
		
			<div class="span4 ">
			<?php  
										$a = new Area('Sidebar');
										$a->display($c);
									?>
			</div>
			<div class="span8  ">
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

					
<?php   $this->inc('elements/footer.php'); ?>
	