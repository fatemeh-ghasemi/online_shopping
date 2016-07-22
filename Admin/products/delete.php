<?php

require '../../Includes/init.php';

$id=(int)$_GET['id'];
if(  is_post ()){
    if(  get_post_data ( 'conf')=="no"){
        redirect("index.php");
    }
    else {
       $product=new Product();
       $product->admin_delete_product($id);
       redirect("index.php");
    }
}


$category=new Category();
$c=$category->admin_get_categories();
echo $twig->render("admin/products/delete.html.twig" , array( 'category'=>$c) );

