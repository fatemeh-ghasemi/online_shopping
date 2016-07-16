<?php

require './Includes/init.php' ;

$product  = new Product() ;
$products = $product -> get_list ( 0 , null , ['visit_count  desc' ] ,"necklace" ) ;

$pictures=$product->  get_product_pictures();


echo $twig -> render ( 'product.html.twig' , array ('products'=>$products , 'picture' =>$pictures) ) ;

