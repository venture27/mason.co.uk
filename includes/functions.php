<?php
function new_image_size($imgSize, $idealImgWidth) {			
	//if image not the ideal width change it
	
	if($imgSize[0]!=$idealImgWidth){
		$sizeCalc = ($idealImgWidth/$imgSize[0])*100;
		$new = array();
		$new[0] = ($imgSize[0]/100)*$sizeCalc;
		$new[1] = ($imgSize[1]/100)*$sizeCalc;

		return $new;
	}
}

function randomString() {
    $length = 20;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    
    return $randomString;
}

?>