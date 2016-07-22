<?php

require './Includes/init.php'; 

$category=new Category();
$c=$category->admin_get_categories();

$product=new Product();
$data=$product->  get_top_product();
echo $twig->render('layout.html.twig', array('category'=>$c ,'product'=>$data));