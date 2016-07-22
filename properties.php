<?php

require './Includes/init.php';

$product=new Product();
$id=(int)$_GET['id'];
$p=$product->get_product($id);
$category_name=$product->  get_category_name($p['category_id']);
$product->  inc_visit_count($id);
$comment=$product->get_comment_of_product($id);
$category=new Category();
echo $twig->render("properties.html.twig" , array( 'product' =>$p ,'category_name'=>$category_name,'comment'=>$comment ,'category'=>$category->  admin_get_categories ()) );

