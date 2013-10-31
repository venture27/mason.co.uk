<?php

echo '<div id="top_navigation">';
		

if($_SESSION['email']=='admin')	{
	echo '<ul id="one">
			<div class="scratch" style="width:329px"></div>
			<li><a href="enter_news.php">ENTER NEWS</a></li>
			<li><a href="freemasonary.php">UPLOAD FILE</a></li>
			<div class="scratch" style="width:329px"></div>
		</ul>	
		
		<div id="logo"><a href="index.php"><img id="logo" src="images/solidcolorlogo.png" width="212" height="266"/></a></div>
		
		<ul id="two">
			<div class="scratch" style="width:329px"></div>
			<li><a href="latest_news.php">UPDATE NEXT MEETING</a></li>
			<li><a href="confirm.php">CONFIRM REG</a></li>
			<div class="scratch" style="width:329px"></div>
		</ul>';
}

else {
	echo 
		'<ul id="one">
			<div class="scratch" style="width:329px"></div>
			<li><a href="about.php">ABOUT US</a></li>
			<li><a href="freemasonary.php">FREEMASONARY</a></li>
			<div class="scratch" style="width:329px"></div>
		</ul>	
		
		<div id="logo"><a href="index.php"><img id="logo" src="images/solidcolorlogo.png" width="212" height="266"/></a></div>
		
		<ul id="two">
			<div class="scratch" style="width:329px"></div>
			<li><a href="latest_news.php">LATEST NEWS</a></li>
			<li><a href="#">LINKS</a></li>
			<div class="scratch" style="width:329px"></div>
		</ul>';
}

echo 
'</div> 
<!--end top_navigation-->';

?>




