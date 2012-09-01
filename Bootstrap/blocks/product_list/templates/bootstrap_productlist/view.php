<?php    
defined('C5_EXECUTE') or die(_("Access Denied."));  

global $c;

$uh = Loader::helper('urls', 'core_commerce');
$im = Loader::helper('image');
if ($options['show_search_form']) {
	$this->inc('view_search_form.php', array( 'c'=>$c, 'b'=>$b, 'controller'=>$controller,'block_args'=>$block_args ) );
}
?>
<?php    if ($options['show_products'] || $_REQUEST['search'] == '1') { ?>
	<?php   
	$nh = Loader::helper('navigation');
	
	$productList = $this->controller->getRequestedSearchResults();
	if ($options['hide_sold_out']) {
		$productList->displayOnlyProductsWithInventory();
	}
	$products = $productList->getPage();
	$paginator = $productList->getPagination();
	?>
	<?php    if(count($products)>0) { ?>

		<table border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
			<?php    if($paging['show_top'] || $paging['show_bottom']) {
				echo '<div class="ccm-core-commerce-summary">';
				$productList->displaySummary();
				echo '</div>';
			}
			?>				
			</td><?php   
				if (count($sort_columns)>0) { ?>
					<td style="padding-left: 20px">
					<div class="product-list-sort-header"><?php   echo  t('Sort by:'); ?> <select class="product-list-sort-select">
					<?php   
					$current_col = $_REQUEST['ccm_order_by'];
					foreach ($sort_columns as $col => $name) {
						$selected = ($current_col == $col && $_REQUEST['ccm_order_dir'] == 'asc') ? "selected" : "";
						echo '<option '.$selected.' value="';
						$productList->getSortByURL($col, 'asc', $bu);
						echo '">'.$name.' ' . t('Ascending') . '</option>';
						$selected = ($current_col == $col && $_REQUEST['ccm_order_dir'] == 'desc') ? "selected" : "";
	
						echo '<option '.$selected.' value="';
						$productList->getSortByURL($col, 'desc', $bu);
						echo '">'.$name.' ' . t('Descending') . '</option>';
					}
					?></select>
	
					</div>
					</td>
					<?php   
				} ?>
		</tr>
		</table>
		<br/>
	<div style="clear: both"></div>
		<?php    if($paging['show_top'] && $paginator && strlen($paginator->getPages())>0){ ?>	
		<div class="pagination2">	

			 <?php    echo $paginator->getPrevious(t('Previous'))?>
			 <?php    echo $paginator->getPages()?>
			 <?php    echo $paginator->getNext(t('Next'))?>
		</div>	
		<br/>
		<br/>
		<?php    } ?>
		<div style="width:100%;height:1px;display:block;clear:both"></div>
		<div class="ccm-core-commerce-product-list-results" >
		<?php   
		if ($layout['records_per_row'] > 0) {
			$modwidth = round(100 / $layout['records_per_row']);
			$spanwidth=100/$layout['records_per_row'];
		}
		for ($i = 0; $i < count($products); $i++) {	
			
			if ($i % $layout['records_per_row'] == 0) {
				if ($i > 0) {
					print '<div class="browser_clear"></div>';
				}
				if ($i + 1 < count($products)) {
					print '';
				}
			}
			
			$pr = $products[$i];
			$args['product'] = $pr;
			$args['valign'] = $layout['cell_vertical_align'];
			$args['halign'] = $layout['cell_horizontal_align'];
			$args['id'] = $pr->getProductID() . '-' . $b->getBlockID();
			foreach($this->controller->getSets() as $key => $value) {
				$args[$key] = $value;
			}
			if ($args['imagePosition'] == 'T') {
				$valign = 'top';
			} else if ($args['imagePosition'] == 'B') {
				$valign = 'bottom';
			}
			print '<div style="width:'.$spanwidth.'%;" class="mobile_block" >';
			echo '<div class="thumbnail">';
			Loader::packageElement('product/display', 'core_commerce', $args);
			print '</div></div>';
		}
		
		if ($i % $layout['records_per_row'] != 0) {
			while ($i % $layout['records_per_row'] != 0) {
				print '&nbsp;';
				$i++;
			}
		}
	?>
	</div>
	
	<?php   
		
	} else { ?>
		<?php   echo  t('No products found'); ?>
	<?php    } ?>
<?php    }?>
<div style="width:100%;height:1px;display:block;clear:both"></div>
<?php 
if($paging['show_bottom'] && $paginator && strlen($paginator->getPages())>0){ ?>	

<div class="pagination2">	

	 <?php    echo $paginator->getPrevious(t('Previous'))?>
	 <?php    echo $paginator->getPages()?>
	 <?php    echo $paginator->getNext(t('Next'))?>
</div>	
<?php    } ?>

 
