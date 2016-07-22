<?php

require '../../Includes/init.php';

$category=new Category();
$c=$category->admin_get_categories();
echo $twig->render("admin/products/index.html.twig" , array( 'category'=>$c) );

