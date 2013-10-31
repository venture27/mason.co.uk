$(document).ready(

  function DocumentLoad()
  {    
    $(window).scroll(scrollBtn);
    scrollBtn();      
  });

 function scrollBtn(){  
    if ( $(window).scrollTop() > 205 )
        $('#hidden-nav').fadeIn('slow');
    	
    else $('#hidden-nav').fadeOut('slow');
        
 } 

 

