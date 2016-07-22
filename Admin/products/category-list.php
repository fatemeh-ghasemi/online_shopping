<?php

require '../../Includes/init.php';

$category=new Category();

echo $twig->render("admin/products/category-list.html.twig" , array( 'category' =>$category->admin_get_categories() ) );

