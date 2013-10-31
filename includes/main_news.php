<?// //CONNECT TO DATABASE
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$query = "SELECT * FROM news ORDER BY entered desc";
$data = mysqli_query($dbc, $query) or die('unable to connect');
$img = false;
if(mysqli_num_rows($data)>0) {

	while($row = mysqli_fetch_array($data)) {
		if($row['image'] != '0') {
			$imgsize = getimagesize($row['image']);
			    //self written function to resize to fit ideal width. send it one arg - image size array
			    $newImgSize = new_image_size($imgsize, 200);
			    $img = true;
			    
		}

		echo '<div class="newsPage" id="main-feed">
				<h1>'.$row['header'].'</h1>
				<h2>'.$row['subheader'].'</h2>
 			    <h3>'.date("jS F Y", strtotime($row['entered'])).'</h3>
				<div class="scratch" style="width:100%;margin-bottom:38px;"></div>'
				
				.($img==true ? '<!--NOTE: GATHER IMAGE SIZE FOR IDEAL RESHAPE-->
									<div class="image-box"><img src="'.$row['image'].'" width="'.$newImgSize[0].'" height="'.$newImgSize[1].'"/></div>' : '').
				
				'<p>'.$row['body'].'</p>
				</br></br>

				
			</div>';

	}
} 

else {
	echo '<h3 class="warning">No news available </h3>';
}	

?>	 
