<?php
require_once('includes/connection.php');
require_once('includes/functions.php');
echo '<div id="news-holder">
			<div class="scratch" style="width:196px"></div>
			<div id="news">
				<h1><span>GPKL NEWS</span></h1>
	  		</div>';

			// //CONNECT TO DATABASE
			$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
			$query = "SELECT * FROM news ORDER BY entered desc LIMIT 5";
			$data = mysqli_query($dbc, $query) or die('unable to connect');
			$img = false;
			if(mysqli_num_rows($data)>0) {

				while($row = mysqli_fetch_array($data)) {
					if($row['image'] != '0') {
						$imgsize = getimagesize($row['image']);
						    //self written function to resize to fit ideal width. send it one arg - image size array
						    $newImgSize = new_image_size($imgsize, 90);
						    $img = true;
					}

					echo '<div class="scratch" style="width:196px;"></div>
						<div id="newsbox">
							
			 				  <h1>'.$row['header'].'</h1>
			 				  <h2>'.$row['subheader'].'</h2>
			 				  <h3>'.date("jS F Y", strtotime($row['entered'])).'</h3>'
			 				  .($img ? '<img src="'.$row['image'].'" width="'.$newImgSize[0].'" height="'.$newImgSize[1].'"/>' : '').
			 				  '<p>'.$row['body'].'</p>
			 			</div>';
				}
			}else {
				echo '<h3 class="warning">No news available </h3>';
			}		

echo '</div><!--end news holder-->';
 

// mysql_close($dbc);

?>				

