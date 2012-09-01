<?php    
	defined('C5_EXECUTE') or die(_("Access Denied."));
	global $c;
	$v = View::getInstance();
	//add the google maps API v3 to header
	//this is a content block, so this is done here in the view layer to prevend hacking at content block.
	$v->addHeaderItem('<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>');
	Loader::model('blogify','problog');
	Loader::model("attribute/categories/collection");
	
	//get this install's blog settings
	$blog_settings = blogify::getBlogSettings();
	
	//establish links to this post
	$BASE_URL = BASE_URL;
	$url = Loader::helper('navigation')->getLinkToCollection($c);
	
	//get the collectionID for this post
	$cID = $c->getCollectionID();
	
	//this posts user ID
	$uID = $c->getCollectionUserID();
	$ui = UserInfo::getByID($uID); 
	
	//get Author information if designated
	$authorID = $c->getAttribute('blog_author');
	if(!$authorID){
		$authorID = $c->getCollectionUserID();
	}
	//set a bogus user for page_type defaults editing
	if(!$authorID){
		$authorID = '1';
	}
	
	//go get ther userinfo object for user
	$ui = UserInfo::getByID($authorID); 
	
	//get post title
	$blogTitle = $c->getCollectionName();
	
	//get public date
	$blogDate = $c->getCollectionDatePublic();
	
	//get tags
	$tags = $c->getAttribute('tags');
	
	//get geotagging
	$geo = $c->getAttribute('post_location');
	
	//get thumbnail link path
	$thumb = $c->getAttribute('thumbnail');
	if(is_object($thumb)){
		$fID = $thumb->getFileID();
		$thumbpath = BASE_URL.File::getRelativePathFromID($fID);
	}
	?>
	<div class="sbBlog">
		<div>
			<div class="blog-attributes">
				<div>
					<div class="content-sbBlog-date">
					
				
	  					<?php   
						echo '	Posted On ';
						echo date('M d, Y',strtotime($blogDate));
						$uName = $ui->uName;
						if($uName!=null){echo ' By '.$uName; }						
						
						  ?>
	  				</div>
					<h1><?php    echo $blogTitle; ?> </h1>
				</div>
			</div>
			<?php   
			if($thumbpath){
				//if thumbail is present, show it
				//print '<img src="'.$thumbpath.'" alt="mobile_photo" class="mobile_photo"/>';
				//print '<br style="clear: both;" />';
			}
			?>
			<?php   
			//////////////////////////////////////////////////
			// This is the code snippet for our google map location.
			// first, check that the attribute is present,
			// then bust da move
			//////////////////////////////////////////////////
			if($geo){
				$tudes = explode('^',$geo);
				$lat = $tudes[0];
				$lon = $tudes[1];
			?>
			<div id="map" style="width: 550px; height: 120px"></div>
			<script type="text/javascript">
				//<![CDATA[
			    // The Google Map
			    
			    var infowindow = new google.maps.InfoWindow({ 
					content: '<a href="http://maps.google.com/maps?daddr=<?php   echo $lat?>,<?php   echo $lon?>" target="_blank" style="color: black!important;">Get Directions</a>'
				});  
			      
				// Set the options to be used when creating the map
				var myOptions = {
					zoom: 0,
					center: new google.maps.LatLng(0, 0),
					mapTypeId: google.maps.MapTypeId.ROADMAP
				};
				
				var map = new google.maps.Map(document.getElementById("map"),myOptions);
				
				// Create a new latlng based on the latitude and longitude from the user's position
				var user_lat_long = new google.maps.LatLng(<?php   echo $lat?>,<?php   echo $lon?>);
				
				// Add a marker using the user_lat_long position
				var marker = new google.maps.Marker({
					position: user_lat_long,
					map: map
				});
				
				google.maps.event.addListener(marker, 'click', function() {  
			      infowindow.open(map, marker);  
			    });  
				
				map.setCenter(user_lat_long);
				map.setZoom(15);
				//]]>
			</script>
			<?php   
			}
			//////////////////////////////////////////////////
			// end of our google code snippet
			//////////////////////////////////////////////////
			
			
			//go get the content block
			$content = $controller->getContent();
			print $content;
			?>
			<div id="twee">
			<br/>
				<?php    
				if($blog_settings['tweet']>0){
				?>
					<span class='st_twitter_hcount' displayText='Tweet'></span>
				<?php    }
				if($blog_settings['fb_like']==1){
				?>
					<span class='st_facebook_hcount' displayText='Facebook'></span>
				
				<?php   
				}
				if($blog_settings['google']==1){
				?>
					<span class='st_plusone_hcount' displayText='Plusone'></span>
				<?php   
				}
				?>
					<script type="text/javascript">var switchTo5x=true;</script>
					<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
					<?php    if($blog_settings['sharethis']){ ?>
					<script type="text/javascript">stLight.options({publisher:'<?php    echo $blog_settings['sharethis'];?>'});</script>
					<?php    } ?>
			</div>
			<br/>
			<div class="taglist">
				 <span class="label white_text"> <i><?php    echo $tags; ?></i></span>
			</div>
			<?php   
			if($blog_settings['author'] == 1){
			/*
				//if show author is set in settings,
				//grab each info object
				//the nab the avatar
				
				$aboutBio = $ui->getUserUserBio();
				$firstName = $ui->getUserFirstName();
				$lastName = $ui->getUserLastName();
				$uName = $ui->getUserUname();
				$uEmail = $ui->getUserUemail();
				$uLocation = $ui->getUserUlocation();
				$uAvatar = blogify::getPosterAvatar($authorID);
		    	
			?>
			<div id="bio">
				<h2><?php    echo $aboutTitle ; ?></h2>
			    <div id="bioInfo">
			    <h3><?php    echo $firstName.' '.$lastName; ?></h3>
			    <h5><?php    echo $uLocation ; ?></h5>
			    	<div id="avatar">
			    		<?php   	echo  $uAvatar; ?>
			    	</div>
			    	<p>
			    	<?php    
			    	if(isset($aboutBio)){
			    		echo $aboutBio ; 
			    	}else{
			    		echo '<i> Please add your bio info through your member profile page, or through your dashboard.</i>';
			    	}
			    	?>
			    	</p> 		
			    </div>
			</div>
			<?php  
				*/	
			} 
			?>		
		</div>
	</div>
 <br style="clear: both;"/>