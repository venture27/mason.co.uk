<?php
						require_once('includes/head.php');
						require_once('includes/vars.php');
						require_once('includes/functions.php');
						require_once('includes/connection.php');


						//set true to show the input form
						$disp_form = true;

						if(isset($_SESSION['live'])) {
							//take information and send it to the database
							if (isset($_POST['confirm'])) {

								//SAVE THE DATA
								$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
								$query = "INSERT INTO news (header, subheader, body, image) values ('".$_POST['header']."', '".$_POST['sub']."', '".$_POST['body']."', '".$_POST['new_picture']."');";
								mysqli_query($dbc, $query);

								//clear all the arrays
								unset($_POST['header']);
								unset($_POST['sub']);
								unset($_POST['body']);
								unset($_POST['confirm']);

								//NOTE:CLOSE BD AND END THE SESSION
								mysqli_close($dbc);
								

								//NOTE: DISPLAY INOUT FORM
								$disp_form = false;

								echo '<h3 class="warning">saved</h3>';
								echo '<h3 class="warning">click <a href="'.$_SERVER['PHP_SELF'].'">here</a>&nbsp;to start new form </h3>';
							}
							
							//NOTE: DISPLAY THE INFORMATION FOR CLIENT TO PREVIEW BEFORE THEY COMMIT
							if(isset($_POST['submit'])) {
								//NOTE: SET VARS IF HEADER AND BODY ARE NOT EMPTY
								if(!empty($_POST['header']) && !empty($_POST['body'])) {
									
									//NOTE: DISABLE THE FORM
									$disp_form = false;

									//NOTE: CONNECT TO DB
									$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die ('No connection');
									
									//NOTE: CLEAN THE STRINGS
									$header = strtoupper(mysqli_real_escape_string($dbc, trim(str_replace(array("\r\n"), '</br>', $_POST['header']))));
									$sub = strtoupper(mysqli_real_escape_string($dbc, trim(str_replace(array("\r\n"), '</br>', $_POST['sub']))));
									$body = mysqli_real_escape_string($dbc, trim(str_replace(array("\r\n"), '</br>', $_POST['body'])));
								    $target='';
								    //NOTE: CONVERT TEMP FILE TO PERMENENT FILE
									if (!empty($_FILES['new_picture']['name'])) {
								        if ($_FILES['file']['error'] == 0) {
								          // NOTE: MOVE THE FILE TO THE TARGET LOCATION FOLDER
								          $new_picture = mysqli_real_escape_string($dbc, trim($_FILES['new_picture']['name']));
								          $target = IMAGE_PATH.basename($new_picture);
								          move_uploaded_file($_FILES['new_picture']['tmp_name'], $target);

								            //NOTE: THE NEW PICTURE FILE MOVE WASN'T SUCCESSFUL. NOW MAKE SURE ANY OLD PICTURE IS DELETED
								          }	else {
								            @unlink($_FILES['new_picture']['tmp_name']);
								            
								          }
								    }
								    
								          
									//NOTE: IF THE EDIT BUTTON IS PRESSED THEN UNICODE IS NEEDEDTO PRINT RETURN CARRIAGES BACK TO THE TEXT AREA
									$edit_header = str_replace('</br>', '%0d', $header);
									$edit_sub = str_replace('</br>', '%0d', $sub);
									$edit_body = str_replace('</br>', '%0d', $body);
									
									//NOTE: SET THE PREVIEW
									echo '
										<h3 class="warning">preview</h3>
										<div class="main-feed">';
	
									echo	
										'<h1>'.$header.'</h1>
										<h3>'.$sub.'</h3>';

									//NOTE: THIS ENABLES YOU TO SHOW THE IMAGE
									if (!empty($target)) {
									    $imgsize = getimagesize($target);
									    /*NOTE: SELF WRITTEN FUNC TO RESIZE TO FIT IDEAL WIDTH. 
									    SEND IT TWO ARGS: ACTUAL IMAGE SIZE AND YOUR IDEAL 
									    WIDTH(USUALLY THE SIZE OF THE CONTAINER MINUS THE PADDING*/
									    $newImgSize = new_image_size($imgsize, 300);
									    echo '
									    <div class="image-box">
									    	<img src="'.$target.'" width="'.$newImgSize[0].'" height="'.$newImgSize[1].'" alt="Your Image" />
									    </div>
									    <!--end image-box-->';
									} 
										
									echo
										'<p>'.$body.'</p>	
										</div>
										<form method="post" action="'.$_SERVER['PHP_SELF'].'">
										<input type="submit" id="submit" name="confirm" value="enter"/>
										<input type="hidden" name="header" value="'.$header.'"/>
										<input type="hidden" name="sub" value="'.$sub.'"/>
										<input type="hidden" name="body" value="'.$body.'"/>
										<input type="hidden" name="new_picture" value="'.(!empty($target) ? $target : '0').'"/>
										</form>
										<a href="enter_news.php?header='.$edit_header.'&sub='.$edit_sub.'&body='.$edit_body.'&imgset=true&file='.$target.'" class="clear">edit</a>';
								}
								
								//NOTE: IF THE HEADER OR BODY IS EMPTY, WARN AND DISPLAY FORM AGAIN
								else {
									echo '<h3 class="warning">The Header and Body cannot be empty</h3>';
									$disp_form=true;			
								}//NOTE: END ELSE

							}//NOTE: END ISSET 
							
						}//NOTE: END ISSET SESSION
						
						if($disp_form){
							if(!isset($_SESSION['live'])) {
								$_SESSION['live'] = rand(0, 100);
							}

							if(isset($_GET['imgset'])) {
								@unlink($_GET['file']);
							}

						?>
								
						<div id="insert-news" class="main-feed">
								
								
								<h1>INSERT NEWS</h1>
								<form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
									<label for="header">Header</label>
									<input type="text" name="header" id="header" value="<?php if(!empty($_POST['header'])) { echo $_POST['header']; } else if(isset($_GET['header'])){ echo $_GET['header']; }else {echo '';}?>"/>
									<label for="sub">Subheader</label>
									<input type="text" name="sub" id="sub" value="<?php if(!empty($_POST['sub'])) { echo $_POST['sub']; } else if(isset($_GET['sub'])){ echo $_GET['sub']; }else {echo '';} ?>"/>
									<label for="body">Body</label>

									<textarea name="body" id="body"><?php if(!empty($_GET['body'])) { echo $_GET['body']; } else {echo '';} ?></textarea>
									<input type="file" name="new_picture"/>
									<input type="submit" class="submit" name="submit" value="Submit"/>
									<a href="enter_news.php" class="clear">clear</a>
								</form>
								

						</div>
						<!--END UPDATE FORM-->

					<?php 
						}//end if disp_form = true
					?>
			
				

			
		
<?php 
	require_once('includes/footer.php');
?>