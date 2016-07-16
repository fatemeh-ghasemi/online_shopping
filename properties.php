<?php

require './Includes/init.php';

$product=new Product();
$id=(int)$_GET['id'];
$p=$product->get_product($id);
$c=$product->  get_category_name($p['category_id']);
$product->  inc_visit_count($id);

echo $twig->render("properties.html.twig" , array( 'product' =>$p ,'category' => $c ) );

