<?php   defined('C5_EXECUTE') or die(_("Access Denied.")); ?>
</div>
<?php  
$a = new Area('Footer');
$b = new GlobalArea('Bootstrap Footer ');
if (($a->getTotalBlocksInArea($c) > 0) || ($c->isEditMode()) || ($b->getTotalBlocksInArea($c) > 0) ) {
?>
<footer >
	<div class="container-fluid ">
		<section >	
			<div class="row-fluid">	
				<div class="span12">
				<div class="footer">
				<?php  			
					$a->display($c);	
					$b->display($c);
				?>
				<div style="clear:both"></div>
				</div>
				</div>
			</div>
		</section>	
	</div>				
</footer>

<?php  } ?>
<div style="clear:both"></div>
<div class="container-fluid">
<div class="row-fluid">	
<div class="span12">
<p class="pull-right">
<a href="#">Back to top</a>
</p>
</div>
</div>
</div>
<!-- End of Bootstrap Effect -->
<?php   Loader::element('footer_required'); 
?>
</body>
</html>