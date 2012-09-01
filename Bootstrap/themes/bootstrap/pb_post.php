<?php  defined('C5_EXECUTE') or die(_("Access Denied.")); $this->inc('elements/header.php');  
$html = Loader::helper('html');
//$this->addHeaderItem($html->css('page_types/pb_post.css', 'problog'));
Loader::model('blogify','problog');
$blog_settings = blogify::getBlogSettings();
extract($blog_settings);
?>
<div class="container">
	
		<div class="row">
		
			<div class="span8" >
			
        <?php    
          	$a = new Area('Main');
          	$a->display($c);
        ?>
		
						
		
        <?php    
        if($trackback>0){
          	$a = new Area('Blog Post Trackback');
          	$a->display($c);
        }
        ?>
        <?php    
        if($comments>0){
        	if($disqus){
        		Loader::PackageElement('disqus','problog',array('discus'=>$disqus));
        	}else{
          		$a = new Area('Blog Post More');
          		$a->display($c);
          	}
        }
        ?>
        <?php    
          	$a = new Area('Blog Post Footer');
          	$a->display($c);
        ?>
   
	</div>
	<div class="span4" >
	<div class="well">
		
		<?php    
			$as = new Area('Sidebar');
			$as->display($c);
		?>		
		</div>
	</div>
	
		</div>

					
<?php   $this->inc('elements/footer.php'); ?>