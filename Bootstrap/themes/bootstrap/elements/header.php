<?php   defined('C5_EXECUTE') or die(_("Access Denied.")); ?>
<!DOCTYPE html>
<html lang="en" >
	<head>
	<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->

    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	  
    <![endif]-->
	<!-- Mobile Specific Metas  ================================================== -->
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		
	<!-- CORE CONCRETE  ================================================== -->		
		<?php   Loader::element('header_required'); ?>
<!-- CSS	================================================== -->	

<?php  
/*--------------------------------------------------normal css version----------------------------------------------*/
?>
<link rel="stylesheet" media="screen" type="text/css" href="<?php  echo $this->getThemePath()?>/css/bootstrap.css" />
<link rel="stylesheet" media="screen" type="text/css" href="<?php  echo $this->getStyleSheet('typography.css')?>" /> 

<link rel="stylesheet" media="screen" type="text/css" href="<?php  echo $this->getThemePath()?>/css/bootstrap-responsive.css" />
<link rel="stylesheet" media="screen" type="text/css" href="<?php  echo $this->getThemePath()?>/css/docs.css" />
<link rel="stylesheet" media="screen" type="text/css" href="<?php  echo $this->getThemePath()?>/css/prettify.css" />
<link rel="stylesheet" media="screen" type="text/css" href="<?php  echo $this->getThemePath()?>/css/addon_support.css" />


<?php  
/*--------------------------------------------------end normal css version----------------------------------------------*/
?>

<?php  
/*--------------------------------------------------LESS version----------------------------------------------
//to use less version you need to comment the "normal css version" and uncomment "LESS version"
//we recomend to comment with php the code, not delete it so you can go back to the normal version

<link rel="stylesheet/less" href="<?php  echo $this->getThemePath()?>/less/bootstrap.less">
<link rel="stylesheet/less" href="<?php  echo $this->getThemePath()?>/less/responsive.less">

 <script src="<?php  echo $this->getThemePath()?>/js/less-1.3.0.min.js"></script>
 <link rel="stylesheet" media="screen" type="text/css" href="<?php  echo $this->getStyleSheet('typography.css')?>" /> 
<link rel="stylesheet" media="screen" type="text/css" href="<?php  echo $this->getThemePath()?>/css/less_fixes.css" />
<link rel="stylesheet" media="screen" type="text/css" href="<?php  echo $this->getThemePath()?>/css/docs.css" />
<link rel="stylesheet" media="screen" type="text/css" href="<?php  echo $this->getThemePath()?>/css/addon_support.css" />
 
--------------------------------------------------end LESS version----------------------------------------------*/
?>


<?php 
 $up = new Permissions(Page::getCurrentPage()); 
if ($up->canWrite() || $up->canAddSubContent() || $up->canAdminPage() || $up->canApproveCollection()){ ?>
<style type="text/css">		
.navbar-fixed-top {position:relative!important; top:0;height:auto;margin-bottom:20px}
body {padding-top:0;margin-top: 49px !important;}
.subnav-fixed{position: static;}
img {border: 0px;}
.ccm-ui a,.ccm-ui a :visited {
    color: #0069D6;
    font-weight: inherit;
    line-height: inherit;
    text-decoration: none;
	letter-spacing: 0;   
    text-shadow: 0;
}
.ccm-ui h1,.ccm-ui h2,.ccm-ui h3 ,.ccm-ui h4 ,.ccm-ui h5 ,.ccm-ui h6 {
letter-spacing: 0px;
text-shadow: none;
}
.ccm-ui .tooltip
{
opacity: 1!important;
position: relative!important;
}
ul.icon-select-list li {min-width:220px}
.input-prepend input:focus, .input-append input:focus, .input-prepend .uneditable-input:focus, .input-append .uneditable-input:focus
{
z-index: 0!important;
} 
.ccm-ui fieldset legend {width:auto;}

</style>
<?php 
 }
$c = Page::getCurrentPage();
if ($c->isEditMode()) {
echo '<style type="text/css"> .navbar-fixed-top .brand {float:none}
.edit-mode-space {width:100%;height:20px;display:block;clear:both}
</style>';	
}
else {
?>

	<script src="<?php  echo $this->getThemePath()?>/js/prettify.js"></script>
   <script src="<?php  echo $this->getThemePath()?>/js/bootstrap-transition.js"></script>
    <script src="<?php  echo $this->getThemePath()?>/js/bootstrap-alert.js"></script>
    <script src="<?php  echo $this->getThemePath()?>/js/bootstrap-modal.js"></script>
    <script src="<?php  echo $this->getThemePath()?>/js/bootstrap-dropdown.js"></script>
    <script src="<?php  echo $this->getThemePath()?>/js/bootstrap-scrollspy.js"></script>
    <script src="<?php  echo $this->getThemePath()?>/js/bootstrap-tab.js"></script>
    <script src="<?php  echo $this->getThemePath()?>/js/bootstrap-tooltip.js"></script>
    <script src="<?php  echo $this->getThemePath()?>/js/bootstrap-popover.js"></script>
    <script src="<?php  echo $this->getThemePath()?>/js/bootstrap-button.js"></script>
    <script src="<?php  echo $this->getThemePath()?>/js/bootstrap-collapse.js"></script>
    <script src="<?php  echo $this->getThemePath()?>/js/bootstrap-carousel.js"></script>
    <script src="<?php  echo $this->getThemePath()?>/js/bootstrap-typeahead.js"></script>
   <script src="<?php  echo $this->getThemePath()?>/js/application.js"></script>
   
   
<?php  } ?>	

<!--[if lt IE 9]>
<style>
.collapse{overflow:visible}
</style>
 <![endif]-->
		<script type="text/javascript">
		$(document).ready(function() {
			  $('#btn-navbar-top').click(function() {
			$('#btn-toggle-target').toggleClass('in');

			});
			});
			
		</script>
</head>
<body data-spy="scroll" data-target=".subnav" data-offset="50">
<?php  
$a = new Area('Head Nav');
$b = new GlobalArea('Bootstrap Header Nav');
if (($a->getTotalBlocksInArea($c) > 0) || ($c->isEditMode()) || ($b->getTotalBlocksInArea($c) > 0) ) {
?>
<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">	
		<div class="container">		
		<button type="button"class="btn btn-navbar" id="btn-navbar-top">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
			<div class="brand">
			<?php   ?>
			<a href="<?php    echo DIR_REL?>/" ><?php    
				$block = Block::getByName('My_Site_Name');  
				if( $block && $block->bID ) $block->display();   
				else echo SITE;	?>		
			</a>			
			<?php  /*
			
			
			$al = new Area('Site Name');
			$al->display($c);
										
			$bl = new GlobalArea('Bootstrap Site Name ');							
			$bl->display($c);
			*/
			?>			
			</div>
			<div class="nav-collapse collapse" id="btn-toggle-target">
			<?php  $a->display($c); $b->display($c); ?>			
			</div>		
		</div>
	</div>
</div>
<?php 
 }
else
{
echo '<style>body{padding-top:10px;background-position: 0 0;background-image:none}</style>';

}
$a = new Area('Optional Header Nav');
$b = new GlobalArea('Bootstrap Optional Header Nav');
if (($a->getTotalBlocksInArea($c) > 0) || ($c->isEditMode()) || ($b->getTotalBlocksInArea($c) > 0) ) {
?>
<div class="container">
<section class="small_space">
<div class="row">	
<div class="span12">
	<?php  
$a->display($c);
$b->display($c);
	?>
</div>
</div>
</section>
</div>
<?php  } ?>