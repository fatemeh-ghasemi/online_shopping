<?php

require '../../Includes/init.php' ;

$id      = ( int ) $_GET[ 'id' ] ;
$product = new Product() ;

if ( is_post () ) {
    $name          = get_post_data ( 'name' ) ;
    $price         = get_post_data ( 'price' ) ;
    $quantity      = get_post_data ( 'count' ) ;
    $serialnumber  = get_post_data ( 'serialnumber' ) ;
    $describtion   = get_post_data ( 'describe' ) ;
    $category_name = get_post_data ( 'category_name' ) ;
    $status        = get_post_data ( 'status' ) ;
    $product -> admin_edite_product ( $id , $name , $price , $quantity , $serialnumber , $describtion , $category_name , $status ) ;
    redirect("index.php");
}

$p       = $product -> admin_get_product ( $id ) ;
$category = new Category() ;
$c        = $category -> admin_get_categories () ;
echo $twig -> render ( "admin/products/edite.html.twig" , array ( 'product' => $p , 'category' => $c ) ) ;

