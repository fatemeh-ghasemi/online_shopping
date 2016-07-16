<?php

require './Includes/init.php' ;

$cart =new Cart();




echo $twig -> render ( 'cart.html.twig' , array ("cart"=>$cart->  get ()) ) ;
