<?php

  session_start();

  if(!isset($_SESSION['email'])) {
    if(isset($_COOKIE['email'])) {
      $_SESSION['email'] = $_COOKIE['email'];
      $_SESSION['name'] = $_COOKIE['name'];
    }
  }
  
  require_once('includes/connection.php');


  // Clear the error message
  $error_msg = "";

  // If the user isn't logged in, try to log them in
  if (!isset($_SESSION['email'])) {
    if (isset($_POST['submit'])) {
      // Connect to the database
      $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

      // Grab the user-entered log-in data
      $user_email = mysqli_real_escape_string($dbc, trim($_POST['email']));
      $user_password = mysqli_real_escape_string($dbc, trim($_POST['password']));

      if (!empty($user_email) && !empty($user_password)) {
        // Look up the email and password in the database
        $query = "SELECT * FROM masonUser WHERE email = '$user_email' AND password = sha('$user_password')";
        // $query = "update masonUser set password=sha('admin1') where email='admin'";
        $data = mysqli_query($dbc, $query);

        if (mysqli_num_rows($data)==1) {
          $row = mysqli_fetch_array($data);
          if($row['confirmed']==1) {
              // The log-in is OK so set the user ID and email session vars (and cookies), and redirect to the home page
              
              
              $_SESSION['email'] = $row['email'];
              $_SESSION['name'] = $row['forename'].' '.$row['surname'];   
              
              if(isset($_POST['setcookie'])) {
                setcookie('email', $row['email'], time()+(60*60*24*30));  // expires in 30 days
                setcookie('name', $row['forename'].' '.$row['surname'], time()+(60*60*24*30));  // expires in 30 days
              }
            
              header('Location: userpage.php');
          }//end check confirmation
          
          else {
            $error_msg='Sorry but the administrator has not authorised your access yet. Apologise for any inconvenience this may have caused.';
          echo $row['confirmed'];          
          }

        }//end check user name and password
        else {
          // The email/password are incorrect so set an error message
          $error_msg = 'Sorry, you must enter a valid email and password to log in.';
        }
      }//end empty fields
      else {
        // The email/password weren't entered so set an error message
        $error_msg = 'Sorry, you must enter your email and password to log in.';
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
  if (!isset($_SESSION['email'])) {

?>
	<center><div id="logo" style="width:100%; margin:0; margin-top:50px;"><a href="index.php"><img src="images/solidcolorlogo.png" width="212" height="266"/></a></div></center>
  
  <div class="dataEntry">
      <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
        <label class="label" for="email">Email:</label>
        <input type="text" class="loginInput" name="email"/><!--email-->
        <label class="label" for="password">Password:</label>
        <input type="password" class="loginInput" name="password"/><!--PASSWORD-->
              <?php echo '<p class="loginError">'.$error_msg.'</p>'; ?>

        <div id="enter" style="width:100%; height:auto; border-bottom:1px solid #c7c7c7; float:left; padding-bottom:10px; margin:10px 0px 5px 0px;">
          <input type="submit" name="submit" value="Enter"/>or <a href="register.php">Register</a>
        </div> 
        <input type="checkbox" id="setcookie" name="setcookie"/>
        <label class="label" for="setcookie" id="checkbox-label">Keep me signed in</label>
        


      </form>
        
  </div>
<?php
  
  }//end else
  
require_once('includes/footer.php');
?>


