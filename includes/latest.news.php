<?php
require_once('includes/connection.php');
require_once('includes/functions.php');
require_once('includes/head.php');


		
			// // //CONNECT TO DATABASE
			// $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
			// $query = "SELECT * FROM news ORDER BY entered desc";
			// $data = mysqli_query($dbc, $query) or die('unable to connect');

			// if(mysqli_num_rows($data)>0) {

			// 	while($row = mysqli_fetch_array($data)) {
			// 		if($row['image'] != '0') {
			// 			$imgsize = getimagesize($row['image']);
						   
			// 			    //pass new_image_size image size and ideal image size - recieve width[0], height[1]
			// 			    $newImgSize = new_image_size($imgsize, 90);
			// 			    $img = true;
			// 		}

			// 		echo '<div id="main-feed">
							
			// 				<div class="scratch" style="width:670px;margin-bottom:38px;"></div> <!--draw a breakline-->
							
			// 				<h1>'.$row['header'].'</h1>
			// 				<h3>'.$row['subheader'].'</h3>
			//  			    <h3>'.date("jS F Y", strtotime($row['entered'])).'</h3>
							
			// 				<!--NOTE: GATHER IMAGE SIZE FOR IDEAL RESHAPE-->
			// 				<div class="image-box">'
			// 					.($img ? '<img src="'.$row['image'].'" width="'.$newImgSize[0].'" height="'.$newImgSize[1].'"/>' : '').
			// 				'</div>
			// 				<p>'.$row['body'].'</p>
			// 				</br>
										
			// 				<div class="scratch" style="width:670px;margin-bottom:38px;"></div> <!--draw a breakline-->
						  
			// 			  </div>'
			// 	}
			// } 

			// else {
			// 	echo '<h3 class="warning">No news available </h3>';
			// }		 

//mysql_close($dbc);
require_once('includes/footer.php');
?>				

