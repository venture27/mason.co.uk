<?php
						require_once('includes/head.php');
						require_once('includes/vars.php');
						require_once('includes/functions.php');
						require_once('includes/connection.php');
						require_once('error_reporting.php');

						//set true to show the input form
						$disp_form = true;
						$error='';
						 
							







							/***************ADD USER!!****************/
							if (isset($_POST['confirm'])) {
								$forename = $_POST['forename'];
								$surname =  $_POST['surname'];
								$email = $_POST['email'];
								$password = $_POST['password'];
								
								
								//SAVE THE DATA
								$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
								$query = "INSERT INTO masonUser (forename, surname, email, password) values ('$forename', '$surname', '$email', sha('$password'))";
								//$query = "INSERT INTO masonUser (forename, surname, email, password, picture) values ('Alex', 'Roberts', 'fred', 'whatever', 'picture');";
								mysqli_query($dbc, $query);
								
								$rs='';
								do{
									$rs = randomString();
									$query="SELECT authoriseCode FROM masonUser WHERE authoriseCode='$rs'";
									$data=mysqli_query($dbc, $query);
								} while(mysqli_num_rows($data)>0);

								$query="UPDATE masonUser SET authoriseCode='$rs' WHERE email='$email'";
								mysqli_query($dbc, $query);



								$to = 'alex.c.roberts@btinternet.com';
								$sub = 'Member Verification';
								$body ='<html><body>';
								
								$body .= '<p>Is '.$forename.' '.$surname.' a member of Grove Park Kent Lodge?</p>
												<a href="localost/red/verification.php?authoriseCode='.$rs.'">YES</a></body></html>';
								

								mail($to, $sub, $body);
								echo 'Mail Sent!';
								//NOTE:CLOSE BD
								mysqli_close($dbc);
								

								//NOTE: DISPLAY INOUT FORM
								$disp_form = false;

								echo '<p class="loginError">Thanks for registering '.$forename.' , your details will be checked by an official member of GPKL. This can take up to 48 hours. You will recieve an email shortly when you are able to enter the site.</p>';
							}
							
							










							
							/************CLIENT TO PREVIEW BEFORE THEY COMMIT***************/
							if(isset($_POST['submit'])) {
								
								//NOTE: SET VARS IF HEADER AND BODY ARE NOT EMPTY
								if(!empty($_POST['forename']) && !empty($_POST['surname']) && !empty($_POST['email']) 
									&& !empty($_POST['password'])) {

									//password check
									$userInfo=array($_POST['forename'], $_POST['surname'], $_POST['forename'].$_POST['surname'], $_POST['email'])	;
									$halt=false;//do not continue if password matches any other var
									for($i=0; $i<4; $i++) {
											if($_POST['password']==$userInfo[$i]) {
												$error='Password cannot match your name or email!';
												$disp_form=true;
												$halt=true;
											}//end if
									}//end for
									
									//halt is true redo password
									if(!$halt) {
										if($_POST['password'] == $_POST['match']){

												//NOTE: DISABLE THE FORM
												$disp_form = false;

												//NOTE: CONNECT TO DB
												$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die ('No connection');

												//NOTE: CHECK IF THE email IS ALREADY TAKEN
												$query="select email from masonUser where email='".$_POST['email']."'";
												
												//NOTE: CLEAN THE STRINGS
												$data=mysqli_query($dbc, $query) or die ('unable to connect!');
												
												//NOTE: IF email ISN'T IN DB THEN CONTINUE
												if(mysqli_num_rows($data)==0) {
												
													echo '<div class="newsPage" id="main-feed">';

													$forename = mysqli_real_escape_string($dbc, trim($_POST['forename']));
													$surname = mysqli_real_escape_string($dbc, trim($_POST['surname']));
													$email = mysqli_real_escape_string($dbc, trim($_POST['email']));
													$password = mysqli_real_escape_string($dbc, trim($_POST['password']));
												    
												    
												   


													
													echo
														'
														name: '.$forename." ".$surname.
														'</br>email: '.$email.
														'</br>
														<form method="post" action="'.$_SERVER['PHP_SELF'].'">
														<input type="submit" id="submit" name="confirm" value="enter"/>
														<input type="hidden" name="forename" value="'.$forename.'"/>
														<input type="hidden" name="surname" value="'.$surname.'"/>
														<input type="hidden" name="email" value="'.$email.'"/>
														<input type="hidden" name="password" value="'.$password.'"/>
														
														</form>
														<a href="enter_news.php?forename='.$forename.'&surname='.$surname.'&email='.$email.'" class="clear">edit</a>
														</div>';

											    }//end email check

											    else {
											    	$error= '<p class="loginError">email already exists!</p>';
													$disp_form=true;
													$_POST['email']="";
											    }//end else
												
										}//end passwords match
									
									else {
										$error= '<p class="loginError">Password does not match!</p>';
										$disp_form=true;
									}//end else
								  }							
								}//end is form set
									
								//NOTE: IF THE HEADER OR BODY IS EMPTY, WARN AND DISPLAY FORM AGAIN
								else {
									$error= '<p class="loginError">Please fill every field!</p>';
									$disp_form=true;			
								}//NOTE: END ELSE

							}//NOTE: END ISSET 
						






						/***************SHOW FORM*****************/					
						if($disp_form){
							

							if(isset($_GET['imgset'])) {
								@unlink($_GET['file']);
							}

						?>
								
						<!-- <div id="insert-news" class="main-feed"> -->
								
							<div class="dataEntry">
								<h1>Register</h1>
								<div class="scratch" style="width:100%;margin-top:20px" ></div>
								<?php echo $error; ?>
									<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
										<label for="forename">Forename</label>
										<input type="text" name="forename" id="" value="<?php if(!empty($_POST['forename'])) { echo $_POST['forename']; } else if(isset($_GET['forename'])){ echo $_GET['forename']; }else {echo '';}?>"/>
										<label for="surname">Surname</label>
										<input type="text" name="surname" id="" value="<?php if(!empty($_POST['surname'])) { echo $_POST['surname']; } else if(isset($_GET['surname'])){ echo $_GET['surname']; }else {echo '';} ?>"/>
										<label for="email">Email</label>
										<input type="text" name="email" id="" value="<?php if(!empty($_POST['email'])) { echo $_POST['email']; } else if(isset($_GET['email'])){ echo $_GET['username']; }else {echo '';} ?>"/>
										<!--password-->
										<label for="password">Password</label>
										<input type="password" name="password" id="" value=""/>
										<label for="match">Confirm Password</label>
										<input type="password" name="match" id="" value=""/>
										<!--submit-->
										<div id="enter" style="width:100%; height:auto; float:left; padding-bottom:10px; margin:10px 0px 5px 0px;">
											<input type="submit" id="" name="submit" value="Submit"/>
										</div>
									</form>
							</div>
								

						<!-- </div> -->
						<!--END UPDATE FORM-->

					<?php 
						}//end if disp_form = true
					?>
			
				

			
		
<?php 
	require_once('includes/footer.php');
?>