<?php

require '../../Includes/init.php' ;

$id      = ( int ) $_GET[ 'id' ] ;
$category = new Category();

if ( is_post () ) {
    $name          = get_post_data ( 'name' ) ;
    $category->  admin_edite_category($id , $name);
    redirect("category-list.php");
}
$p=new Product();

$c        = $category -> admin_get_categories () ;
echo $twig -> render ( "admin/products/edite_category.html.twig" , array ( 'category' => $c ,'category_name'=>$p->  get_category_name ($id)) ) ;

