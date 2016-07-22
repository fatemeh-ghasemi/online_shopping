<?php

require '../../Includes/init.php';

$product=new Product();
$id=(int)$_GET['id'];
$p=$product->admin_get_product($id);
$category=new Category();
$c=$category->admin_get_categories();

echo $twig->render("admin/products/view.html.twig" , array( 'product' =>$p , 'category'=>$c) );

