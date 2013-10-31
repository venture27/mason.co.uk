<!--NOTE: HOLDS MAIN NEWS ARTICLES IN THE RIGHT COLUMN-->
<?php 
	require_once('includes/functions.php');

?>	
		
		<div class="main-feed">

			<div class="scratch" style="width:670px;margin-bottom:38px;"></div> <!--draw a breakline-->
			
			<h1>GROVE PARK KENT LODGE</h1>
			<h3>SUPPORTING THE COMMUNITY</h3>
			<!--NOTE: GATHER IMAGE SIZE FOR IDEAL RESHAPE-->
			<?php $size=getImageSize('images/gloves.jpg'); $isa = new_image_size($size, 300); ?>
			
			<div class="image-box">
				<img src="images/gloves.jpg" width="<?php echo $isa[0]?>" height="<?php echo $isa[1]?>"/>
			</div>
			

			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. 
				Mauris massa. Vestibulum lacinia arcu eget nulla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sodales ligula in libero. Sed dignissim lacinia nunc. 
			Curabitur tortor. Pellentesque nibh. Aenean quam. In scelerisque sem at dolor. Maecenas mattis. Sed convallis tristique sem. Proin ut ligula vel nunc egestas porttitor. Morbi lectus risus, iaculis vel, suscipit quis, luctus non, massa. 
			Fusce ac turpis quis ligula lacinia aliquet. Mauris ipsum. Nulla metus metus, ullamcorper vel, tincidunt sed, euismod in, nibh. Quisque volutpat condimentum velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. 
			Nam nec ante. </p>
			</br>
						

			<p>
			Sed lacinia, urna non tincidunt mattis, tortor neque adipiscing diam, a cursus ipsum ante quis turpis. Nulla facilisi. Ut fringilla. Suspendisse potenti. Nunc feugiat mi a tellus consequat imperdiet. Vestibulum sapien. Proin quam. Etiam ultrices. 
			Suspendisse in justo eu magna luctus suscipit. Sed lectus. Integer euismod lacus luctus magna. Quisque cursus, metus vitae pharetra auctor, sem massa mattis sem, at interdum magna augue eget diam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; 
			</p>
			<div class="scratch" style="width:670px;margin-bottom:38px;"></div>
		</div>


		

<!--END MAIN NEWS ARTICLE-->