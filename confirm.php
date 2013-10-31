<?php
	require_once('error_reporting.php');
	session_start();
	require_once('includes/vars.php');
	require_once('includes/functions.php');
	require_once('includes/connection.php');
		if(!isset($_SESSION['email'])) {
			if(isset($_COOKIE['email'])) {
				$_SESSION['email']=$_COOKIE['email'];
				$_SESSION['name']=$_COOKIE['name'];
			}
			else {
			header('Location: login.php');
			}
		}

		

		if($_SESSION['email']!='admin') {
			header('Location: index.php');
		}

		else {	

				$outputMessage='';

			    // //CONNECT TO DATABASE
				$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
				
				
				//confirm user		
				if(isset($_POST['confirm'])){
					$query="UPDATE masonUser SET confirmed='1' WHERE email='".$_POST['email']."'";
					mysqli_query($dbc, $query);
					$outputMessage= $_POST['email'].' confirmed!';
				} 
				
				//delete user
				if(isset($_POST['delete'])) {
					$query="DELETE FROM masonUser WHERE email='".$_POST['email']."'";
					mysqli_query($dbc, $query);
					$outputMessage= $_POST['email'].' deleted!';
				}

				
					//load page
					require_once('includes/head.php');
					
					echo $outputMessage;
					
					
					$query = "select * from masonUser where confirmed='0' order by dateJoined";
					$data = mysqli_query($dbc, $query) or die('unable to connect');
					
					//gather any user who need to be confirmed
					if(mysqli_num_rows($data)>0) {

						while($row = mysqli_fetch_array($data)) {
							
							echo '<div class="newsPage" id="main-feed">
									<h1>'.$row['forename'].' '.$row['surname'].'</h1>
									
					 			    <h2>Registered on '.date("jS F Y", strtotime($row['dateJoined'])).'</h2>
									<div class="scratch" style="width:100%;margin-bottom:38px;"></div>
									<p>Is '.$row['forename'].' part of the Masons?</p>
									
									<form action="'.$_SERVER['PHP_SELF'].'" method="post">
										<input type="hidden" name="email" value="'.$row['email'].'"/>
										<input type="submit" name="confirm" value="Confirm"/>
										<input type="submit" name="delete" value="Delete"/>
									</form>
									</br></br>

									
								</div>';

						}
					}
					//no users needing confirmation
					else {
						echo '<h3 class="warning">No New Masons Available! </h3>';
					}


		

		


						
			
				

			
		
				//set footer
				require_once('includes/footer.php');
			
		}
?>