<?php

require "../../Includes/init.php" ;

$product  = new Product() ;
$type=  escape_string($_GET['type']);
$products = $product->  admin_get_list(0 , $type);

$category=new Category();
$c=$category->admin_get_categories();
echo $twig -> render ( 'admin/products/product.html.twig' , array ('products'=>$products,'category'=>$c) ) ;

