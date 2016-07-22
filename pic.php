<?php
require './Includes/init.php' ;
   $code=  get_captcha_code();
    $im=  imagecreate(200, 80);
    $c0=  imagecolorallocate($im, 200, 220, 200);
    $c1=  imagecolorallocate($im, rand ( 100, 200), rand(100, 200), rand(100,200));
    imageline($im, rand(1, 50) , rand(1, 50) , rand(50, 180) , rand(1, 50) , $c1);
    imagestring($im, 15, rand(20, 150), rand(10, 30), $code , $c1);
    header("Content-Type:image/png");
    imagepng($im);

