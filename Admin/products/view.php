<?php

require '../../Includes/init.php';

$product=new Product();
$id=(int)$_GET['id'];
$p=$product->admin_get_product($id);
$category=$product->get_category_name ($p['category_id']);
$pic=$product->  get_product_picture($id);

echo $twig->render("admin/products/view.html.twig" , array( 'product' =>$p,'category'=>$category ,'pic'=>$pic) );

