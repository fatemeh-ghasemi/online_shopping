<?php

require './Includes/init.php' ;

$product = new Product() ;
$type    = escape_string ( $_GET[ 'type' ] ) ;
$p = isset($_GET['p']) ? (int) $_GET['p'] : 0;
$count=$product->  get_count($type);
if($count==FALSE){
    redirect ( "index.php");
}
$count1= ceil($count/4);
if ($p < 0) {
    $p = 0;
}
if($p>$count1){
    $p=$count1;
}

$products = $product -> get_list ($p , $type ) ;
$like     = $product -> get_like () ;
$category = new Category() ;
$c        = $category -> admin_get_categories () ;
echo $twig -> render ( 'product.html.twig' , array ( 'products' => $products , 'category' => $c , 'like' => $like ,'count'=>$count1,'type'=>$type) ) ;

