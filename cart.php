<?php

require './Includes/init.php' ;

$cart =new Cart();

$category=new Category();
$c=$category->admin_get_categories();



echo $twig -> render ( 'cart.html.twig' , array ("cart"=>$cart->get (),'category'=>$c) ) ;
