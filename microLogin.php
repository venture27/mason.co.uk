<?php

  session_start();

  if(!isset($_SESSION['userId'])) {
    if(isset($_COOKIE['userId'])) {
      $_SESSION['userId'] = $_COOKIE['userId'];
    }
  }
  
  require_once('includes/connection.php');


  // Clear the error message
  $error_msg = "";

  // If the user isn't logged in, try to log them in
  if (!isset($_SESSION['userId'])) {
    if (isset($_POST['submit'])) {
      // Connect to the database
      $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

      // Grab the user-entered log-in data
      $user_username = mysqli_real_escape_string($dbc, trim($_POST['userName']));
      $user_password = mysqli_real_escape_string($dbc, trim($_POST['password']));

      if (!empty($user_username) && !empty($user_password)) {
        // Look up the username and password in the database
        $query = "SELECT userId, userName FROM masonUser WHERE userName = '$user_username' AND password = sha('$user_password')";
        // $query = "update masonUser set password=sha('admin1') where userName='admin'";
        $data = mysqli_query($dbc, $query);

        if (mysqli_num_rows($data) == 1) {
          // The log-in is OK so set the user ID and username session vars (and cookies), and redirect to the home page
          $row = mysqli_fetch_array($data);
          
          $_SESSION['userId'] = $row['userId'];
          $_SESSION['userName'] = $row['userName'];   
          
          if(isset($_POST['setcookie'])) {
            setcookie('userId', $row['userId'], time()+(60*60*24*30));  // expires in 30 days
            setcookie('userName', $row['userName'], time()+(60*60*24*30));  // expires in 30 days
          }
        
          header('Location: userpage.php');
        }
        else {
          // The username/password are incorrect so set an error message
          $error_msg = 'Sorry, you must enter a valid username and password to log in.';
        }
      }
      else {
        // The username/password weren't entered so set an error message
        $error_msg = 'Sorry, you must enter your username and password to log in.';
      }
    }
  } else {
  	header('Location: userpage.php');
  }
?>


<?php

$page_title='GPKL|Login';
$css='gents.css';

require_once('includes/header.php');

  // If the session var is empty, show any error message and the log-in form; otherwise confirm the log-in
  if (!isset($_SESSION['userId'])) {

?>
	<center><div id="logo" style="width:100%; margin:0; margin-top:50px;"><a href="index.php"><img src="images/solidcolorlogo.png" width="212" height="266"/></a></div></center>
  
  <div id="loginArea">
      <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
        <label class="label" for="userName">Username:</label>
        <input type="text" class="loginInput" name="userName"/><!--USERNAME-->
        <label class="label" for="password">Password:</label>
        <input type="password" class="loginInput" name="password"/><!--PASSWORD-->
              <?php echo '<p class="loginError">'.$error_msg.'</p>'; ?>

        <div style="width:100%; height:auto; border-bottom:1px solid #c7c7c7; float:left; padding-bottom:10px; margin:10px 0px 5px 0px;">
          <input type="submit" name="submit" value="Enter"/>
        </div> 
        <input type="checkbox" id="setcookie" name="setcookie"/>
        <label class="label" for="setcookie" id="checkbox-label">Keep me signed in OR</label>
        <a href="#">Register</a>


      </form>
        
  </div>
<?php
  
  }//end else
  
require_once('includes/footer.php');
?>


