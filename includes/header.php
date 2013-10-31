<?php 

echo '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>'.$page_title.'</title>
  <link rel="stylesheet" type="text/css" href=" '.$css.'" />

  <link rel="stylesheet" type="text/css" href="js-image-slider.css"/>
  <script src="js-image-slider.js" type="text/javascript"></script>
  <script src="js/jquery-1.9.0.min.js" type="text/javascript"></script>
  <script src="js/scroll.js" type="text/javascript"></script>
</head>
<body>'
?>
<div id="welcome-sign">
  <div id="content">
    <div id="welcome-holder">
    <?php 
 
    if(isset($_SESSION['email']) || isset($_COOKIE['email'])) {
      echo '<p>Welcome! Logged in as '. ucfirst($_SESSION['name']).' -&nbsp;</p><a href="logout.php">logout</a>'; 
    } 
    else {
    	echo '<p>Welcome To the Official Website of&nbsp&nbsp;</p><span>GPKL</span>';
    }	
    ?>
    </div>
          <p id="date"><?php echo date("l, jS F Y"); ?></p>

      <?php if(!isset($_SESSION['email'])) {
        echo '<div style="display:none;" id="hidden-nav">
        <ul>
          <li><a href="about.php">about</a></li>
          <li><a href="freemasonary.php">freemasonary</a></li>
          <li><a href="latest_news.php">latest news</a></li>
          <li><a href="enter_news.php">links</a></li>
        </ul>
      </div>';
    }
    else {
      echo '<div " id="visible-nav">
        <ul>
          <li><a href="'.($_SESSION['email']=='admin' ? 'officersUpdate.php' : 'officers.php').'">officers</a></li>
          <li><a href="'.($_SESSION['email']=='admin' ? 'meetingsUpdate.php' : 'meetings.php').'">meetings</a></li>
          <li><a href="'.($_SESSION['email']=='admin' ? 'minutesUpdate.php' : 'minutes.php').'">minutes</a></li>
          <li><a href="'.($_SESSION['email']=='admin' ? 'loiUpdate.php' : 'loi.php').'">loi</a></li>
        </ul>
      </div>';
    }?>

  </div><!--end content-->
</div><!--end welcome-sign-->
<div id="wrapper">
	
		<!--NOTE: HOLDS EVERYTHING ABOVE FOOTER IN ORDER TO KEEP IT SEPERATED FROM FOOTER-->
