<?php

require './Includes/init.php' ;

$product  = new Product() ;
$type=  escape_string($_GET['type']);
$products = $product -> get_list ( 0 , null , ['visit_count  desc' ] ,$type ) ;

$pictures=$product->  get_product_pictures();

echo $twig -> render ( 'product.html.twig' , array ('products'=>$products , 'picture' =>$pictures) ) ;

