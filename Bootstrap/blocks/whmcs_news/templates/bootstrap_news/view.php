<?php 
defined('C5_EXECUTE') or die(_("Access Denied."));


function cleanString($in)

{

    $out = utf8_encode(html_entity_decode($in)); 

    return $out;

} 

$form = Loader::helper('form');

$db = Loader::db();

$r = $db->Execute('SELECT * FROM mod_c5whmcs ORDER BY id DESC LIMIT 1');

$row = $r->fetchRow();



$whmcs_name=$row['whmcs_name'];

$os_acc=$row['os'];

$path=$row['path'];

$news=$row['news'];



$query = "SELECT * FROM c5whmcs_news ORDER by date DESC LIMIT ".$news; 

$result = mysql_query($query) or die(mysql_error());

echo '<div class="c5whmcs_news"><ul id="mycarousel" class="jcarousel-skin-tango ">';

while($nrow = mysql_fetch_array($result)){

$t=$nrow['id'];



$news_items[$t]['id']=$nrow['id'];

$news_items[$t]['title']=$nrow['title'];

$news_items[$t]['announcement']=$nrow['announcement'];

$news_items[$t]['date']=$nrow['date'];



	echo '<li><h2><a href="/'.$whmcs_name.'/announcements.php?id='.$news_items[$t]['id'].'">'.cleanString($news_items[$t]['title']).'</a></h2>';

	

		echo '<span class="c5whmcs_news_date">'.$news_items[$t]['date'].'</span>';

        echo '<div style="clear:both"></div>';

        $newsdescription=$news_items[$t]['announcement'];

		$newsdescription=cleanString($newsdescription);

        $newsdescription= substr( $newsdescription, 0, 150);

        $newsdescription=$newsdescription.'...';

		echo "<p>".$newsdescription."</p></li>";



}



echo '</ul></div>';

?>